<?php
/**
 * This file is based (and mostly copied) from the StartProfiler.php file of the
 * Wikimedia Foundation production cluster configuration, see:
 * https://github.com/wikimedia/operations-mediawiki-config/blob/
 *  c3a43aa66d1f34499d34136830139f82298a206d/wmf-config/StartProfiler.php
 */

$XWD = false;

// Parse X-DroidWiki-Header (if present) into an associative array.
if ( isset( $_SERVER['HTTP_X_DROIDWIKI_DEBUG'] ) ) {
	parse_str( preg_replace( '/; ?/', '&', $_SERVER['HTTP_X_DROIDWIKI_DEBUG'] ), $XWD );
}

if (
	ini_get( 'hhvm.stats.enable_hot_profiler' ) &&
	( isset( $XWD['profile'] ) || mt_rand( 1, 1000 ) === 1 )
) {
	xhprof_enable( XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_NO_BUILTINS );

	register_postsend_function( function () use ( $XWD ) {
		global $wmgMongoDbXhprofPassword;

		$data = [ 'profile' => xhprof_disable() ];
		$sec  = $_SERVER['REQUEST_TIME'];
		$usec = $_SERVER['REQUEST_TIME_FLOAT'] - $sec;
		$keyWhitelist = array_flip( [
			'HTTP_HOST', 'HTTP_X_WIKIMEDIA_DEBUG', 'REQUEST_METHOD',
			'REQUEST_START_TIME', 'REQUEST_TIME', 'REQUEST_TIME_FLOAT',
			'SERVER_ADDR', 'SERVER_NAME', 'THREAD_TYPE', 'action'
		] );

		// Create sanitized copies of $_SERVER, $_ENV, and $_GET:
		$server = array_intersect_key( $_SERVER, $keyWhitelist );
		$env = array_intersect_key( $_ENV, $keyWhitelist );
		$get = array_intersect_key( $_GET, $keyWhitelist );

		// Strip everything from the query string except 'action=' param:
		preg_match( '/action=[^&]+/', $_SERVER['REQUEST_URI'], $matches );
		$qs = $matches ? '?' . $matches[0] : '';
		$url = $_SERVER['SCRIPT_NAME'] . $qs;

		// If profiling was explicitly requested (via X-Wikimedia-Debug)
		// then include the unique request ID in the reported URL, to make
		// it easy for the person debugging to find the request in Xhgui.
		if ( $XWD && method_exists( 'WebRequest', 'getRequestId' ) ) {
			$reqId = WebRequest::getRequestId();
			$url = '//' . $reqId . $url;
			$env['UNIQUE_ID'] = $reqId;
			$server['UNIQUE_ID'] = $reqId;
		}

		// Re-insert scrubbed URL as REQUEST_URL:
		$server['REQUEST_URI'] = $url;
		$env['REQUEST_URI'] = $url;
		$data['meta'] = [
			'url'              => $url,
			'SERVER'           => $server,
			'get'              => $get,
			'env'              => $env,
			'simple_url'       => Xhgui_Util::simpleUrl( $url ),
			'request_ts'       => new MongoDate( $sec ),
			'request_ts_micro' => new MongoDate( $sec, $usec ),
			'request_date'     => date( 'Y-m-d', $sec ),
		];
		var_dump($data);
		Xhgui_Saver::factory( [
			'save.handler' => 'mongodb',
			'db.host'      => 'mongodb://xhprof@188.68.49.74:27017',
			'db.db'        => 'xhprof',
			'db.options'   => [
				'password' => $wmgMongoDbXhprofPassword,
			],
		] )->save( $data );
	} );
}
