<?php

/**
 * MediaWiki logging configuration based on the Wikimedia Foundation logging configuration:
 * https://github.com/wikimedia/operations-mediawiki-config/blob/3373247e123b5386a2189a7d8f8ecd4e9aa4744d/wmf-config/logging.php
 */

use MediaWiki\Logger\LoggerFactory;

$wmgMonologChannels = [
	'404' => 'error',
	'AbuseFilter' => 'error',
	'AdHocDebug' => 'error',
	'antispoof' => 'error',
	'api' => 'error',
	'api-feature-usage' => 'error',
	'api-readonly' => 'error',
	'api-request' => [
		'level' => 'error',
		'buffer' => true,
	],
	'api-warning' => 'error',
	'authentication' => 'info',
	'autoloader' => 'error',
	'badpass' => 'error',
	'badpass-priv' => 'error',
	'BlockManager' => 'info',
	'BounceHandler' => 'error',
	'Bug58676' => 'error',
	'captcha' => 'error',
	'CentralNotice' => 'error',
	'CirrusSearch' => 'error',
	'cirrussearch-request' => [
		'level' => 'error',
		'buffer' => true,
	],
	'CirrusSearchChangeFailed' => 'error',
	'CirrusSearchSlowRequests' => 'error',
	'cite' => 'error',
	'collection' => 'error',
	'csp' => 'info',
	'csp-report-only' => 'info',
	'DBConnection' => 'error',
	'DBPerformance' => 'warning',
	'DBQuery' => 'warning',
	'DBReplication' => 'warning',
	'DBTransaction' => 'warning',
	'DeferredUpdates' => 'error',
	'deprecated' => 'debug',
	'diff' => 'warning',
	'Echo' => 'error',
	'Elastica' => 'info',
	'error' => 'error',
	'exception' => false,
	'exception-json' => 'error',
	'exec' => 'error',
	'export' => 'error',
	'fatal' => 'error',
	'FileImporter' => 'error',
	'FileOperation' => 'error',
	'FSFileBackend' => 'error',
	'generated-pp-node-count' => 'error',
	'GlobalTitleFail' => [ 'sample' => 10000 ],
	'goodpass' => 'error',
	'goodpass-priv' => 'error',
	'headers-sent' => 'error',
	'HttpError' => 'error',
	'JobExecutor' => 'error',
	'localisation' => 'error',
	'LockManager' => 'warning',
	'logging' => 'debug',
	'LoginNotify' => 'error',
	'memcached' => 'error',
	'message-format' => 'error',
	'MessageCacheError' => 'error',
	'mobile' => 'error',
	'objectcache' => 'warning',
	'OutputBuffer' => 'error',
	'poolcounter' => 'error',
	'preferences' => 'error',
	'purge' => 'error',
	'query' => 'error',
	'ratelimit' => 'error',
	'recursion-guard' => 'debug',
	'redis' => 'info',
	'Renameuser' => 'error',
	'resourceloader' => 'info',
	'ResourceLoaderImage' => 'error',
	'RevisionStore' => 'info',
	'runJobs' => 'debug',
	'security' => 'debug',
	'session' => 'warning',
	'session-ip' => 'info',
	'slow-parse' => 'info',
	'SQLBagOStuff' => 'error',
	'StashEdit' => 'error',
	'throttler' => 'info',
	'thumbnail' => 'error',
	'thumbnailaccess' => 'error',
	'updateTranstagOnNullRevisions' => 'error',
	'upload' => 'error',
	'VisualEditor' => 'error',
	'wfLogDBError' => 'error',
	'Wikibase' => 'error',
	'Wikibase.NewItemIdFormatter' => 'error',
	'WikibaseQualityConstraints' => 'error',
	'WikimediaEvents' => 'error',
	'WikitechGerritBan' => 'error',
	'WikitechPhabBan' => 'error',
	'xff' => 'error',
	'XMP' => 'error',
];

// Post construction calls to make for new Logger instances
$wmgMonologLoggerCalls = [
	// T116550 - Requires Monolog > 1.17.2
	'useMicrosecondTimestamps' => [ false ],
];
$wmgMonologProcessors = [
	'wiki' => [
		'class' => '\\MediaWiki\\Logger\\Monolog\\WikiProcessor',
	],
	'psr' => [
		'class' => '\\Monolog\\Processor\\PsrLogMessageProcessor',
	],
	'pid' => [
		'class' => '\\Monolog\\Processor\\ProcessIdProcessor',
	],
	'uid' => [
		'class' => '\\Monolog\\Processor\\UidProcessor',
	],
	'web' => [
		'class' => '\\Monolog\\Processor\\WebProcessor',
	],
];
$wmgMonologConfig = [
	'loggers' => [
		// Template for all undefined log channels
		'@default' => [
			'handlers' => [ 'default' ],
			'processors' => array_keys( $wmgMonologProcessors ),
		],
	],
	'processors' => $wmgMonologProcessors,
	'handlers' => [
		'default' => [
			'class' => '\\MediaWiki\\Logger\\Monolog\\LegacyHandler',
			'args' => [ 'php://stdout' ],
			'formatter' => 'line',
		],
		'blackhole' => [
			'class' => '\\Monolog\\Handler\\NullHandler',
		],
	],
	'formatters' => [
		'line' => [
			'class' => '\\MediaWiki\\Logger\\Monolog\\LineFormatter',
			'args' => [
				"%datetime% [%extra.reqId%] %extra.host% %extra.wiki% %extra.mwversion% %channel% %level_name%: %message% %context% %exception%\n",
				'Y-m-d H:i:s',
				true, // allowInlineLineBreaks
				true, // ignoreEmptyContextAndExtra
				true, // includeStacktraces
			],
		],
	],
];

