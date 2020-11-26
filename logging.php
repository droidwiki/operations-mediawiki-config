<?php

/**
 * MediaWiki logging configuration based on the Wikimedia Foundation logging configuration:
 * https://github.com/wikimedia/operations-mediawiki-config/blob/3373247e123b5386a2189a7d8f8ecd4e9aa4744d/wmf-config/logging.php
 */

use MediaWiki\Logger\LoggerFactory;

$wmgMonologChannels = [
	'api-request' => [
		'level' => 'error',
		'buffer' => true,
	],
	'authentication' => 'info',
	'BlockManager' => 'info',
	'cirrussearch-request' => [
		'level' => 'error',
		'buffer' => true,
	],
	'csp' => 'info',
	'csp-report-only' => 'info',
	'deprecated' => 'debug',
	'Elastica' => 'info',
	'exception' => false,
	'exception-json' => 'info',
	'GlobalTitleFail' => [ 'sample' => 10000 ],
	'LockManager' => 'warning',
	'logging' => 'debug',
	'recursion-guard' => 'debug',
	'redis' => 'info',
	'resourceloader' => 'info',
	'RevisionStore' => 'info',
	'runJobs' => 'debug',
	'security' => 'debug',
	'session-ip' => 'info',
	'slow-parse' => 'info',
	'throttler' => 'info',
	'wfDebug' => false,
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
		'level' => 'warning',
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
