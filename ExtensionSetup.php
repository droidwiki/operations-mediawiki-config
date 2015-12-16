<?php
# DO NOT PUT PRIVATE INFORMATION HERE!

$extWithoutConfig = array(
	'AntiSpoof', # needed by AbuseFilter
	'Cite', # ref-tags
	'ParserFunctions',
	'SyntaxHighlight_GeSHi',
	'MobileWebAd',
	'CanonURL',
	'InputBox',
	'OpenGraphMeta',
	'MultimediaViewer',
	'CommonsMetadata',
	'CookieWarning',
	'Dereferer',
	'EmbedVideo', # Allows to embed YouTube videos into wikipages
	'Disambiguator',
	'DynamicPageList',
	'Echo',
	'CyanogenModDev',
	'BetaFeatures',
	'PageImages', # PageImages (needed by MobileFrontend and HoverCards)
	'TextExtracts', # TextExtracts (needed by MobileFrontend and HoverCards)
	'Popups',
	'ExpandTamplates',
	'DroidWiki',
	'MwEmbedSupport',
	'TimedMediaHandler',
	'ConfirmEdit',
	'AbuseFilter',
	'StopForumSpam',
	'Elastica',
	'CirrusSearch',
	'WikiEditor',
	'CodeEditor',
	'googleAnalytics',
	'MobileFrontend',
	'Scribunto',
	'SocialButtons',
	'Thanks',
	'GoogleLogin',
	'CentralNotice',
	'GoogleAPIClient',
	'GoogleAnalyticsTopPages',
	'TemplateData',
	'VisualEditor',
	'QuickSearchLookup',
	'UserMerge',
	'Gadgets',
	'Citoid',
	'Interwiki',
	'TemplateSandbox',
	'LdapAuthentication',
	'Gewinnspiel',
	'UniversalLanguageSelector',
	'Translate',
);

foreach ( $extWithoutConfig as $name ) {
	global $wmgExtensionsPath;

	$extname = 'wmgUse' . $name;
	if ( ( !isset( $$extname ) || ( isset( $$extname ) && $$extname ) ) && wfExtensionExists( $name ) ) {
		require_once "$IP/$wmgExtensionsPath/$name/$name.php";
	}
}
function wfExtensionExists( $name ) {
	global $IP, $wmgExtensionsPath;

	if ( file_exists( "$IP/$wmgExtensionsPath/$name/$name.php" ) ) {
		return true;
	}
	return false;
}

# Configuration for ConfirmEdit
if ( wfExtensionExists( "ConfirmEdit" ) ) {
	// The DroidWiki app can't handle client side JavaScript (on which reCaptcha is based on)
	// Check, if the request is made via the api (and assume, that this is the app or any other client that
	// needs machine readable format's) and use the FancyCaptcha plugin instead of reCaptcha.
	if ( $_SERVER['SCRIPT_NAME'] !== '/api.php' && strpos( $_GET['title'], 'Captcha/image' ) === false ) {
		require_once "$IP/extensions/ConfirmEdit/ReCaptchaNoCaptcha/ReCaptchaNoCaptcha.php";
		$wgReCaptchaSiteKey = $wmgReCaptchaSiteKey;
		$wgReCaptchaSecretKey = $wmgReCaptchaSecretKey;
		$wgCaptchaClass = 'ReCaptchaNoCaptcha';
	} else {
		require_once( "$IP/extensions/ConfirmEdit/FancyCaptcha.php" );
		$wgCaptchaDirectory = $wmgFancyCaptchaCaptchaDir;
		$wgCaptchaSecret = $wmgFancyCaptchaSecretKey;
		$wgCaptchaClass = 'FancyCaptcha';
		// in order to work with clients other then web browsers, the CAPTCHA information needs to be
		// stored in th cache, instead of in the session (which is the default).
		$wgCaptchaStorageClass = 'CaptchaCacheStore';
	}

	$wgGroupPermissions['*']['skipcaptcha'] = false;
	$wgGroupPermissions['user']['skipcaptcha'] = true;
	$wgGroupPermissions['autoconfirmed']['skipcaptcha'] = true;
	$wgGroupPermissions['bot']['skipcaptcha'] = false;
	$wgGroupPermissions['sysop']['skipcaptcha'] = false;
	$wgGroupPermissions['emailconfirmed']['skipcaptcha'] = true;
	$ceAllowConfirmedEmail = true;

	# Trigger for ConfirmEdit
	$wgCaptchaTriggers['edit'] = false;
	$wgCaptchaTriggers['create'] = true;
	$wgCaptchaTriggers['addurl'] = true;
	$wgCaptchaTriggers['createaccount'] = true;
	$wgCaptchaTriggers['badlogin'] = true;
}

