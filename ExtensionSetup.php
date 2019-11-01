<?php
# DO NOT PUT PRIVATE INFORMATION HERE!

$jsonEntrypointExtensions = [
	'AbuseFilter',
	'AmazonPartnernet',
	'AntiSpoof', # needed by AbuseFilter
	'BetaFeatures',
	'CentralNotice',
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
	'GoogleSiteLinksSearchBox',
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
	'Translate',
	'UniversalLanguageSelector',
	'UserMerge',
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
	$wgMessagesDirs['FancyCaptcha'] = "$IP/extensions/ConfirmEdit/FancyCaptcha/i18n";
}

// The DroidWiki app can't handle client side JavaScript (on which reCaptcha is based on)
// Check, if the request is made via the api (and assume, that this is the app or any other client that
// needs machine readable format's) and use the FancyCaptcha plugin instead of reCaptcha.
if ( $_SERVER['SCRIPT_NAME'] !== '/api.php' && isset( $_GET['title'] ) &&
	strpos( $_GET['title'], 'Captcha/image' ) === false ) {
	wfLoadExtensions( [ 'ConfirmEdit/ReCaptchaNoCaptcha' ] );
	$wgReCaptchaSiteKey = $wmgReCaptchaSiteKey;
	$wgReCaptchaSecretKey = $wmgReCaptchaSecretKey;
	$wgCaptchaClass = 'ReCaptchaNoCaptcha';
} else {
	wfLoadExtensions( [ 'ConfirmEdit/FancyCaptcha' ] );
	$wgCaptchaDirectory = $wmgFancyCaptchaCaptchaDir;
	$wgCaptchaSecret = $wmgFancyCaptchaSecretKey;
	$wgCaptchaClass = 'FancyCaptcha';
	// in order to work with clients other then web browsers, the CAPTCHA information needs to be
	// stored in th cache, instead of in the session (which is the default).
	$wgCaptchaStorageClass = 'CaptchaCacheStore';
}

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
$wgGoogleAnalyticsAccount = $wmgGoogleAnalyticsAccount;
$wgGoogleAnalyticsIgnoreSysops = $wmgGoogleAnalyticsIgnoreSysops;
$wgGoogleAnalyticsIgnoreBots = $wmgGoogleAnalyticsIgnoreBots;

# MobileFrontend
wfLoadSkin( 'MinervaNeue' );
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
$wgScribuntoUseGeSHi = true;
$wgScribuntoUseCodeEditor = true;

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

# CentralNotice - 01.08.2014
$wgCentralDBname = 'droidwikiwiki';
if ( $multiversion->getDBName() === $wgCentralDBname ) {
	$wgNoticeInfrastructure = true;
}
$wgCentralPagePath = "//www.droidwiki.org/w/index.php";
$wgCentralSelectedBannerDispatcher = "//www.droidwiki.org/w/index.php?title=Special:BannerLoader";
$wgNoticeProjects = [ 'droidwikiwiki', 'datawiki' ];
$wgNoticeProject = $multiversion->getDBName();

$wgGATPProfileId = $wmgGATPProfileId;
$wgGATPKeyFileLocation = $wmgGATPKeyFileLocation;
$wgGATPServiceAccountName = $wmgGATPServiceAccountName;

# TemplateData
$wgTemplateDataUseGUI = true;

# VisualEditor
$wgDefaultUserOptions['visualeditor-enable'] = 1;
$wgVisualEditorSupportedSkins = [ 'vector', 'apex', 'monobook', 'minerva' ];
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

$wgGroupPermissions['bureaucrat']['usermerge'] = true;

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

if ( $wmgUseWikibaseRepo ) {
	$wgEnableWikibaseRepo = true;
	require_once "$IP/extensions/Wikibase/repo/Wikibase.php";

	$wgContentHandlerUseDB = true;
	// Register extra namespaces.
	$wgExtraNamespaces[WB_NS_ITEM] = 'Item';
	$wgExtraNamespaces[WB_NS_ITEM_TALK] = 'Item_talk';
	$wgExtraNamespaces[WB_NS_PROPERTY] = 'Property';
	$wgExtraNamespaces[WB_NS_PROPERTY_TALK] = 'Property_talk';

	$wgWBRepoSettings['entityNamespaces'] = [
		'item' => WB_NS_ITEM,
		'property' => WB_NS_PROPERTY,
	];

	// Tell Wikibase which namespace to use for which kind of entity
	// Make sure we use the same keys on repo and clients, so we can share cached objects.
	$wgWBRepoSettings['sharedCacheKeyPrefix'] = $wgDBname . ':WBL/' . rawurlencode( WBL_VERSION );
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
	require_once "$IP/extensions/Wikibase/client/WikibaseClient.php";

	wfLoadExtension( 'WikibaseCreateLink' );

	$wgWBClientSettings['repoUrl'] = 'https://data.droidwiki.org';
	$wgWBClientSettings['repoArticlePath'] = '/wiki/$1';
	$wgWBClientSettings['repoScriptPath'] = '/w';
	$wgWBClientSettings['repositories'] = [
		'' => [
			'repoDatabase' => 'datawiki',
			'baseUri' => $wgWBClientSettings['repoUrl'] . '/entity/',
			'entityNamespaces' => [
				'item' => WB_NS_ITEM,
				'property' => WB_NS_PROPERTY,
			],
			'prefixMapping' => [ '' => '' ],
		],
	];

	$wgWBClientSettings['siteGlobalID'] = substr( $wgDBname, 0, - 4 );
	$wgWBClientSettings['siteGroup'] = 'droidwiki';
	$wgWBClientSettings['changesDatabase'] = 'datawiki';
	$wgWBCLientSettings['injectRecentChanges'] = true;
	$wgWBClientSettings['languageLinkSiteGroup'] = 'droidwiki';

	$wgWBClientSettings['repoNamespaces'] = [
		'item' => 'Item',
		'property' => 'Property',
	];

	$wgWBClientSettings['entityNamespaces'] = [
		'item' => $wmgWikibaseBaseNs,
		'property' => $wmgWikibaseBaseNs + 2,
	];

	$wgWBClientSettings['repoSiteName'] = 'DroidWiki Data';
	$wgWBClientSettings['otherProjectsLinks'] =
		[ 'wikidatawiki', 'commonswiki', 'dewiki', 'enwiki' ];
	$wgWBClientSettings['otherProjectsLinksByDefault'] = true;
	$wgWBClientSettings['sendEchoNotification'] = true;

	$wgHooks['WikibaseClientOtherProjectsSidebar'][] =
		function ( Wikibase\DataModel\Entity\ItemId $itemId, array &$sidebar ) {
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
$wgCirrusSearchServers = [ 'eclair.dwnet' ];
