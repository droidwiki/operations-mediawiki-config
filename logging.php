<?php

$wgMWLoggerDefaultSpi = array(
    'class' => '\\MediaWiki\\Logger\\MonologSpi',
    'args' => array( array(
        'loggers' => array(
            '@default' => array(
                'processors' => array( 'wiki', 'psr', 'pid', 'uid', 'web' ),
                'handlers'   => array( 'default' ),
            ),
            'wfDebug' => array(
                'handlers'   => array( 'default' ),
                'processors' => array( 'psr' ),
            ),
            'profileoutput' => array(
                'handlers'   => array( 'profiler' ),
                'processors' => array( 'psr' ),
            ),
        ),

        'processors' => array(
            'wiki' => array(
                'class' => '\\MediaWiki\\Logger\\Monolog\\WikiProcessor',
            ),
            'psr' => array(
                'class' => '\\Monolog\\Processor\\PsrLogMessageProcessor',
            ),
            'pid' => array(
                'class' => '\\Monolog\\Processor\\ProcessIdProcessor',
            ),
            'uid' => array(
                'class' => '\\Monolog\\Processor\\UidProcessor',
            ),
            'web' => array(
                'class' => '\\Monolog\\Processor\\WebProcessor',
            ),
        ),

        'handlers' => array(
            'default' => array(
                'class' => '\\MediaWiki\\Logger\\Monolog\\LegacyHandler',
                'args' => array( '/data/log/mediawiki/monolog-'.date('Ymd').'.log' ),
                'formatter' => 'line',
            ),
            'profiler' => array(
                'class' => '\\MediaWiki\\Logger\\Monolog\\LegacyHandler',
                'args' => array( '/data/log/mediawiki/profiler-'.date('Ymd').'.log' ),
                'formatter' => 'profiler',
            ),
        ),

        'formatters' => array(
            'line' => array(
                'class' => '\\Monolog\\Formatter\\LineFormatter',
            ),
            'profiler' => array(
                'class' => '\\Monolog\\Formatter\\LineFormatter',
                'args' => array( "%datetime% %message%\n\n", null, true, true ),
            ),
        ),
    ) ),
);