# AbuseFilter
if ( wfExtensionExists( "AbuseFilter" ) ) {
	$wgGroupPermissions['sysop']['abusefilter-modify'] = true;
	$wgGroupPermissions['*']['abusefilter-log-detail'] = true;
	$wgGroupPermissions['*']['abusefilter-view'] = true;
	$wgGroupPermissions['*']['abusefilter-log'] = true;
	$wgGroupPermissions['sysop']['abusefilter-private'] = true;
	$wgGroupPermissions['sysop']['abusefilter-modify-restricted'] = true;
	$wgGroupPermissions['sysop']['abusefilter-revert'] = true;
}

# Spam BL
/*require_once "$IP/extensions/SpamBlacklist/SpamBlacklist.php";
$wgSpamBlacklistFiles = array(
	"http://droidwiki.de/index.php?title=Spam_blacklist&action=raw",
	"http://droidwiki.de/index.php?title=MediaWiki:Spam-blacklist&action=raw"
);

# Title BL
require_once "$IP/extensions/TitleBlacklist/TitleBlacklist.php";
$wgTitleBlacklistSources = array(
	array(
		'type' => TBLSRC_URL,
		'src'  => 'http://meta.wikimedia.org/w/index.php?title=Title_blacklist&action=raw',
	),
);*/

# Stop Forum Spam
if ( wfExtensionExists( "StopForumSpam" ) ) {
	$wgSFSAPIKey = $wmgSFSAPIKey;
	$wgPutIPinRC = true;
}

# Elasticsearch
if ( wfExtensionExists( "Elastica" ) && wfExtensionExists( "CirrusSearch" ) ) {
	$wgSearchType = 'CirrusSearch';
	$wgCirrusSearchPowerSpecialRandom = $wmgCirrusSearchPowerSpecialRandom;
	$wgCirrusSearchServers = array( '188.68.49.74' );
}

# WikiEditor/graphical Editor
if ( wfExtensionExists( "WikiEditor" ) ) {
	$wgDefaultUserOptions['usebetatoolbar'] = 1;
	$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;
	$wgDefaultUserOptions['wikieditor-preview'] = 0;
}

# CodeEditor (extension for WikiEditor
if ( wfExtensionExists( "CodeEditor" ) ) {
	# Enable it on JS/CSS pages
	$wgCodeEditorEnableCore = true;
}

# Add Google-Analytics
if ( wfExtensionExists( "googleAnalytics" ) ) {
	$wgGoogleAnalyticsAccount = $wmgGoogleAnalyticsAccount;
	$wgGoogleAnalyticsIgnoreSysops = $wmgGoogleAnalyticsIgnoreSysops;
	$wgGoogleAnalyticsIgnoreBots = $wmgGoogleAnalyticsIgnoreBots;
}

# MobileFrontend
if ( wfExtensionExists( "MobileFrontend" ) ) {
	$wgMobileFrontendLogo = "{$wgScriptPath}androide.png";
	$wgMFAutodetectMobileView = true;
	$wgMFEditorOptions['anonymousEditing'] = true;
	$wgMFEnableBeta = true;
	$wgMFNoLoginOverride = true;
}

# Scribunto
if ( wfExtensionExists( "Scribunto" ) ) {
	$wgScribuntoDefaultEngine = 'luastandalone';
	$wgScribuntoUseCodeEditor = true;
}

# Add's Facebook and G+ buttons to articles
if ( wfExtensionExists( "SocialButtons" ) ) {
	$wgSBDisallowedNamespaces = array('-1', '4', '5', '8', '9', '10', '12', '13');
	$wgSBDisallowedSiteTitles = array( 'Hauptseite' );
}

# Thanks
if ( wfExtensionExists( "Thanks" ) ) {
	$wgIncludejQueryMigrate = true;
	$wgThanksConfirmationRequired = true;
}

