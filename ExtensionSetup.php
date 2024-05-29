<?php
# DO NOT PUT PRIVATE INFORMATION HERE!

# Additional, alternative skins
wfLoadSkins( [ 'Vector', 'Timeless' ] );
$wgVectorDefaultSkinVersionForExistingAccounts = '1';
$wgVectorDefaultSkinVersionForNewAccounts = '2';
$wgVectorDefaultSidebarVisibleForAnonymousUser = true;
$wgVectorTableOfContents = true;
$wgVectorTitleAboveTabs = true;
$wgVectorStickyHeaderEdit = [
	'logged_in' => true,
	'logged_out' => true,
];
$wgVectorWvuiSearchOptions = [
	'showThumbnail' => true,
	'showDescription' => true,
];
$wgVectorLanguageInHeader = [
	'logged_in' => true,
	'logged_out' => true,
];
$wgVectorConsolidateUserLinks = [
	'logged_in' => true,
	'logged_out' => true,
];
$wgVectorStickyHeader = [
	'logged_in' => true,
	'logged_out' => true,
];

$jsonEntrypointExtensions = [
	'AbuseFilter',
	'AcceleratedMobilePages',
	'AmazonPartnernet',
	'AntiSpoof', # needed by AbuseFilter
	'BetaFeatures',
	'CheckUser',
	'CirrusSearch',
	'Cite', # ref-tags
	'CiteThisPage',
	'Citoid',
	'CodeEditor',
	'CommonsMetadata',
	'ConfirmEdit',
	'CookieWarning',
	'Disambiguator',
	'DroidWiki',
	'Echo',
	'Elastica',
	'EmbedVideo', # Allows to embed YouTube videos into wikipages
	'GeoData',
	'GlobalUsage',
	'GoogleAnalyticsTopPages',
	'GoogleLogin',
	'InputBox',
	'Interwiki',
	'LoginNotify',
	'MobileFrontend',
	'MultimediaViewer',
	'Nuke',
	'OATHAuth',
	'OpenGraphMeta',
	'PageImages', # PageImages (needed by MobileFrontend and HoverCards)
	'ParserFunctions',
	'Popups',
	'QuickSearchLookup',
	'Scribunto',
	'StopForumSpam',
	'SyntaxHighlight_GeSHi',
	'TemplateData',
	'TemplateSandbox',
	'TextExtracts', # TextExtracts (needed by MobileFrontend and HoverCards)
	'Thanks',
	'TimedMediaHandler',
	'TorBlock',
	'Translate',
	'UniversalLanguageSelector',
	'VisualEditor',
	'WikiEditor',
	'ReadingLists',
];

$phpEntrypointExtensions = [
	'googleAnalytics',
];

function shouldSkipLoadExtension( $name ) {
	return isset( $GLOBALS['wmgUse' . $name] ) && !$GLOBALS['wmgUse' . $name];
}

foreach ( $phpEntrypointExtensions as $name ) {
	if ( shouldSkipLoadExtension( $name ) ) {
		continue;
	}
	require "$IP/extensions/$name/$name.php";
}

$extensionsToLoadWithExtensionregistration = [];
foreach ( $jsonEntrypointExtensions as $name ) {
	if ( shouldSkipLoadExtension( $name ) ) {
		continue;
	}
	$extensionsToLoadWithExtensionregistration[] = $name;
}

wfLoadExtensions( $extensionsToLoadWithExtensionregistration );

# Configuration for ConfirmEdit
if ( PHP_SAPI === 'cli' ) {
	$wgMessagesDirs['ReCaptchaNoCaptcha'] = "$IP/extensions/ConfirmEdit/ReCaptchaNoCaptcha/i18n";
}

wfLoadExtensions( [ 'ConfirmEdit/ReCaptchaNoCaptcha' ] );
$wgReCaptchaSiteKey = $wmgReCaptchaSiteKey;
$wgReCaptchaSecretKey = $wmgReCaptchaSecretKey;
$wgCaptchaClass = 'MediaWiki\\Extension\\ConfirmEdit\\ReCaptchaNoCaptcha\\ReCaptchaNoCaptcha';

