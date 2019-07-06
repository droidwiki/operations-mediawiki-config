<?php

$wgMWLoggerDefaultSpi = [
	'class' => '\\MediaWiki\\Logger\\MonologSpi',
	'args' => [
		[
			'loggers' => [
				'@default' => [
					'processors' => [ 'wiki', 'psr', 'pid', 'uid', 'web' ],
					'handlers' => [ 'default' ],
				],
				'wfDebug' => [
					'handlers' => [ 'blackhole' ],
				],
				'profileoutput' => [
					'handlers' => [ 'profiler' ],
					'processors' => [ 'psr' ],
				],
			],

			'processors' => [
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
			],

			'handlers' => [
				'default' => [
					'class' => '\\MediaWiki\\Logger\\Monolog\\LegacyHandler',
					'args' => [ '/data/log/mediawiki/monolog-' . date( 'Ymd' ) . '.log' ],
					'formatter' => 'line',
				],
				'profiler' => [
					'class' => '\\MediaWiki\\Logger\\Monolog\\LegacyHandler',
					'args' => [ '/data/log/mediawiki/profiler-' . date( 'Ymd' ) . '.log' ],
					'formatter' => 'profiler',
				],
				'blackhole' => [
					'class' => '\\Monolog\\Handler\\NullHandler',
				],
			],

			'formatters' => [
				'line' => [
					'class' => '\\Monolog\\Formatter\\LineFormatter',
				],
				'profiler' => [
					'class' => '\\Monolog\\Formatter\\LineFormatter',
					'args' => [ "%datetime% %message%\n\n", null, true, true ],
				],
			],
		],
	],
];