foreach ( $wmgMonologChannels as $channel => $opts ) {
	if ( $opts === false ) {
		// Log channel disabled on this wiki
		$wmgMonologConfig['loggers'][$channel] = [
			'handlers' => [ 'blackhole' ],
		];
		continue;
	}
	$opts = is_array( $opts ) ? $opts : [ 'level' => $opts ];
	$opts = array_merge( [
		'level' => 'debug',
		'sample' => false,
		'buffer' => false,
	], $opts );

	$handlers = [];
	if ( $opts['level'] ) {
		// Configure leveled log handler
		$leveledLogger = "level-{$opts['level']}";
		if ( !isset( $wmgMonologConfig['handlers'][$leveledLogger] ) ) {
			// Register handler that will only pass events of the given
			// log level
			$wmgMonologConfig['handlers'][$leveledLogger] = [
				'class' => '\\MediaWiki\\Logger\\Monolog\\LegacyHandler',
				'args' => [
					'php://stdout',
					false,
					$opts['level'],
				],
				'formatter' => 'line',
			];
		}
		$handlers[] = $leveledLogger;
	}
	if ( $opts['sample'] ) {
		$sample = $opts['sample'];
		foreach ( $handlers as $idx => $handlerName ) {
			$sampledHandler = "{$handlerName}-sampled-{$sample}";
			if ( !isset( $wmgMonologConfig['handlers'][$sampledHandler] ) ) {
				// Register a handler that will sample the event stream and
				// pass events on to $handlerName for storage
				$wmgMonologConfig['handlers'][$sampledHandler] = [
					'class' => '\\Monolog\\Handler\\SamplingHandler',
					'args' => [
						function () use ( $handlerName ) {
							return LoggerFactory::getProvider()->getHandler( $handlerName );
						},
						$sample,
					],
				];
			}
			$handlers[$idx] = $sampledHandler;
		}
	}
	if ( $opts['buffer'] ) {
		foreach ( $handlers as $idx => $handlerName ) {
			$bufferedHandler = "{$handlerName}-buffered";
			if ( !isset( $wmgMonologConfig['handlers'][$bufferedHandler] ) ) {
				// Register a handler that will buffer the event stream and
				// pass events to the nested handler after closing the request
				$wmgMonologConfig['handlers'][$bufferedHandler] = [
					'class' => '\\MediaWiki\\Logger\\Monolog\\BufferHandler',
					'args' => [
						function () use ( $handlerName ) {
							return LoggerFactory::getProvider()->getHandler( $handlerName );
						},
					],
				];
			}
			$handlers[$idx] = $bufferedHandler;
		}
	}
	if ( $handlers ) {
		// T118057: wrap the collection of handlers in a WhatFailureGroupHandler
		// to swallow any exceptions that might leak out otherwise
		$failureGroupHandler = 'failuregroup|' . implode( '|', $handlers );
		if ( !isset( $wmgMonologConfig['handlers'][$failureGroupHandler] ) ) {
			$wmgMonologConfig['handlers'][$failureGroupHandler] = [
				'class' => '\\Monolog\\Handler\\WhatFailureGroupHandler',
				'args' => [
					function () use ( $handlers ) {
						$provider = LoggerFactory::getProvider();

						return array_map( [ $provider, 'getHandler' ], $handlers );
					},
				],
			];
		}
		$wmgMonologConfig['loggers'][$channel] = [
			'handlers' => [ $failureGroupHandler ],
			'processors' => array_keys( $wmgMonologProcessors ),
			'calls' => $wmgMonologLoggerCalls,
		];
	} else {
		// No handlers configured, so use the blackhole route
		$wmgMonologConfig['loggers'][$channel] = [
			'handlers' => [ 'blackhole' ],
			'calls' => $wmgMonologLoggerCalls,
		];
	}
}

$wgMWLoggerDefaultSpi = [
	'class' => '\\MediaWiki\\Logger\\MonologSpi',
	'args' => [ $wmgMonologConfig ],
];