# only emailconfirmed can skip captcha
$wgGroupPermissions['*']['skipcaptcha'] = false;
$wgGroupPermissions['user']['skipcaptcha'] = false;
$wgGroupPermissions['autoconfirmed']['skipcaptcha'] = false;
$wgGroupPermissions['bot']['skipcaptcha'] = false;
$wgGroupPermissions['sysop']['skipcaptcha'] = false;
$wgGroupPermissions['emailconfirmed']['skipcaptcha'] = true;
$wgAllowConfirmedEmail = true;

# Trigger for ConfirmEdit
$wgCaptchaTriggers['edit'] = true;
$wgCaptchaTriggers['create'] = true;
$wgCaptchaTriggers['addurl'] = true;
$wgCaptchaTriggers['createaccount'] = true;
$wgCaptchaTriggers['badlogin'] = true;

# AbuseFilter
$wgGroupPermissions['sysop']['abusefilter-modify'] = true;
$wgGroupPermissions['*']['abusefilter-log-detail'] = true;
$wgGroupPermissions['*']['abusefilter-view'] = true;
$wgGroupPermissions['*']['abusefilter-log'] = true;
$wgGroupPermissions['sysop']['abusefilter-privatedetails'] = true;
$wgGroupPermissions['sysop']['abusefilter-modify-restricted'] = true;
$wgGroupPermissions['sysop']['abusefilter-revert'] = true;

# Stop Forum Spam
$wgSFSAPIKey = $wmgSFSAPIKey;
$wgPutIPinRC = true;

# WikiEditor/graphical Editor
$wgDefaultUserOptions['usebetatoolbar'] = 1;
$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;
$wgDefaultUserOptions['wikieditor-preview'] = 0;

# CodeEditor (extension for WikiEditor
# Enable it on JS/CSS pages
$wgCodeEditorEnableCore = true;

# Add Google-Analytics
$wgGoogleAnalyticsAccount = "UA-21207284-8";
$wgGoogleAnalyticsIgnoreSysops = false;
$wgGoogleAnalyticsIgnoreBots = false;

# MobileFrontend
wfLoadSkin( 'MinervaNeue' );
# temporarz enable site notices to show CookieWarning banner until T269173 is resolved
$wgMinervaEnableSiteNotice = true;
$wgMobileFrontendLogo = "{$wgScriptPath}/static/images/project-logos/androide.png";
$wgMFAutodetectMobileView = true;
$wgMFEnableBeta = true;
$wgMFSpecialCaseMainPage = true;
$wgMFAdvancedMobileContributions = true;
$wgMFCollapseSectionsByDefault = false;

if ( $wmgUseWikibaseClient ) {
	$wgMFUseWikibaseDescription = true;
	$wgMFDisplayWikibaseDescription = true;
}

# Scribunto
$wgScribuntoDefaultEngine = 'luastandalone';
$wgScribuntoEngineConf['luastandalone']['luaPath'] = '/usr/bin/lua';
$wgScribuntoUseGeSHi = true;
$wgScribuntoUseCodeEditor = true;

# DroidWiki
$wgDroidWikiAdDisallowedNamespaces = [ 120, 121, 122, 123 ];
$wgDroidWikiNoAdSites = [
	'Hauptseite',
	'',
	'Spezial:Suche',
	'Spezial:Anmelden',
	'DroidWiki:Impressum',
	'DroidWiki:Datenschutz',
];

# Thanks
$wgIncludejQueryMigrate = true;
$wgThanksConfirmationRequired = true;

# GoogleLogin
$wgGLSecret = $wmgGLSecret;
$wgGLAppId = $wmgGLAppId;
$wgGLAPIKey = $wmgGLAPIKey;
$wgGLShowCreateReason = true;
$wgGLShowRight = true;
// FIXME: reset these two to default value, after mw-ui buttons fixed in HTMLForm
$wgGLShowKeepLogin = false;
$wgGLForceKeepLogin = true;
$wgGLAllowAccountCreation = true;

$wgGATPProfileId = $wmgGATPProfileId;
$wgGATPKeyFileLocation = $wmgGATPKeyFileLocation;
$wgGATPServiceAccountName = $wmgGATPServiceAccountName;

# TemplateData
$wgTemplateDataUseGUI = true;

