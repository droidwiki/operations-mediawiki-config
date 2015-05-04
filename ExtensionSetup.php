<?php
	# DO NOT PUT PRIVATE INFORMATION HERE!

	function wfLoadExtensionFile( $name, $required ) {
		if ( file_exists( "$IP/$name/$name.php" ) ) {
			if ( $required ) {
				require_once "$IP/$name/$name.php";
			} else {
				include_once "$IP/$name/$name.php";
			}
			return true;
		}
		return false;
	}

	# Extensions for DoridWiki skin
	if ( wfLoadExtensionFile( "VectorBeta", false ) ) {
		$wgVectorBetaPersonalBar = true;
		# Hide the preference from beta-settings (it has to be standard in DroidWiki skin)
		$wgHiddenPrefs[] = 'betafeatures-vector-compact-personal-bar';
	}

	# Configuration for ConfirmEdit
	if ( wfLoadExtensionFile( "ConfirmEdit", false ) ) {
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

	# AntiSpoof (needed by AbuseFilter)
	wfLoadExtensionFile( "AntiSpoof", false );

	# AbuseFilter
	if ( wfLoadExtensionFile( "AbuseFilter", false ) ) {
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
	if ( wfLoadExtensionFile( "StopForumSpam", false ) ) {
		$wgSFSAPIKey = $wmgSFSAPIKey;
		$wgPutIPinRC = true;
	}

	# GoogleCSE
	# require_once "$IP/extensions/GoogleCSE/GoogleCSE.php";
	# Redirect all Search requests to Google CSE
	# $wgSearchForwardUrl = 'http://www.droidwiki.de/Spezial:GoogleCSE?q=$1';
	# $wgDisableTextSearch = true;

	# Elasticsearch
	if ( wfLoadExtensionFile( "Elastica", false ) && wfLoadExtensionFile( "CirrusSearch", false ) ) {
		$wgSearchType = 'CirrusSearch';
		$wgCirrusSearchPowerSpecialRandom = $wmgCirrusSearchPowerSpecialRandom;
		$wgCirrusSearchServers = array( '85.214.215.12' );
		# Enable the "experimental" highlighter
		# $wgCirrusSearchUseExperimentalHighlighter = true;
	}

	# WikiEditor/graphical Editor
	if ( wfLoadExtensionFile( "WikiEditor", false ) ) {
		$wgDefaultUserOptions['usebetatoolbar'] = 1;
		$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;
		$wgDefaultUserOptions['wikieditor-preview'] = 1;
	}

	# CodeEditor (extension for WikiEditor
	if ( wfLoadExtensionFile( "CodeEditor", false ) ) {
		# Enable it on JS/CSS pages
		$wgCodeEditorEnableCore = true;
	}

	# Cite (ref-tags)
	wfLoadExtensionFile( "Cite", false );

	# ParserFunctions
	wfLoadExtensionFile( "ParserFunctions", false );

	# Syntaxhighlight
	wfLoadExtensionFile( "SyntaxHighlight_GeSHi", false );

	# Add Google-Analytics
	if ( wfLoadExtensionFile( "googleAnalytics", false ) ) {
		$wgGoogleAnalyticsAccount = $wmgGoogleAnalyticsAccount;
		$wgGoogleAnalyticsIgnoreSysops = $wmgGoogleAnalyticsIgnoreSysops;
		$wgGoogleAnalyticsIgnoreBots = $wmgGoogleAnalyticsIgnoreBots;
	}

	# MobileFrontend
	if ( wfLoadExtensionFile( "MobileFrontend", false ) ) {
		$wgMobileFrontendLogo = "{$wgScriptPath}androide.png";
		$wgMFAutodetectMobileView = true;
		$wgMFEditorOptions['anonymousEditing'] = true;
		$wgMFEnableBeta = true;
	}

	# MobileWebAd
	wfLoadExtensionFile( "MobileWebAd", false );

	# Extensions needed by ArticleFeedback
	wfLoadExtensionFile( "UserDailyContribs", false );
	wfLoadExtensionFile( "ClickTracking", false );
	wfLoadExtensionFile( "EmailCapture", false );

	# ArticleFeedback
	if ( wfLoadExtensionFile( "ArticleFeedback", false ) ) {
		$wgArticleFeedbackBlacklistCategories = array( 'KeinVoting' );
		$wgArticleFeedbackLotteryOdds = 100;
		$wgArticleFeedbackDashboard = true;
	}

	# Googlerating adds rich snippets on base of ArticleFeedback ratings
	if ( wfLoadExtensionFile( "GoogleRating", false ) ) {
		$GoogleRatingUseAF = true;
		$GoogleRatingMax = '5';
	}

	# Add meta description to articles
	wfLoadExtensionFile( "Description2", false );

	# Canonical Links
	wfLoadExtensionFile( "CanonURL", false );

	# InputBox
	wfLoadExtensionFile( "InputBox", false );

	# TitleKey
	wfLoadExtensionFile( "TitleKey", false );

	# OpenGraphMeta-Tag Feature for Social Media
	wfLoadExtensionFile( "OpenGraphMeta", false );

	# MultimediaViwer and CommonsMetadata (replaces FancyBox)
	wfLoadExtensionFile( "MultimediaViwer", false );
	wfLoadExtensionFile( "CommonsMetadata", false );

	# Add amazon id to amazon links
	wfLoadExtensionFile( "Dereferer", false );

	# Allows to embed YouTube videos into wikipages
	wfLoadExtensionFile( "EmbedVideo", false );

	# Scribunto
	if ( wfLoadExtensionFile( "Scribunto", false ) ) {
		$wgScribuntoDefaultEngine = 'luastandalone';
		$wgScribuntoUseCodeEditor = true;
	}

	# Add's Facebook and G+ buttons to articles
	if ( wfLoadExtensionFile( "SocialButtons", false ) ) {
		$wgSBDisallowedNamespaces = array('-1', '4', '5', '8', '9', '10', '12', '13');
		$wgSBDisallowedSiteTitles = array();
	}

	# Disambiguator
	wfLoadExtensionFile( "Disambiguator", false );

	# DynamicPageList
	wfLoadExtensionFile( "DynamicPageList", false );

	# Echo Notifications
	wfLoadExtensionFile( "Echo", false );

	# Thanks
	if ( wfLoadExtensionFile( "Thanks", false ) ) {
		$wgIncludejQueryMigrate = true;
		$wgThanksConfirmationRequired = true;
	}

	# CMDev loads a list of supported CyanogenMod devices
	wfLoadExtensionFile( "CyanogenModDev", false );

	# BeatFutures
	wfLoadExtensionFile( "BetaFeatures", false );

	# PageImages (needed by MobileFrontend and HoverCards)
	wfLoadExtensionFile( "PageImages", false );

	# TextExtracts (needed by MobileFrontend and HoverCards)
	wfLoadExtensionFile( "TextExtracts", false );

	# Popups
	wfLoadExtensionFile( "Popups", false );

	# MaintenanceShell
	if ( wfLoadExtensionFile( "MaintenanceShell", false ) ) {
		$wgGroupPermissions['developer']['maintenanceshell'] = true;
	}

	# Maintenance
	if ( wfLoadExtensionFile( "Maintenance", false ) ) {
		$wgGroupPermissions['developer']['maintenance'] = true;
	}

	# ExpandTamplates
	wfLoadExtensionFile( "ExpandTamplates", false );

	# GoogleLogin
	if ( wfLoadExtensionFile( "GoogleLogin", false ) ) {
		$wgGLSecret = $wmgGLSecret;
		$wgGLAppId = $wmgGLAppId;
		$wgGLAPIKey = $wmgGLAPIKey;
		$wgGLShowCreateReason = true;
	}

	# CentralNotice - 01.08.2014
	if ( wfLoadExtensionFile( "CentralNotice", false ) ) {
		$wgNoticeInfrastructure = true;
		$wgNoticeProjects = array( 'droidwiki' );
		$wgNoticeProject = 'droidwiki';
	}

	if (
		wfLoadExtensionFile ( "GoogleAPIClient", false ) &&
		wfLoadExtensionFile ( "GoogleAnalyticsTopPages", false )
	) {
		$wgGATPProfileId = $wmgGATPProfileId;
		$wgGATPKeyFileLocation = $wmgGATPKeyFileLocation;
		$wgGATPServiceAccountName = $wmgGATPServiceAccountName;
	}

	# TemplateData
	if ( wfLoadExtensionFile( "TemplateData", false ) ) {
		$wgTemplateDataUseGUI = true;
	}

	# VisualEditor
	if ( wfLoadExtensionFile ( "VisualEditor", false ) ) {
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

	wfLoadExtensionFile ( "DroidWiki", false );

	// TimedMediaHandler
	wfLoadExtensionFile ( "MwEmbedSupport", false );
	wfLoadExtensionFile ( "TimedMediaHandler", false );
