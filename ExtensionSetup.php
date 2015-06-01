<?php
# DO NOT PUT PRIVATE INFORMATION HERE!

$extWithoutConfig = array(
	'AntiSpoof', # needed by AbuseFilter
	'Cite', # ref-tags
	'ParserFunctions',
	'SyntaxHighlight_GeSHi',
	'MobileWebAd',
	'UserDailyContribs', # needed by ArticleFeedback
	'ClickTracking', # needed by ArticleFeedback
	'EmailCapture', # needed by ArticleFeedback
	'Description2',
	'CanonURL',
	'InputBox',
	'TitleKey',
	'OpenGraphMeta',
	'MultimediaViewer',
	'CommonsMetadata',
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
	'VectorBeta',
	'ConfirmEdit',
	'AbuseFilter',
	'StopForumSpam',
	'Elastica',
	'CirrusSearch',
	'WikiEditor',
	'CodeEditor',
	'googleAnalytics',
	'MobileFrontend',
	'ArticleFeedback',
	'GoogleRating',
	'Scribunto',
	'SocialButtons',
	'Thanks',
	'MaintenanceShell',
	'Maintenance',
	'GoogleLogin',
	'CentralNotice',
	'GoogleAPIClient',
	'GoogleAnalyticsTopPages',
	'TemplateData',
	'VisualEditor',
	'OOJsUIAjaxLogin',
);

foreach ( $extWithoutConfig as $name ) {
	global $wmgExtensionsPath;

	if ( wfExtensionExists( $name ) ) {
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

# Extensions for DoridWiki skin
if ( wfExtensionExists( "VectorBeta" ) ) {
	$wgVectorBetaPersonalBar = true;
	# Hide the preference from beta-settings (it has to be standard in DroidWiki skin)
	$wgHiddenPrefs[] = 'betafeatures-vector-compact-personal-bar';
}

# Configuration for ConfirmEdit
if ( wfExtensionExists( "ConfirmEdit" ) ) {
	require_once "$IP/extensions/ConfirmEdit/ReCaptchaNoCaptcha.php";
	$wgReCaptchaSiteKey = $wmgReCaptchaSiteKey;
	$wgReCaptchaSecretKey = $wmgReCaptchaSecretKey;
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

# GoogleCSE
# require_once "$IP/extensions/GoogleCSE/GoogleCSE.php";
# Redirect all Search requests to Google CSE
# $wgSearchForwardUrl = 'http://www.droidwiki.de/Spezial:GoogleCSE?q=$1';
# $wgDisableTextSearch = true;

# Elasticsearch
if ( wfExtensionExists( "Elastica" ) && wfExtensionExists( "CirrusSearch" ) ) {
	$wgSearchType = 'CirrusSearch';
	$wgCirrusSearchPowerSpecialRandom = $wmgCirrusSearchPowerSpecialRandom;
	$wgCirrusSearchServers = array( '85.214.215.12' );
	# Enable the "experimental" highlighter
	# $wgCirrusSearchUseExperimentalHighlighter = true;
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
}

# ArticleFeedback
if ( wfExtensionExists( "ArticleFeedback" ) ) {
	$wgArticleFeedbackBlacklistCategories = array( 'KeinVoting' );
	$wgArticleFeedbackLotteryOdds = 100;
	$wgArticleFeedbackDashboard = true;
}

# Googlerating adds rich snippets on base of ArticleFeedback ratings
if ( wfExtensionExists( "GoogleRating" ) ) {
	$GoogleRatingUseAF = true;
	$GoogleRatingMax = '5';
}

# Scribunto
if ( wfExtensionExists( "Scribunto" ) ) {
	$wgScribuntoDefaultEngine = 'luastandalone';
	$wgScribuntoUseCodeEditor = true;
}

# Add's Facebook and G+ buttons to articles
if ( wfExtensionExists( "SocialButtons" ) ) {
	$wgSBDisallowedNamespaces = array('-1', '4', '5', '8', '9', '10', '12', '13');
	$wgSBDisallowedSiteTitles = array();
}

# Thanks
if ( wfExtensionExists( "Thanks" ) ) {
	$wgIncludejQueryMigrate = true;
	$wgThanksConfirmationRequired = true;
}

# MaintenanceShell
if ( wfExtensionExists( "MaintenanceShell" ) ) {
	$wgGroupPermissions['developer']['maintenanceshell'] = true;
}

# Maintenance
if ( wfExtensionExists( "Maintenance" ) ) {
	$wgGroupPermissions['developer']['maintenance'] = true;
}

# GoogleLogin
if ( wfExtensionExists( "GoogleLogin" ) ) {
	$wgGLSecret = $wmgGLSecret;
	$wgGLAppId = $wmgGLAppId;
	$wgGLAPIKey = $wmgGLAPIKey;
	$wgGLShowCreateReason = true;
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
	$wgVisualEditorParsoidURL = 'http://85.214.215.12:8142';
	$wgVisualEditorParsoidPrefix = 'droidwiki';
	$wgVisualEditorSupportedSkins = array( 'vector', 'apex', 'monobook', 'minerva', 'droidwiki' );
	$wgVisualEditorNamespaces = array_merge(
	$wgContentNamespaces,
		array(
			NS_TALK,
			NS_USER,
			NS_USER_TALK,
			NS_PROJECT,
			NS_PROJECT_TALK,
			NS_FILE,
			NS_FILE_TALK,
			NS_HELP,
			NS_HELP_TALK,
			NS_CATEGORY,
			NS_CATEGORY_TALK
		)
	);
}