# VisualEditor
wfLoadExtension( 'Parsoid', "$IP/vendor/wikimedia/parsoid/extension.json" );
$wgDefaultUserOptions['visualeditor-enable'] = 1;
$wgVisualEditorEnableWikitext = true;
$wgVisualEditorEnableDiffPage = true;
$wgVisualEditorAvailableNamespaces = [
	NS_TALK => true,
	NS_USER => true,
	NS_USER_TALK => true,
	NS_PROJECT => true,
	NS_PROJECT_TALK => true,
	NS_FILE => true,
	NS_FILE_TALK => true,
	NS_HELP => true,
	NS_HELP_TALK => true,
	NS_CATEGORY => true,
	NS_CATEGORY_TALK => true,
];

if ( $wmgVisualEditorAccessRESTbaseDirectly ) {
	$wgVisualEditorRestbaseURL = '/api/v1/page/html/';
	$wgVisualEditorFullRestbaseURL = "/api/";
}

$wgCookieWarningEnabled = true;
$wgCookieWarningMoreUrl =
	'https://www.droidwiki.org/DroidWiki:Impressum#Verwendung_von_Cookies_.28Cookie-Policy.29';

$wgCitoidServiceUrl = 'https://go2tech.de/citoid/api';

$wgGroupPermissions['sysop']['interwiki'] = true;

if ( $wmgUseTranslate ) {
	$wgTranslateTranslationServices = [
		'Yandexm' => [
			'key' => $wmgTranslateTranslationServicesKeys['Yandex'],
			'url' => 'https://translate.yandex.net/api/v1.5/tr.json/translate',
			'pairs' => 'https://translate.yandex.net/api/v1.5/tr.json/getLangs',
			'timeout' => 3,
			'langorder' => [ 'en', 'ru', 'uk', 'de', 'fr', 'pl', 'it', 'es', 'tr' ],
			'langlimit' => 1,
			'type' => 'yandex',
		],
	];
}

$wgTemplateSandboxEditNamespaces[] = 828;

$wmgWikibaseBaseNs = 120;
// Define custom namespaces. Use these exact constant names.
define( 'WB_NS_ITEM', $wmgWikibaseBaseNs );
define( 'WB_NS_ITEM_TALK', $wmgWikibaseBaseNs + 1 );
define( 'WB_NS_PROPERTY', $wmgWikibaseBaseNs + 2 );
define( 'WB_NS_PROPERTY_TALK', $wmgWikibaseBaseNs + 3 );

if ( $wmgUseWikibaseRepo || $wmgUseWikibaseClient ) {
	$wbRepoUrl = 'https://data.droidwiki.org';
	$entitySources = [
		'datawiki' => [
			'repoDatabase' => 'datawiki',
			'baseUri' => $wbRepoUrl . '/entity/',
			'entityNamespaces' => [
				'item' => WB_NS_ITEM,
				'property' => WB_NS_PROPERTY,
			],
			'prefixMapping' => [ '' => '' ],
			'interwikiPrefix' => 'd',
			'rdfNodeNamespacePrefix' => 'ddw',
			'rdfPredicateNamespacePrefix' => '',
		],
	];
}

if ( $wmgUseWikibaseRepo ) {
	$wgEnableWikibaseRepo = true;
	wfLoadExtension( 'WikibaseRepository', "$IP/extensions/Wikibase/extension-repo.json" );

	// Register extra namespaces.
	$wgExtraNamespaces[WB_NS_ITEM] = 'Item';
	$wgExtraNamespaces[WB_NS_ITEM_TALK] = 'Item_talk';
	$wgExtraNamespaces[WB_NS_PROPERTY] = 'Property';
	$wgExtraNamespaces[WB_NS_PROPERTY_TALK] = 'Property_talk';

	$wgWBRepoSettings['entityNamespaces'] = [
		'item' => WB_NS_ITEM,
		'property' => WB_NS_PROPERTY,
	];
	$wgWBRepoSettings['entitySources'] = $entitySources;
	$wgWBRepoSettings['localEntitySourceName'] = 'datawiki';

	// Tell Wikibase which namespace to use for which kind of entity
	// Make sure we use the same keys on repo and clients, so we can share cached objects.
	$wgWBRepoSettings['sharedCacheKeyPrefix'] = $wgDBname . ':WBL/';
	// NOTE: no need to set up $wgNamespaceContentModels, Wikibase will do that automatically based on $wgWBRepoSettings
	// Tell MediaWIki to search the item namespace
	$wgNamespacesToBeSearchedDefault[WB_NS_ITEM] = true;
	// the special group includes all the sites in the specialSiteLinkGroups,
	// grouped together in a 'Pages linked to other sites' section.
	$wgWBRepoSettings['siteLinkGroups'] = [
		'droidwiki',
		'wikipedia',
		'special',
	];
	// these are the site_group codes as listed in the sites table
	$wgWBRepoSettings['specialSiteLinkGroups'] = [ 'commons', 'wikidata' ];

	$wgWBRepoSettings['statementSections'] = [
		'item' => [
			'statements' => null,
			'identifiers' => [
				'type' => 'dataType',
				'dataTypes' => [ 'external-id' ],
			],
		],
	];

	$wgWBRepoSettings['localClientDatabases'] = [
		'droidwiki' => 'droidwikiwiki',
		'endroidwiki' => 'endroidwikiwiki',
	];
	$wgWBRepoSettings['formatterUrlProperty'] = 'P9';
	$wgContentNamespaces = array_merge( $wgContentNamespaces, [ WB_NS_ITEM, WB_NS_PROPERTY ] );
}

