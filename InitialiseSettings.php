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
		'droidwikiwiki' => 'https://www.droidwiki.org',
		'opswiki' => '//ops.go2tech.de',
		'datawiki' => 'https://data.droidwiki.org',
	],

	'wgCanonicalServer' => [
		'droidwikiwiki' => 'https://www.droidwiki.org',
		'opswiki' => 'http://ops.go2tech.de',
		'datawiki' => 'https://data.droidwiki.org',
	],

	'wgLogo' => [
		// possible values:
		// androide.png -> blank DroidWiki logo
		// androide_ch.png -> DroidWiki logo with christmas hat
		'default' => '',
		'droidwikiwiki' => '/static/images/project-logos/androide.png',
		'datawiki' => '/static/images/project-logos/androide.png',
	],

	'wgFavicon' => [
		'default' => '/static/images/favicons/favicon_with_W.ico',
	],

	'wgEmergencyContact' => [
		'default' => 'info@go2tech.de',
		'droidwikiwiki' => 'info@droidwiki.de',
		'datawiki' => 'info@droidwiki.de',
	],

	'wgPasswordSender' => [
		'default' => 'info@go2tech.de',
		'droidwikiwiki' => 'info@droidwiki.de',
		'datawiki' => 'info@droidwiki.de',
	],

	'wgLocaltimezone' => [
		'default' => 'Europe/Berlin',
	],

	'wgCookieDomain' => [
		'default' => '',
		'droidwikiwiki' => '.droidwiki.org',
		'datawiki' => '.droidwiki.org',
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
		'droidwikiwiki' => [
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
		'droidwikiwiki' => true,
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
		'droidwikiwiki' => true,
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
		'droidwikiwiki' => [ '*.droidwiki.de', '*.droidwiki.org' ],
		'datawiki' => [ '*.droidwiki.de', '*.droidwiki.org' ],
	],

	'wmgCirrusSearchPowerSpecialRandom' => [
		'default' => false,
		'testdroidwiki' => true,
	],

	'wgCacheDirectory' => [
		'default' => '/data/mediawiki/localisationCache/',
		'datawiki' => '/data/mediawiki/localisationCache/datawiki/',
		'droidwikiwiki' => '/data/mediawiki/localisationCache/droidwiki/',
	],

	'wgGitInfoCacheDirectory' => [
		'droidwikiwiki' => '/data/mediawiki/main/cache/gitinfo',
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

	'wgRightsUrl' => [
		'default' => null,
		'droidwikiwiki' => '//creativecommons.org/licenses/by-sa/3.0/',
		'datawiki' => '//creativecommons.org/licenses/by-sa/3.0/',
	],

	'wgRightsText' => [
		'default' => null,
		'droidwikiwiki' => 'Creative Commons Attribution-Share Alike 3.0',
		'datawiki' => 'Creative Commons Attribution-Share Alike 3.0',
	],

	'wgRightsIcon' => [
		'default' => null,
		'droidwikiwiki' => '//creativecommons.org/images/public/somerights20.png',
		'datawiki' => '//creativecommons.org/images/public/somerights20.png',
	],

	'+wgObjectCaches' => [
		'default' => [],
		'droidwikiwiki' => [
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
		'droidwikiwiki' => [
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
		'droidwikiwiki' => [
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
		'droidwikiwiki' => true,
	],

	'wmgUseTranslate' => [
		'default' => false,
		'droidwikiwiki' => true,
	],

	'wmgUseWikibaseRepo' => [
		'default' => false,
		'datawiki' => true,
	],

	'wmgUseWikibaseClient' => [
		'default' => false,
		'droidwikiwiki' => true,
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
		'default' => true,
		'opswiki' => false,
	],

	// needed for Translate extension to change the language on-wiki
	'wgPageLanguageUseDB' => [
		'default' => false,
		'droidwikiwiki' => true,
	],

	'wgSharedDB' => [
		'default' => null,
		'datawiki' => 'droidwikiwiki',
	],

	'wgSharedTables' => [
		'default' => [ 'user', 'user_properties' ],
		'+datawiki' => [ 'user_google_user', 'user_xenforo_user', 'user_groups', 'oathauth_users' ],
	],

	'wmgUseParsoid' => [
		'default' => true,
	],

	'wmgParsoidForwardCookies' => [
		'default' => false,
		'opswiki' => true,
	],
];
