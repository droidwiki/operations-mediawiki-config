<?php

global $wgConf;

$wgConf->settings = [
	'wgSitename' => [
		'default' => 'Android Wiki',
		'opswiki' => 'DroidWiki Operations',
		'datawiki' => 'DroidWiki Data',
		'armakothwiki' => 'ArmA 3 King of the Hill Wiki',
	],

	'wgMetaNamespace' => [
		'default' => 'DroidWiki',
		'opswiki' => 'Project',
		'datawiki' => 'Data',
		'armakothwiki' => 'Project',
	],

	'+wgNamespaceContentModels' => [
		'+opswiki' => [
			NS_TALK => 'flow-board',
		],
	],

	'wgLanguageCode' => [
		'default' => 'de',
		'endroidwikiwiki' => 'en',
		'armakothwiki' => 'en',
	],

	'wgServer' => [
		'droidwikiwiki' => 'https://www.droidwiki.org',
		'endroidwikiwiki' => 'https://en.droidwiki.org',
		'opswiki' => 'https://ops.go2tech.de',
		'datawiki' => 'https://data.droidwiki.org',
		'armakothwiki' => 'https://www.armakoth.wiki',
	],

	'wgCanonicalServer' => [
		'droidwikiwiki' => 'https://www.droidwiki.org',
		'endroidwikiwiki' => 'https://en.droidwiki.org',
		'opswiki' => 'http://ops.go2tech.de',
		'datawiki' => 'https://data.droidwiki.org',
		'armakothwiki' => 'https://www.armakoth.wiki',
	],

	'wmgSiteLogo1x' => [
		'default' => '',
		'droidwikiwiki' => '/static/images/project-logos/androide.png',
		'endroidwikiwiki' => '/static/images/project-logos/androide.png',
		'datawiki' => '/static/images/project-logos/androide.png',
		"opswiki" => '/static/images/project-logos/androide_cog.png',
		"armakothwiki" => '/static/images/project-logos/koth.png',
	],

	'wmgSiteLogoIcon' => [
		'default' => null,
		'droidwikiwiki' => '/static/images/project-logos/androide_icon.svg',
		'endroidwikiwiki' => '/static/images/project-logos/androide_icon.svg',
		'datawiki' => '/static/images/project-logos/androide_icon.svg',
	],

	'wmgSiteLogoWordmark' => [
		'default' => [
			'src' => '/static/images/project-logos/wordmark.svg',
			'width' => 150,
			'height' => 40,
		],
		'opswiki' => null,
		'armakothwiki' => [
			'src' => '/static/images/project-logos/koth_icon.png',
			'width' => 169,
			'height' => 40,
		],
	],

	'wgFavicon' => [
		'default' => '/static/images/favicons/favicon.ico',
		'armakothwiki' => '/static/images/favicons/koth.png',
	],

	'wgEmergencyContact' => [
		'default' => 'info@droidwiki.org',
		'opswiki' => 'info@go2tech.de',
		'armakoth' => 'info@armakoth.wiki',
	],

	'wgPasswordSender' => [
		'default' => 'info@droidwiki.org',
		'opswiki' => 'info@go2tech.de',
		'armakoth' => 'info@armakoth.wiki',
	],

	'+wgGroupPermissions' => [
		'default' => [
			'emailconfirmed' => [
				'emailconfirmed' => true,
			],
			'sysop' => [
				'upload_by_url' => true,
				// this should be an own group "Translation admin"
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

	'wgGroupOverrides' => [
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
				'createpage' => true,
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
				'createpage' => false,
			],
			'user' => [
				'edit' => false,
			],
			'emailconfirmed' => [
				'edit' => true,
				'createpage' => true,
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

	'wmgUseInstantCommons' => [
		'default' => true,
		'opswiki' => false,
	],

	'wgSVGConverter' => [
		'default' => 'ImageMagick',
	],

	'wgCrossSiteAJAXdomains' => [
		'default' => [ '*.droidwiki.org' ],
		'opswiki' => [],
	],

	'wgRightsUrl' => [
		'default' => 'https://creativecommons.org/licenses/by-sa/3.0/deed',
		'droidwikiwiki' => 'https://creativecommons.org/licenses/by-sa/3.0/deed.de',
		'opswiki' => null,
	],

	'wgRightsText' => [
		'default' => 'Creative Commons Attribution/Share-Alike Lizenz 3.0',
		'opswiki' => null,
	],

	'wgRightsIcon' => [
		'default' => 'https://creativecommons.org/images/public/somerights20.png',
		'opswiki' => null,
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
		'armakothwiki' => true,
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
		'armakothwiki' => 'droidwikiwiki',
	],

	'wgSharedTables' => [
		'default' => [ 'user', 'user_properties', 'actor' ],
		'+datawiki' => [ 'user_google_user', 'user_xenforo_user', 'user_groups', 'oathauth_users' ],
		'+endroidwikiwiki' => [ 'user_google_user', 'user_xenforo_user', 'user_groups', 'oathauth_users' ],
		'+armakothwiki' => [ 'user_google_user', 'user_groups', 'oathauth_users' ],
	],

	'wgDroidWikiGoogleAnalyticsMeasurementId' => [
		'default' => '',
		'droidwikiwiki' => 'G-2CX5WMT6B3',
		'endroidwikiwiki' => 'G-E2F5D2Z6X9',
		'datawiki' => 'G-MKR49V7X28',
		'armakothwiki' => 'G-HTLV6XG918',
	],

	'wgDroidWikiCloudFlareWebAnalyticsToken' => [
		'default' => null,
		'droidwikiwiki' => '076c2830980149c689611e3526a28db6',
		'endroidwikiwiki' => '0ff69d63ca77470b814c5f8bcb9da458',
		'datawiki' => '237a781942414bdb9ea7cb78a44c7ecb',
		'armakothwiki' => 'bab12a8ce79d495ca780591883087609',
	],

	'wmgUseRestbase' => [
		'default' => false,
		'endroidwikiwiki' => true,
		'droidwikiwiki' => true,
		'armakothwiki' => true,
	],

	'wmgRestbaseDomain' => [
		'default' => '',
		'endroidwikiwiki' => 'en.droidwiki.org',
		'droidwikiwiki' => 'www.droidwiki.org',
		'armakothwiki' => 'www.armakoth.wiki',
	],

	'wmgUseDroidWikiForeignRepo' => [
		'default' => true,
		'droidwikiwiki' => false,
		'opswiki' => false,
		'armakothwiki' => false,
	],

	'wmgUseVarnish' => [
		'default' => true,
		'opswiki' => false,
	],
];