# GoogleLogin
if ( wfExtensionExists( "GoogleLogin" ) ) {
	$wgGLSecret = $wmgGLSecret;
	$wgGLAppId = $wmgGLAppId;
	$wgGLAPIKey = $wmgGLAPIKey;
	$wgGLShowCreateReason = true;
	$wgGLShowRight = true;
	// FIXME: reset these two to default value, after mw-ui buttons fixed in HTMLForm
	$wgGLShowKeepLogin = false;
	$wgGLForceKeepLogin = true;
}

# CentralNotice - 01.08.2014
if ( wfExtensionExists( "CentralNotice" ) ) {
	$wgNoticeInfrastructure = true;
	$wgNoticeProjects = array( 'droidwiki' );
	$wgNoticeProject = 'droidwiki';
}

if (
	wfExtensionExists ( "GoogleAPIClient" ) &&
	wfExtensionExists ( "GoogleAnalyticsTopPages" )
) {
	require_once "$IP/extensions/GoogleAPIClient/GoogleAPIClient.php";
	$wgGATPProfileId = $wmgGATPProfileId;
	$wgGATPKeyFileLocation = $wmgGATPKeyFileLocation;
	$wgGATPServiceAccountName = $wmgGATPServiceAccountName;
}

# TemplateData
if ( wfExtensionExists( "TemplateData" ) ) {
	$wgTemplateDataUseGUI = true;
}

# VisualEditor
if ( wfExtensionExists ( "VisualEditor" ) ) {
	$wgDefaultUserOptions['visualeditor-enable'] = 1;
	// FIXME: This should be in InitialiseSettings.php
	$wgVirtualRestConfig['modules']['parsoid'] = array(
		'url' => 'http://localhost:8142',
		'domain' => 'droidwiki',
		'prefix' => 'droidwiki',
	);
	$wgVisualEditorSupportedSkins = array( 'vector', 'apex', 'monobook', 'minerva' );
	$wgVisualEditorAvailableNamespaces = array(
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
	);
}

// don't enable CookieWarning before September, 30 2015
if ( wfExtensionExists ( 'CookieWarning' ) && time() > '1443564000' ) {
	$wgCookieWarningEnabled = true;
	$wgCookieWarningMoreUrl =
		'https://www.droidwiki.de/DroidWiki:Impressum#Verwendung_von_Cookies_.28Cookie-Policy.29';
}

if ( wfExtensionExists ( 'UserMerge' ) ) {
	$wgGroupPermissions['bureaucrat']['usermerge'] = true;
}

if ( wfExtensionExists( 'Citoid' ) ) {
	// provisional re-use of wikimedia's citoid endpoint api
	// until we have our own
	$wgCitoidServiceUrl = 'https://citoid.wikimedia.org/api';
}

if ( wfExtensionExists( 'Interwiki' ) ) {
	$wgGroupPermissions['sysop']['interwiki'] = true;
}

if ( $wmgUseLdapAuthentication && wfExtensionExists( 'LdapAuthentication' ) ) {
	$wgAuth = new LdapAuthenticationPlugin();
	$wgLDAPDomainNames = array(
	        'go2tech.de',
	);
	$wgLDAPServerNames = array(
	        'go2tech.de' => 'localhost',
	);
	$wgLDAPUseLocal = false;
	$wgLDAPEncryptionType = array(
	        'go2tech.de' => 'clear',
	);
	$wgLDAPPort = array(
	        'go2tech.de' => 389,
	);
	$wgLDAPSearchAttributes = array(
	        'go2tech.de' => 'uid',
	);
	$wgLDAPBaseDNs = array(
	        'go2tech.de' => 'dc=go2tech,dc=de',
	);
	$wgLDAPPreferences = array(
	        'go2tech.de' => array( 'email' => 'mail'),
	);
	$wgLDAPGroupUseFullDN = array( "go2tech.de" => false );
	$wgLDAPGroupObjectclass = array( "go2tech.de" => "posixgroup" );
	$wgLDAPGroupAttribute = array( "go2tech.de" => "memberuid" );
	$wgLDAPGroupSearchNestedGroups = array( "go2tech.de" => false );
	$wgLDAPGroupNameAttribute = array( "go2tech.de" => "cn" );
	$wgLDAPRequiredGroups = array( "go2tech.de" => array( "cn=opswiki,ou=Groups,dc=go2tech,dc=de" ) );
	$wgLDAPLowerCaseUsername = array(
	        'go2tech.de' => true,
	);
}
