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
		'opswiki' => 'https://ops.go2tech.de',
		'datawiki' => 'https://data.droidwiki.org',
	],

	'wgCanonicalServer' => [
		'droidwikiwiki' => 'https://www.droidwiki.org',
		'endroidwikiwiki' => 'https://en.droidwiki.org',
		'opswiki' => 'http://ops.go2tech.de',
		'datawiki' => 'https://data.droidwiki.org',
	],

	'wmgSiteLogo1x' => [
		'default' => '',
		'droidwikiwiki' => '/static/images/project-logos/androide.png',
		'endroidwikiwiki' => '/static/images/project-logos/androide.png',
		'datawiki' => '/static/images/project-logos/androide.png',
		"opswiki" => '/static/images/project-logos/androide_cog.png',
	],

	'wmgSiteLogoIcon' => [
		'default' => '',
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
	],

	'wgEmergencyContact' => [
		'default' => 'info@droidwiki.org',
		'opswiki' => 'info@go2tech.de',
	],

	'wgPasswordSender' => [
		'default' => 'info@droidwiki.org',
		'opswiki' => 'info@go2tech.de',
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
		'default' => [ '*.droidwiki.de', '*.droidwiki.org' ],
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
		'default' => '//creativecommons.org/images/public/somerights20.png',
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
	],

	'wgSharedTables' => [
		'default' => [ 'user', 'user_properties' ],
		'+datawiki' => [ 'user_google_user', 'user_xenforo_user', 'user_groups', 'oathauth_users' ],
		'+endroidwikiwiki' => [ 'user_google_user', 'user_xenforo_user', 'user_groups', 'oathauth_users' ],
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

	'wmgUseVarnish' => [
		'default' => true,
		'opswiki' => false,
	],
];
