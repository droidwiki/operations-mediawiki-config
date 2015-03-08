<?php

global $wgConf;

$wgConf->settings = array(
	'wgSitename' => array(
		'default' => 'Android Wiki',
		'testdroidwiki' => 'Android Test-Wiki',
	),

	'wgMetaNamespace' => array(
		'default' => 'DroidWiki',
	),

	'wgLocaltimezone' => array(
		'default' => 'Europe/Berlin',
	),

	'wgCookieDomain' => array(
		'default' => '',
		'droidwiki' => '.droidwiki.de',
		'testdroidwiki' => '.go2tech.de',
	),

	'wgDefaultSkin' => array(
		'default' => 'droidwiki',
	),

	'wgUseRCPatrol' => array(
		'default' => true,
	),

	'+wgGroupPermissions' => array(
		'default' => array(
			'emailconfirmed' => array(
				'emailconfirmed' => true,
			),
			'sysop' => array(
				'upload_by_url' => true,
			),
			'bureaucrat' => array(
				'userrights' => true,
			),
			'suppress' => array(
				'deleterevision' => true,
				'suppressrevision' => true,
				'deletelogentry' => true,
				'deleterevision' => true,
				'suppressionlog' => true,
				'hideuser' => true,
			),
		),
		'+droidwiki' => array(
			'Autopatrol' => array(
				'autopatrol' => true,
			),
			'Moderator' => array(
				'autopatrol' => true,
				'proxyunbannable' => true,
				'delete' => true,
				'patrol' => true,
			),
			'Testnutzer' => array(),
		),
		'+testdroidwiki' => array(
			'Autopatrol' => array(
				'autopatrol' => true,
			),
			'Moderator' => array(
				'autopatrol' => true,
				'proxyunbannable' => true,
				'delete' => true,
				'patrol' => true,
			),
			'Testnutzer' => array(),
		),
	),

	'wgAllowUserJs' => array(
		'default' => false,
		'droidwiki' => true,
	),

	'wgMaxImageArea' => array(
		'default' => 5e7,
	),

	'wgUseInstantCommons' => array(
		'default' => true,
	),

	'wgSVGConverters' => array(
		'default' => array( 'ImageMagick' => '/usr/bin/convert $input -background transparent $output' ),
	),

	'wgSVGConverter' => array(
		'default' => 'ImageMagick',
	),

	'wgSVGConverterPath' => array(
		'default' => '/usr/bin/',
	),

	'wgMainCacheType' => array(
		'default' => CACHE_NONE,
		'testdroidwiki' => CACHE_MEMCACHED,
	),

	'wgParserCacheType' => array(
		'default' => CACHE_NONE,
		'droidwiki' => CACHE_DB,
		'testdroidwiki' => CACHE_MEMCACHED,
	),

	'wgMessageCacheType' => array(
		'default' => CACHE_NONE,
		'droidwiki' => CACHE_DB,
		'testdroidwiki' => CACHE_MEMCACHED,
	),

	'wgSessionCacheType' => array(
		'default' => CACHE_NONE,
		'droidwiki' => CACHE_DB,
	),

	'wgSessionsInObjectCache' => array(
		'default' => false,
		'droidwiki' => true,
	),

	'wgMemCachedServers' => array(
		'default' => array( '127.0.0.1:11211' ),
	),

	'wgShowDebug' => array(
		'default' => false,
	),

	'wgShowExceptionDetails' => array(
		'default' => false,
		'testdroidwiki' => true,
	),

	'wgShowSQLErrors' => array(
		'default' => false,
	),

	'wmgCirrusSearchPowerSpecialRandom' => array(
		'default' => false,
		'testdroidwiki' => true,
	),

	'wgCacheDirectory' => array(
		'default' => false,
		'droidwiki' => '/var/www/web20/html/localisationCache/',
	),

	'wgLocalisationCacheConf' => array(
		'default' => array(
			'class' => 'LocalisationCache',
			'store' => 'detect',
			'storeClass' => false,
			'manualRecache' => false,
		),
		'+droidwiki' => array(
			'manualRecache' => true,
		),
	),
	
	'wgDBerrorLog' => array(
		'default' => false,
		'droidwiki' => '/var/www/web20/html/phplog/dberror_droidwiki.log',
	),

	'wgDebugLogGroups' => array(
		'default' => array(),
		'droidwiki' => array(
			'resourceloader' => '/var/www/web20/html/phplog/resourceloader_droidwiki.log',
			'exception' => '/var/www/web20/html/phplog/exception_droidwiki.log',
			'error' => '/var/www/web20/html/phplog/exception_droidwiki.log',
			'ratelimit' => '/var/www/web20/html/phplog/ratelimit_droidwiki.log',
		),
	),
);
