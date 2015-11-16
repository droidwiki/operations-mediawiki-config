<?php

global $wgConf;

$wgConf->settings = array(
	'wgSitename' => array(
		'default' => 'Android Wiki',
		'opswiki' => 'DroidWiki Operations',
		'testdroidwiki' => 'Android Test-Wiki',
	),

	'wgMetaNamespace' => array(
		'default' => 'DroidWiki',
		'opswiki' => 'Project',
	),

	'wgServer' => array(
		'droidwiki' => '//www.droidwiki.de',
		'opswiki' => '//ops.go2tech.de',
	),

	'wgLogo' => array(
		'default' => '',
		'droidwiki' => '/static/images/project-logos/androide.png',
	),

	'wgLocaltimezone' => array(
		'default' => 'Europe/Berlin',
	),

	'wgCookieDomain' => array(
		'default' => '',
		'droidwiki' => '.droidwiki.de',
		'testdroidwiki' => '.go2tech.de',
		'opswiki' => '.ops.go2tech.de',
	),

	'wgDefaultSkin' => array(
		'default' => 'vector',
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
			'ipblock-exempt' => array(
				'ipblock-exempt' => true,
			),
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

	'groupOverrides' => array(
		// don't change the default value
		'default' => array(),
		'opswiki' => array(
			'*' => array(
				'read' => false,
				'edit' => false,
				'createaccount' => false
			),
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
		'opswiki' => false,
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
		'default' => CACHE_MEMCACHED,
	),

	'wgParserCacheType' => array(
		'default' => CACHE_MEMCACHED,
	),

	'wgMessageCacheType' => array(
		'default' => CACHE_MEMCACHED,
	),

	'wgSessionCacheType' => array(
		'default' => CACHE_MEMCACHED,
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
		'default' => '/data/mediawiki/localisationCache/',
	),

	'wgGitInfoCacheDirectory' => array(
		'droidwiki' => '/data/mediawiki/main/cache/gitinfo',
	),

	'wgLocalisationCacheConf' => array(
		'default' => array(
			'class' => 'LocalisationCache',
			'store' => 'detect',
			'storeClass' => false,
			'manualRecache' => true,
		),
	),

	'wgDBerrorLog' => array(
		'default' => false,
		'droidwiki' => '/data/www/droid.wiki/phplog/dberror_droidwiki.log',
	),

	'wgDebugLogGroups' => array(
		'default' => array(),
		'droidwiki' => array(
			'resourceloader' => '/data/www/droid.wiki/phplog/resourceloader_droidwiki.log',
			'exception' => '/data/www/droid.wiki/phplog/exception_droidwiki.log',
			'error' => '/data/www/droid.wiki/phplog/exception_droidwiki.log',
			'ratelimit' => '/data/www/droid.wiki/phplog/ratelimit_droidwiki.log',
			'DBPerformance' => '/data/www/droid.wiki/phplog/dbperformance_droidwiki.log',
		),
	),

	'wgDebugLogFile' => array(
		'default' => '',
		'droidwiki' => '/data/www/droid.wiki/phplog/debug_droidwiki.log',
	),

	'wmgUseLdapAuthentication' => array(
		'default' => false,
		'opswiki' => true,
	),

	'wmgUseGoogleLogin' => array(
		'default' => true,
		'opswiki' => false,
	),
);
