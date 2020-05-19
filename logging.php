<?php

/**
 * MediaWiki logging configuration based on the Wikimedia Foundation logging configuration:
 * https://github.com/wikimedia/operations-mediawiki-config/blob/3373247e123b5386a2189a7d8f8ecd4e9aa4744d/wmf-config/logging.php
 */

use MediaWiki\Logger\LoggerFactory;

$wmgMonologChannels = [
	'404' => 'debug',
	'AbuseFilter' => 'debug',
	'AdHocDebug' => 'debug',
	'antispoof' => 'debug',
	'api' => 'debug',
	'api-feature-usage' => 'debug',
	'api-readonly' => 'debug',
	'api-request' => [
		'level' => 'error',
		'buffer' => true,
	],
	'api-warning' => 'debug',
	'authentication' => 'info',
	'autoloader' => 'debug',
	'badpass' => 'debug',
	'badpass-priv' => 'debug',
	'BlockManager' => 'info',
	'BounceHandler' => 'debug',
	'Bug58676' => 'debug',
	'captcha' => 'debug',
	'CentralAuth' => 'debug',
	'CentralAuthRename' => 'debug',
	'CentralAuthUserMerge' => 'debug',
	'CentralNotice' => 'debug',
	'CirrusSearch' => 'debug',
	'cirrussearch-request' => [
		'level' => 'debug',
		'buffer' => true,
	],
	'CirrusSearchChangeFailed' => 'debug',
	'CirrusSearchSlowRequests' => 'debug',
	'cite' => 'debug',
	'Cognate' => 'debug',
	'collection' => 'debug',
	'csp' => 'info',
	'csp-report-only' => 'info',
	'DBConnection' => 'error',
	'DBPerformance' => 'warning',
	'DBQuery' => 'warning',
	'DBReplication' => 'warning',
	'DBTransaction' => 'debug',
	'DeferredUpdates' => 'error',
	'deprecated' => 'debug',
	'diff' => 'debug',
	'Echo' => 'debug',
	'Elastica' => 'info',
	'error' => 'debug',
	'EventBus' => 'debug',
	'EventLogging' => 'debug',
	'exception' => 'debug',
	'exception-json' => 'debug',
	'exec' => 'debug',
	'export' => 'debug',
	'ExtensionDistributor' => 'error',
	'ExternalStore' => 'debug',
	'fatal' => 'debug',
	'FileImporter' => 'debug',
	'FileOperation' => 'debug',
	'Flow' => 'debug',
	'FSFileBackend' => 'debug',
	'generated-pp-node-count' => 'debug',
	'GettingStarted' => 'debug',
	'GlobalTitleFail' => [ 'sample' => 10000 ],
	'goodpass' => 'debug',
	'goodpass-priv' => 'debug',
	'GrowthExperiments' => 'info',
	'headers-sent' => 'debug',
	'HttpError' => 'error',
	'JobExecutor' => 'debug',
	'ldap' => 'warning',
	'Linter' => 'debug',
	'LocalFile' => 'debug',
	'localisation' => 'info',
	'localhost' => 'debug',
	'LockManager' => 'warning',
	'logging' => 'debug',
	'LoginNotify' => 'debug',
	'MassMessage' => 'debug',
	'Math' => 'info',
	'memcached' => 'debug',
	'message-format' => 'debug',
	'MessageCacheError' => 'debug',
	'mobile' => 'debug',
	'NewUserMessage' => 'debug',
	'OAuth' => 'debug',
	'objectcache' => 'warning',
	'OutputBuffer' => 'debug',
	'PageTriage' => 'debug',
	'PageViewInfo' => 'info',
	'poolcounter' => 'debug',
	'preferences' => 'info',
	'purge' => 'debug',
	'query' => 'debug',
	'ratelimit' => 'debug',
	'readinglists' => 'warning',
	'recursion-guard' => 'debug',
	'RecursiveLinkPurge' => 'debug',
	'redis' => 'info',
	'Renameuser' => 'debug',
	'resourceloader' => 'info',
	'ResourceLoaderImage' => 'debug',
	'RevisionStore' => 'info',
	'runJobs' => 'debug',
	'SaveParse' => 'debug',
	'security' => 'debug',
	'session' => 'warning',
	'session-ip' => 'info',
	'SimpleAntiSpam' => 'debug',
	'slow-parse' => 'debug',
	'SpamBlacklistHit' => 'debug',
	'SpamRegex' => 'debug',
	'SQLBagOStuff' => 'debug',
	'StashEdit' => 'debug',
	'SwiftBackend' => 'debug',
	'texvc' => 'debug',
	'throttler' => 'info',
	'thumbnail' => 'debug',
	'thumbnailaccess' => 'debug',
	'TitleBlacklist-cache' => 'debug',
	'torblock' => 'debug',
	'TranslationNotifications.Jobs' => 'debug',
	'Translate.Jobs' => 'debug',
	'UpdateRepo' => 'debug',
	'updateTranstagOnNullRevisions' => 'debug',
	'upload' => 'debug',
	'VisualEditor' => 'debug',
	'wfLogDBError' => 'debug',
	'Wikibase' => 'info',
	'Wikibase.NewItemIdFormatter' => 'debug',
	'WikibaseQualityConstraints' => 'debug',
	'WikimediaEvents' => 'error',
	'WikitechGerritBan' => 'debug',
	'WikitechPhabBan' => 'debug',
	'WMDE' => 'debug',
	'xff' => 'debug',
	'XMP' => 'warning',
];

$todaysLoggingFile = '/data/log/mediawiki/monolog-' . date( 'Ymd' ) . '.log';

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
			'args' => [ $todaysLoggingFile ],
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
					$todaysLoggingFile,
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
