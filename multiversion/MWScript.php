<?php
if ( PHP_SAPI !== 'cli' ) {
	echo "This script can only be run from the command line.\n";
	exit( 1 );
}

/**
 * Run a MediaWiki script based on the parameters (like --wiki) given to CLI.
 *
 * The first argument must be the relative (to MediaWiki) script file path.
 * If only a filename is given, it will be assumed to reside in /maintenance.
 * The second argument must be the --wiki parameter. This is to avoid
 * any "options with args" ambiguity (see Maintenance.php).
 *
 * When the actual script is run, $argv[0] (this file's name) will be not be kept.
 * Also, $argv[1] (the script path) will be changed to the script file name.
 * All other arguments will be preserved.
 *
 * @return string Absolute MediaWiki script path
 */
function getMWScriptWithArgs() {
	global $argv;
	if ( count( $argv ) < 2 ) {
		fwrite( STDERR, "This script can only be run from the command line.\n" );
		exit( 1 );
	}

	$relFile = $argv[1]; // the script file to run
	# If no MW directory is given then assume this is a /maintenance script
	if ( strpos( $relFile, '/' ) === false ) {
		$relFile = "maintenance/$relFile"; // convenience
	}

	# Remove effects of this wrapper from $argv...
	array_shift( $argv ); // remove this file's name from args
	# Code stolen from wfBasename() in GlobalFunctions.php :)
	if ( preg_match( "#([^/\\\\]*?)[/\\\\]*$#", $argv[0], $matches ) ) {
		$argv[0] = $matches[1]; // make first arg the script file name
	}

	# For addwiki.php, the wiki DB doesn't yet exist, and for some
	# other maintenance scripts we don't care what wiki DB is used...
	$wikiless = [
		'maintenance/purgeList.php',
		'extensions/WikimediaMaintenance/addWiki.php', // 1.19
		'extensions/WikimediaMaintenance/dumpInterwiki.php', // 1.19
		'extensions/WikimediaMaintenance/getJobQueueLengths.php',
		'extensions/WikimediaMaintenance/rebuildInterwiki.php', // 1.19
		'extensions/WikimediaMaintenance/filebackend/setZoneAccess.php',
		'maintenance/mctest.php',
		'maintenance/mcc.php',
	];

	# Check if a --wiki param was given...
	# Maintenance.php will treat $argv[1] as the wiki if it doesn't start '-'
	if ( !isset( $argv[1] ) || !preg_match( '/^([^-]|--wiki(=|$))/', $argv[1] ) ) {
		if ( in_array( $relFile, $wikiless ) ) {
			# Assume aawiki as Maintenance.php does.
			$argv = array_merge( [ $argv[0], "--wiki=aawiki" ], array_slice( $argv, 1 ) );
		}
	}

	# MWScript.php should be in common/
	require_once __DIR__ . '/MWMultiVersion.php';
	$multiversion = MWMultiVersion::getInstanceForMaintenance();
	$file = dirname( dirname( dirname( __DIR__ ) ) ) . "/main/" . $relFile;
	if ( !file_exists( $file ) ) {
		fwrite( STDERR, "The MediaWiki script file \"{$file}\" does not exist.\n" );
		exit( 1 );
	}

	return $file;
}

# Otherwise redis will timeout, needs investigation, though
ini_set( 'default_socket_timeout', -1 );

# Run the script!
require_once getMWScriptWithArgs();