if ( $wmgUseWikibaseClient ) {
	$wgEnableWikibaseClient = true;
	wfLoadExtension( 'WikibaseClient', "$IP/extensions/Wikibase/extension-client.json" );
	wfLoadExtension( 'WikibaseCreateLink' );

	$wgWBClientSettings['repoUrl'] = $wbRepoUrl;
	$wgWBClientSettings['repoArticlePath'] = '/wiki/$1';
	$wgWBClientSettings['repoScriptPath'] = '/w';
	$wgWBClientSettings['entitySources'] = $entitySources;
	$wgWBClientSettings['itemAndPropertySourceName'] = 'datawiki';

	$wgWBClientSettings['siteGlobalID'] = substr( $wgDBname, 0, -4 );
	$wgWBClientSettings['siteGroup'] = 'droidwiki';
	$wgWBClientSettings['changesDatabase'] = 'datawiki';
	$wgWBClientSettings['injectRecentChanges'] = true;
	$wgWBClientSettings['languageLinkSiteGroup'] = 'droidwiki';

	$wgWBClientSettings['entityNamespaces'] = [
		'item' => WB_NS_ITEM,
		'property' => WB_NS_PROPERTY,
	];

	$wgWBClientSettings['repoSiteName'] = 'DroidWiki Data';
	$wgWBClientSettings['otherProjectsLinks'] =
		[ 'wikidatawiki', 'commonswiki', 'dewiki', 'enwiki' ];
	$wgWBClientSettings['otherProjectsLinksByDefault'] = true;
	$wgWBClientSettings['sendEchoNotification'] = true;

	$wgHooks['WikibaseClientOtherProjectsSidebar'][] =
		static function ( Wikibase\DataModel\Entity\ItemId $itemId, array &$sidebar ) {
			foreach ( $sidebar as $id => &$group ) {
				foreach ( $group as $siteId => &$attributes ) {
					if ( isset( $attributes['hreflang'] ) ) {
						$attributes['msg'] = $attributes['msg'] . '-' . $attributes['hreflang'];
					}
				}
			}

			return true;
		};
}

$wgSharedTables[] = 'oathauth_users';

$wgGeoDataBackend = 'elastic';

if ( $wmgUseReadingLists ) {
	$wgReadingListsDatabase = 'droidwikiwiki';
	$wgReadingListsCentralWiki = 'droidwikiwiki';
}

$wgGlobalUsageDatabase = 'droidwikiwiki';

# UniversalLanguageSelector
# Turn off geolocation service - T199106
$wgULSGeoService = false;

# CirrusSearch
$wgSearchType = 'CirrusSearch';
$wgCirrusSearchServers = [ '172.16.0.2' ];

$wgPLFirebaseAccessToken = $wmgPLFirebaseAccessToken;
$wgPLEnableApiVerification = true;
$wgPLFirebaseSenderId = '829317666886';

# Originally reserved by UserMerge, but is now undeployed. Prevent new users to claim this name now
$wgReservedUsernames[] = 'Anonymous';

# TorBlock
$wgTorAutoConfirmAge = 90 * 86400;
$wgTorAutoConfirmCount = 100;
$wgTorDisableAdminBlocks = false;
$wgTorTagChanges = false;
$wgGroupPermissions['user']['torunblocked'] = false;
