<?php

global $wgConf;

$wgConf->settings = array(
	'wgSitename' => array(
		'default' => 'Android Wiki',
		'opswiki' => 'DroidWiki Operations',
		'testdroidwiki' => 'Android Test-Wiki',
		'datawiki' => 'DroidWiki Data',
	),

	'wgMetaNamespace' => array(
		'default' => 'DroidWiki',
		'opswiki' => 'Project',
		'datawiki' => 'Data',
	),

	'wgServer' => array(
		'droidwiki' => 'https://www.droidwiki.de',
		'opswiki' => '//ops.go2tech.de',
		'datawiki' => 'https://data.droidwiki.de',
	),

	'wgCanonicalServer' => array(
		'droidwiki' => 'https://www.droidwiki.de',
		'opswiki' => 'http://ops.go2tech.de',
		'datawiki' => 'https://data.droidwiki.de',
	),

	'wgLogo' => array(
		// possible values:
		// androide.png -> blank DroidWiki logo
		// androide_ch.png -> DroidWiki logo with christmas hat
		'default' => '',
		'droidwiki' => '/static/images/project-logos/androide.png',
		'datawiki' => '/static/images/project-logos/androide.png',
	),

	'wgLocaltimezone' => array(
		'default' => 'Europe/Berlin',
	),

	'wgCookieDomain' => array(
		'default' => '',
		'droidwiki' => '.droidwiki.de',
		'datawiki' => '.droidwiki.de',
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
				// this should  be an own group "Translation admin"
				'pagelang' => true,
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
		'droidwiki' => array(
			'*' => array(
				'translate' => true,
			),
			'sysop' => array(
				'pagetranslation' => true,
				'translate-manage' => true,
			),
		),
		'datawiki' => array(
			'*' => array(
				'property-create' => false,
			),
			'sysop' => array(
				'property-create' => true,
			),
		),
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
		'datawiki' => true,
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

	'wgCrossSiteAJAXdomains' => array(
		'default' => array(),
		'droidwiki' => array( '*.droidwiki.de' ),
		'datawiki' => array( '*.droidwiki.de' ),
	),

	'wmgCirrusSearchPowerSpecialRandom' => array(
		'default' => false,
		'testdroidwiki' => true,
	),

	'wgCacheDirectory' => array(
		'default' => '/data/mediawiki/localisationCache/',
		'datawiki' => '/data/mediawiki/localisationCache/datawiki/',
		'droidwiki' => '/data/mediawiki/localisationCache/droidwiki/',
	),

	'wgGitInfoCacheDirectory' => array(
		'droidwiki' => '/data/mediawiki/main/cache/gitinfo',
		'datawiki' => '/data/mediawiki/main/cache/gitinfo',
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
		'datawiki' => '/data/www/droid.wiki/phplog/dberror_datawiki.log',
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
		'datawiki' => array(
			'resourceloader' => '/data/www/droid.wiki/phplog/resourceloader_datawiki.log',
                        'exception' => '/data/www/droid.wiki/phplog/exception_datawiki.log',
                        'error' => '/data/www/droid.wiki/phplog/exception_datawiki.log',
                        'ratelimit' => '/data/www/droid.wiki/phplog/ratelimit_datawiki.log',
                        'DBPerformance' => '/data/www/droid.wiki/phplog/dbperformance_datawiki.log',
		),
	),

	'wgDebugLogFile' => array(
		'default' => '',
		'droidwiki' => '/data/www/droid.wiki/phplog/debug_droidwiki.log',
	),

	'wgRightsUrl' => array(
		'default' => null,
		'droidwiki' => '//creativecommons.org/licenses/by-sa/3.0/',
		'datawiki' => '//creativecommons.org/licenses/by-sa/3.0/',
	),

	'wgRightsText' => array(
		'default' => null,
		'droidwiki' => 'Creative Commons Attribution-Share Alike 3.0',
		'datawiki' => 'Creative Commons Attribution-Share Alike 3.0',
	),

	'wgRightsIcon' => array(
		'default' => null,
		'droidwiki' => '//creativecommons.org/images/public/somerights20.png',
		'datawiki' => '//creativecommons.org/images/public/somerights20.png',
	),

	'+wgObjectCaches' => array(
		'default' => array(),
		'droidwiki' => array(
			'redis' => array(
				'class' => 'RedisBagOStuff',
		                'servers' => array( '127.0.0.1:6379' ),
			),
		),
		'datawiki' => array(
                        'redis' => array(
                                'class' => 'RedisBagOStuff',
                                'servers' => array( '127.0.0.1:6379' ),
                        ),
                ),
	),

	'wgJobTypeConf' => array(
		'droidwiki' => array(
			'default' => array(
				'class' => 'JobQueueRedis',
				'redisServer' => '127.0.0.1:6379',
				'redisConfig' => array(),
				'claimTTL' => 3600,
				'daemonized' => true,
			),
		),
		'datawiki' => array(
                        'default' => array(
                                'class' => 'JobQueueRedis',
                                'redisServer' => '127.0.0.1:6379',
                                'redisConfig' => array(),
                                'claimTTL' => 3600,
                                'daemonized' => true,
                        ),
                ),
	),

	'wgJobQueueAggregator' => array(
		'droidwiki' => array(
			'class'        => 'JobQueueAggregatorRedis',
			'redisServers' => array(
				'localhost',
			),
			'redisConfig'  => array(
				'connectTimeout' => 2,
			),
		),
		'datawiki' => array(
                        'class'        => 'JobQueueAggregatorRedis',
                        'redisServers' => array(
                                'localhost',
                        ),
                        'redisConfig'  => array(
                                'connectTimeout' => 2,
                        ),
                ),
	),

	// temporary, should be removed when all authentication providers used, switched to AuthManager
	'wgDisableAuthManager' => array(
		'default' => true,
	);

	// usage of extensions
	'wmgUseLdapAuthentication' => array(
		'default' => false,
		'opswiki' => true,
	),

	'wmgUseGoogleLogin' => array(
		'default' => true,
		'opswiki' => false,
	),

	'wmgUsegoogleAnalytics' => array(
		'default' => false,
		'droidwiki' => true,
	),

	'wmgUseTranslate' => array(
		'default' => false,
		'droidwiki' => true,
	),

	'wmgUseWikibaseRepo' => array(
		'default' => false,
		'datawiki' => true,
	),

        'wmgUseWikibaseClient' => array(
                'default' => false,
                'droidwiki' => true,
        ),

	'wmgUseSocialButtons' => array(
		'default' => true,
		'datawiki' => false,
	),

	'wmgUseDroidWiki' => array(
		'default' => true,
	),

	// needed for Translate extension to change the language on-wiki
	'wgPageLanguageUseDB' => array(
		'default' => false,
		'droidwiki' => true,
	),

	'wgStatsdServer' => array(
		'default' => false,
		'droidwiki' => '188.68.49.74:8125',
	),

	'wgSharedDB' => array(
		'default' => null,
		'datawiki' => 'droidwikiwiki',
	),

	'wgSharedTables' => array(
		'default' => array( 'user', 'user_properties' ),
		'+datawiki' => array( 'user_google_user', 'user_groups' ),
	),

	'wmgUseParsoid' => array(
		'default' => true,
	),

	'wmgParsoidForwardCookies' => array(
		'default' => false,
		'opswiki' => true,
	),
);
