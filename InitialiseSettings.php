<?php

global $wgConf;

$wgConf->settings = [
	'wgSitename' => [
		'default' => 'Android Wiki',
		'opswiki' => 'DroidWiki Operations',
		'datawiki' => 'DroidWiki Data',
	],

	'wgMetaNamespace' => [
		'default' => 'DroidWiki',
		'opswiki' => 'Project',
		'datawiki' => 'Data',
	],

	'+wgNamespaceContentModels' => [
		'+opswiki' => [
			NS_TALK => 'flow-board',
		],
	],

	'wgLanguageCode' => [
		'default' => 'de',
		'endroidwikiwiki' => 'en',
	],

	'wgServer' => [
		'droidwikiwiki' => 'https://www.droidwiki.org',
		'endroidwikiwiki' => 'https://en.droidwiki.org',
		'opswiki' => '//ops.go2tech.de',
		'datawiki' => 'https://data.droidwiki.org',
	],

	'wgCanonicalServer' => [
		'droidwikiwiki' => 'https://www.droidwiki.org',
		'endroidwikiwiki' => 'https://en.droidwiki.org',
		'opswiki' => 'http://ops.go2tech.de',
		'datawiki' => 'https://data.droidwiki.org',
	],

	'wgArticlePath' => [
		'default' => '/wiki/$1',
	],

	'wgScriptPath' => [
		'default' => '/w',
	],

	'wgLogo' => [
		// possible values:
		// androide.png -> blank DroidWiki logo
		// androide_ch.png -> DroidWiki logo with christmas hat
		// androide_cog.png -> black/white DroidWiki logo with half cog (opswiki)
		'default' => '',
		'droidwikiwiki' => '/static/images/project-logos/androide.png',
		'endroidwikiwiki' => '/static/images/project-logos/androide.png',
		'datawiki' => '/static/images/project-logos/androide.png',
		"opswiki" => '/static/images/project-logos/androide_cog.png',
	],

	'wgFavicon' => [
		'default' => '/static/images/favicons/favicon.ico',
	],

	'wgEmergencyContact' => [
		'default' => 'info@droidwiki.org',
		'opswiki' => 'info@go2tech.de',
	],

	'wgPasswordSender' => [
		'default' => 'info@droidwiki.org',
		'opswiki' => 'info@go2tech.de',
	],

	'wgLocaltimezone' => [
		'default' => 'Europe/Berlin',
	],

	'wgCookieDomain' => [
		'default' => '',
		'droidwikiwiki' => '.droidwiki.org',
		'datawiki' => '.droidwiki.org',
		'endroidwikiwiki' => '.droidwiki.org',
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
				'checkuser' => true,
				'checkuser-log' => true,
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
		'+droidwikiwiki' => [
			'Autopatrol' => [
				'autopatrol' => true,
			],
			'Moderator' => [
				'autopatrol' => true,
				'proxyunbannable' => true,
				'delete' => true,
				'patrol' => true,
			],
			'ipblock-exempt' => [
				'ipblock-exempt' => true,
			],
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
		// allow emailconfirmed users to edit only, protect against massive spam
		'endroidwikiwiki' => [
			'*' => [
				'edit' => false,
				'createpage' => false,
			],
			'user' => [
				'edit' => false,
				'createpage' => false,
			],
			'emailconfirmed' => [
				'edit' => true,
				'createpage' => false,
			],
			'sysop' => [
				'createpage' => true,
			],
			'pagecreator' => [
				'createpage' => true,
			],
		],
		'droidwikiwiki' => [
			'*' => [
				'translate' => true,
				'edit' => false,
				'createpage' => false,
			],
			'sysop' => [
				'pagetranslation' => true,
				'translate-manage' => true,
			],
		],
		'datawiki' => [
			'*' => [
				'property-create' => false,
				'edit' => false,
			],
			'user' => [
				'edit' => false,
			],
			'emailconfirmed' => [
				'edit' => true,
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
		'default' => true,
		'opswiki' => false,
	],

	'wgMemCachedServers' => [
		'default' => [ 'donut.dwnet:11211', 'eclair.dwnet:11211' ],
	],

	'wgShowDebug' => [
		'default' => false,
	],

	'wgShowExceptionDetails' => [
		'default' => false,
	],

	'wgShowSQLErrors' => [
		'default' => false,
	],

	'wgCrossSiteAJAXdomains' => [
		'default' => [ '*.droidwiki.de', '*.droidwiki.org' ],
		'opswiki' => [],
	],

	'wgCacheDirectory' => [
		'default' => '/data/mediawiki/cache/',
	],

	'wgGitInfoCacheDirectory' => [
		'droidwikiwiki' => '/data/mediawiki/main/cache/gitinfo',
		'datawiki' => '/data/mediawiki/main/cache/gitinfo',
		'endroidwikiwiki' => '/data/mediawiki/main/cache/gitinfo',
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
		'default' => 'https://creativecommons.org/licenses/by-sa/3.0/deed',
		'droidwikiwiki' => 'https://creativecommons.org/licenses/by-sa/3.0/deed.de',
		'opswiki' => null,
	],

	'wgRightsText' => [
		'default' =>  'Creative Commons Attribution/Share-Alike Lizenz 3.0',
		'opswiki' => null,
	],

	'wgRightsIcon' => [
		'default' => '//creativecommons.org/images/public/somerights20.png',
		'opswiki' => null,
	],

	'+wgObjectCaches' => [
		'default' => [
			'redis' => [
				'class' => 'RedisBagOStuff',
		                'servers' => [ 'donut.dwnet:6379' ],
			],
		],
	],

	'wgMainStash' => [
		'default' => 'redis',
	],

	'wgJobTypeConf' => [
		'droidwikiwiki' => [
			'default' => [
				'class' => 'JobQueueRedis',
				'redisServer' => 'donut.dwnet:6379',
				'redisConfig' => [],
				'claimTTL' => 3600,
				'daemonized' => true,
			],
		],
		'datawiki' => [
			'default' => [
				'class' => 'JobQueueRedis',
				'redisServer' => 'donut.dwnet:6379',
				'redisConfig' => [],
				'claimTTL' => 3600,
				'daemonized' => true,
			],
		],
		'endroidwikiwiki' => [
			'default' => [
				'class' => 'JobQueueRedis',
				'redisServer' => 'donut.dwnet:6379',
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
				'donut.dwnet',
			],
			'redisConfig'  => [
				'connectTimeout' => 2,
			],
		],
		'datawiki' => [
			'class' => 'JobQueueAggregatorRedis',
			'redisServers' => [
				'donut.dwnet',
			],
			'redisConfig'  => [
				'connectTimeout' => 2,
			],
		],
		'endroidwikiwiki' => [
			'class' => 'JobQueueAggregatorRedis',
			'redisServers' => [
				'donut.dwnet',
			],
			'redisConfig'  => [
				'connectTimeout' => 2,
			],
		],
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
		'datawiki' => true,
		'endroidwikiwiki' => true,
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
		'endroidwikiwiki' => true,
	],

	'wmgUseDroidWiki' => [
		'default' => true,
	],

	'wmgUseOATHAuth' => [
		'default' => true,
	],

	'wmgUseReadingLists' => [
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
		'endroidwikiwiki' => 'droidwikiwiki',
	],

	'wgSharedTables' => [
		'default' => [ 'user', 'user_properties' ],
		'+datawiki' => [ 'user_google_user', 'user_xenforo_user', 'user_groups', 'oathauth_users' ],
		'+endroidwikiwiki' => [ 'user_google_user', 'user_xenforo_user', 'user_groups', 'oathauth_users' ],
	],

	'wmgUseParsoid' => [
		'default' => true,
	],

	'wmgUseRestbase' => [
		'default' => false,
		'endroidwikiwiki' => true,
		'droidwikiwiki' => true,
	],

	'wmgVisualEditorAccessRESTbaseDirectly' => [
		'default' => false,
		'endroidwikiwiki' => true,
		'droidwikiwiki' => true,
	],

	'wmgRestbaseDomain' => [
		'default' => '',
		'endroidwikiwiki' => 'en.droidwiki.org',
		'droidwikiwiki' => 'www.droidwiki.org',
	],

	'wmgParsoidForwardCookies' => [
		'default' => false,
		'opswiki' => true,
	],

	'wmgUseDroidWikiForeignRepo' => [
		'default' => true,
		'droidwikiwiki' => false,
		'opswiki' => false,
	],

	'wgGoogleSiteSearchCSEID' => [
		'droidwikiwiki' => 'partner-pub-4622825295514928:3613188011',
		'endroidwikiwiki' => 'partner-pub-4622825295514928:7715837130',
		'datawiki' => 'partner-pub-4622825295514928:8454451153',
	],
];
