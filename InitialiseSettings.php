<?php

global $wgConf;

$wgConf->settings = [
	'wgSitename' => [
		'default' => 'Android Wiki',
		'opswiki' => 'DroidWiki Operations',
		'testdroidwiki' => 'Android Test-Wiki',
		'datawiki' => 'DroidWiki Data',
	],

	'wgMetaNamespace' => [
		'default' => 'DroidWiki',
		'opswiki' => 'Project',
		'datawiki' => 'Data',
	],

	'wgServer' => [
		'droidwiki' => 'https://www.droidwiki.de',
		'opswiki' => '//ops.go2tech.de',
		'datawiki' => 'https://data.droidwiki.de',
	],

	'wgCanonicalServer' => [
		'droidwiki' => 'https://www.droidwiki.de',
		'opswiki' => 'http://ops.go2tech.de',
		'datawiki' => 'https://data.droidwiki.de',
	],

	'wgLogo' => [
		// possible values:
		// androide.png -> blank DroidWiki logo
		// androide_ch.png -> DroidWiki logo with christmas hat
		'default' => '',
		'droidwiki' => '/static/images/project-logos/androide.png',
		'datawiki' => '/static/images/project-logos/androide.png',
	],

	'wgFavicon' => [
		'default' => '/static/images/favicons/favicon_with_W.ico',
	],

	'wgEmergencyContact' => [
		'default' => 'info@go2tech.de',
		'droidwiki' => 'info@droidwiki.de',
		'datawiki' => 'info@droidwiki.de',
	],

	'wgPasswordSender' => [
		'default' => 'info@go2tech.de',
		'droidwiki' => 'info@droidwiki.de',
		'datawiki' => 'info@droidwiki.de',
	],

	'wgLocaltimezone' => [
		'default' => 'Europe/Berlin',
	],

	'wgCookieDomain' => [
		'default' => '',
		'droidwiki' => '.droidwiki.de',
		'datawiki' => '.droidwiki.de',
		'testdroidwiki' => '.go2tech.de',
		'opswiki' => '.ops.go2tech.de',
	],

	'wgDefaultSkin' => [
		'default' => 'vector',
	],

	'wgUseRCPatrol' => [
		'default' => true,
	],

	'+wgGroupPermissions' => [
		'default' => [
			'emailconfirmed' => [
				'emailconfirmed' => true,
			],
			'sysop' => [
				'upload_by_url' => true,
				// this should  be an own group "Translation admin"
				'pagelang' => true,
			],
			'bureaucrat' => [
				'userrights' => true,
			],
			'suppress' => [
				'deleterevision' => true,
				'suppressrevision' => true,
				'deletelogentry' => true,
				'deleterevision' => true,
				'suppressionlog' => true,
				'hideuser' => true,
			],
		],
		'+droidwiki' => [
			'Autopatrol' => [
				'autopatrol' => true,
			],
			'Moderator' => [
				'autopatrol' => true,
				'proxyunbannable' => true,
				'delete' => true,
				'patrol' => true,
			],
			'Testnutzer' => [],
			'ipblock-exempt' => [
				'ipblock-exempt' => true,
			],
		],
		'+testdroidwiki' => [
			'Autopatrol' => [
				'autopatrol' => true,
			],
			'Moderator' => [
				'autopatrol' => true,
				'proxyunbannable' => true,
				'delete' => true,
				'patrol' => true,
			],
			'Testnutzer' => [],
		],
		'+opswiki' => [
			'Operations' => [
				'read' => true,
				'edit' => true,
			],
		],
	],

	'groupOverrides' => [
		// don't change the default value
		'default' => [],
		'droidwiki' => [
			'*' => [
				'translate' => true,
			],
			'sysop' => [
				'pagetranslation' => true,
				'translate-manage' => true,
			],
		],
		'datawiki' => [
			'*' => [
				'property-create' => false,
			],
			'sysop' => [
				'property-create' => true,
			],
		],
		'opswiki' => [
			'*' => [
				'read' => false,
				'edit' => false,
				'createaccount' => false,
				'autocreateaccount' => true,
			],
			'user' => [
				'read' => false,
				'edit' => false,
				'createaccount' => 'false',
			],
			'autoconfirmed' => [
				'read' => false,
				'edit' => false,
				'createaccount' => false,
			],
		],
	],

	'wgWhitelistRead' => [
		'default' => false,
		'opswiki' => [ 'Hauptseite', 'Spezial:Einstellungen', 'Spezial:ChangeCredentials', 'Spezial:OATH', 'Spezial:E-Mail-Adresse_ändern', 'Spezial:E-Mail_bestätigen', 'Spezial:Abmelden', ],
	],

	'wgAllowUserJs' => [
		'default' => false,
		'droidwiki' => true,
	],

	'wgMaxImageArea' => [
		'default' => 5e7,
	],

	'wgUseInstantCommons' => [
		'default' => true,
		'opswiki' => false,
	],

	'wgSVGConverters' => [
		'default' => [ 'ImageMagick' => '/usr/bin/convert $input -background transparent $output' ],
	],

	'wgSVGConverter' => [
		'default' => 'ImageMagick',
	],

	'wgSVGConverterPath' => [
		'default' => '/usr/bin/',
	],

	'wgMainCacheType' => [
		'default' => CACHE_MEMCACHED,
	],

	'wgParserCacheType' => [
		'default' => CACHE_MEMCACHED,
	],

	'wgMessageCacheType' => [
		'default' => CACHE_MEMCACHED,
	],

	'wgSessionCacheType' => [
		'default' => CACHE_MEMCACHED,
	],

	'wgSessionsInObjectCache' => [
		'default' => false,
		'droidwiki' => true,
		'datawiki' => true,
	],

	'wgMemCachedServers' => [
		'default' => [ '127.0.0.1:11211' ],
	],

	'wgShowDebug' => [
		'default' => false,
	],

	'wgShowExceptionDetails' => [
		'default' => false,
		'testdroidwiki' => true,
	],

	'wgShowSQLErrors' => [
		'default' => false,
	],

	'wgCrossSiteAJAXdomains' => [
		'default' => [],
		'droidwiki' => [ '*.droidwiki.de' ],
		'datawiki' => [ '*.droidwiki.de' ],
	],

	'wmgCirrusSearchPowerSpecialRandom' => [
		'default' => false,
		'testdroidwiki' => true,
	],

	'wgCacheDirectory' => [
		'default' => '/data/mediawiki/localisationCache/',
		'datawiki' => '/data/mediawiki/localisationCache/datawiki/',
		'droidwiki' => '/data/mediawiki/localisationCache/droidwiki/',
	],

	'wgGitInfoCacheDirectory' => [
		'droidwiki' => '/data/mediawiki/main/cache/gitinfo',
		'datawiki' => '/data/mediawiki/main/cache/gitinfo',
	],

	'wgLocalisationCacheConf' => [
		'default' => [
			'class' => 'LocalisationCache',
			'store' => 'detect',
			'storeClass' => false,
			'manualRecache' => true,
		],
	],

	'wgDBerrorLog' => [
		'default' => false,
		'droidwiki' => '/data/www/droidwiki.de/phplog/dberror_droidwiki.log',
		'datawiki' => '/data/www/droidwiki.de/phplog/dberror_datawiki.log',
	],

	'wgDebugLogGroups' => [
		'default' => [],
		'droidwiki' => [
			'resourceloader' => '/data/www/droidwiki.de/phplog/resourceloader_droidwiki.log',
			'exception' => '/data/www/droidwiki.de/phplog/exception_droidwiki.log',
			'error' => '/data/www/droidwiki.de/phplog/exception_droidwiki.log',
			'ratelimit' => '/data/www/droidwiki.de/phplog/ratelimit_droidwiki.log',
			'DBPerformance' => '/data/www/droidwiki.de/phplog/dbperformance_droidwiki.log',
		],
		'datawiki' => [
			'resourceloader' => '/data/www/droidwiki.de/phplog/resourceloader_datawiki.log',
                        'exception' => '/data/www/droidwiki.de/phplog/exception_datawiki.log',
                        'error' => '/data/www/droidwiki.de/phplog/exception_datawiki.log',
                        'ratelimit' => '/data/www/droidwiki.de/phplog/ratelimit_datawiki.log',
                        'DBPerformance' => '/data/www/droidwiki.de/phplog/dbperformance_datawiki.log',
		],
	],

	'wgDebugLogFile' => [
		'default' => '',
		'droidwiki' => '/data/www/droidwiki.de/phplog/debug_droidwiki.log',
	],

	'wgRightsUrl' => [
		'default' => null,
		'droidwiki' => '//creativecommons.org/licenses/by-sa/3.0/',
		'datawiki' => '//creativecommons.org/licenses/by-sa/3.0/',
	],

	'wgRightsText' => [
		'default' => null,
		'droidwiki' => 'Creative Commons Attribution-Share Alike 3.0',
		'datawiki' => 'Creative Commons Attribution-Share Alike 3.0',
	],

	'wgRightsIcon' => [
		'default' => null,
		'droidwiki' => '//creativecommons.org/images/public/somerights20.png',
		'datawiki' => '//creativecommons.org/images/public/somerights20.png',
	],

	'+wgObjectCaches' => [
		'default' => [],
		'droidwiki' => [
			'redis' => [
				'class' => 'RedisBagOStuff',
		                'servers' => [ '127.0.0.1:6379' ],
			],
		],
		'datawiki' => [
			'redis' => [
				'class' => 'RedisBagOStuff',
				'servers' => [ '127.0.0.1:6379' ],
			],
		],
	],

	'wgJobTypeConf' => [
		'droidwiki' => [
			'default' => [
				'class' => 'JobQueueRedis',
				'redisServer' => '127.0.0.1:6379',
				'redisConfig' => [],
				'claimTTL' => 3600,
				'daemonized' => true,
			],
		],
		'datawiki' => [
			'default' => [
				'class' => 'JobQueueRedis',
				'redisServer' => '127.0.0.1:6379',
				'redisConfig' => [],
				'claimTTL' => 3600,
				'daemonized' => true,
			],
		],
	],

	'wgJobQueueAggregator' => [
		'droidwiki' => [
			'class'        => 'JobQueueAggregatorRedis',
			'redisServers' => [
				'localhost',
			],
			'redisConfig'  => [
				'connectTimeout' => 2,
			],
		],
		'datawiki' => [
			'class' => 'JobQueueAggregatorRedis',
			'redisServers' => [
				'localhost',
			],
			'redisConfig'  => [
				'connectTimeout' => 2,
			],
		],
	],

	// temporary, should be removed when all authentication providers used, switched to AuthManager
	'wgDisableAuthManager' => [
		'default' => false,
	],

	// usage of extensions
	'wmgUseLdapAuthentication' => [
		'default' => false,
		'opswiki' => true,
	],

	'wmgUseGoogleLogin' => [
		'default' => true,
		'opswiki' => false,
	],

	'wmgUsegoogleAnalytics' => [
		'default' => false,
		'droidwiki' => true,
	],

	'wmgUseTranslate' => [
		'default' => false,
		'droidwiki' => true,
	],

	'wmgUseWikibaseRepo' => [
		'default' => false,
		'datawiki' => true,
	],

	'wmgUseWikibaseClient' => [
		'default' => false,
		'droidwiki' => true,
	],

	'wmgUseSocialButtons' => [
		'default' => true,
		'datawiki' => false,
	],

	'wmgUseDroidWiki' => [
		'default' => true,
	],

	'wmgUseOATHAuth' => [
		'default' => true,
	],

	'wmgUseXenForoAuth' => [
		'default' => false,
		'opswiki' => true,
	],

	// needed for Translate extension to change the language on-wiki
	'wgPageLanguageUseDB' => [
		'default' => false,
		'droidwiki' => true,
	],

	'wgStatsdServer' => [
		'default' => false,
		'droidwiki' => '188.68.49.74:8125',
	],

	'wgSharedDB' => [
		'default' => null,
		'datawiki' => 'droidwikiwiki',
	],

	'wgSharedTables' => [
		'default' => [ 'user', 'user_properties' ],
		'+datawiki' => [ 'user_google_user', 'user_groups', 'oathauth_users' ],
	],

	'wmgUseParsoid' => [
		'default' => true,
	],

	'wmgParsoidForwardCookies' => [
		'default' => false,
		'opswiki' => true,
	],
];
