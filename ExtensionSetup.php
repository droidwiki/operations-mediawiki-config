<?php
	# DO NOT PUT PRIVATE INFORMATION HERE!

	# Extensions for DoridWiki skin
	require_once "$IP/extensions/EventLogging/EventLogging.php";
	require_once "$IP/extensions/VectorBeta/VectorBeta.php";
	$wgVectorBetaPersonalBar = true;
	# Hide the preference from beta-settings (it has to be standard in DroidWiki skin)
	$wgHiddenPrefs[] = 'betafeatures-vector-compact-personal-bar';

	# Configuration for ConfirmEdit
	require_once "$IP/extensions/ConfirmEdit/ConfirmEdit.php";
	require_once "$IP/extensions/ConfirmEdit/FancyCaptcha.php";
	$wgCaptchaDirectory = $wmgCaptchaDirectory;
	$wgCaptchaSecret = $wmgCaptchaSecret;
	$wgCaptchaClass = 'FancyCaptcha';
	$wgGroupPermissions['*']['skipcaptcha'] = false;
	$wgGroupPermissions['user']['skipcaptcha'] = true;
	$wgGroupPermissions['autoconfirmed']['skipcaptcha'] = true;
	$wgGroupPermissions['bot']['skipcaptcha'] = false;
	$wgGroupPermissions['sysop']['skipcaptcha'] = false;
	$wgGroupPermissions['emailconfirmed']['skipcaptcha'] = true;
	$ceAllowConfirmedEmail = true;

	# Trigger for ConfirmEdit
	$wgCaptchaTriggers['edit'] = true;
	$wgCaptchaTriggers['create'] = true;
	$wgCaptchaTriggers['addurl'] = true;
	$wgCaptchaTriggers['createaccount'] = true;
	$wgCaptchaTriggers['badlogin'] = true;

	# AntiSpoof (needed by AbuseFilter)
	require_once "$IP/extensions/AntiSpoof/AntiSpoof.php";

	# AbuseFilter
	require_once "$IP/extensions/AbuseFilter/AbuseFilter.php";
	$wgGroupPermissions['sysop']['abusefilter-modify'] = true;
	$wgGroupPermissions['*']['abusefilter-log-detail'] = true;
	$wgGroupPermissions['*']['abusefilter-view'] = true;
	$wgGroupPermissions['*']['abusefilter-log'] = true;
	$wgGroupPermissions['sysop']['abusefilter-private'] = true;
	$wgGroupPermissions['sysop']['abusefilter-modify-restricted'] = true;
	$wgGroupPermissions['sysop']['abusefilter-revert'] = true;

	# Spam BL
	require_once "$IP/extensions/SpamBlacklist/SpamBlacklist.php";
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
	);

	# Stop Forum Spam
	require_once "$IP/extensions/StopForumSpam/StopForumSpam.php";
	$wgSFSAPIKey = $wmgSFSAPIKey;
	$wgPutIPinRC = true;

	# GoogleCSE
	# require_once "$IP/extensions/GoogleCSE/GoogleCSE.php";
	# Redirect all Search requests to Google CSE
	# $wgSearchForwardUrl = 'http://www.droidwiki.de/Spezial:GoogleCSE?q=$1';
	# $wgDisableTextSearch = true;

	# Elasticsearch
	require_once "$IP/extensions/Elastica/Elastica.php";
	require_once "$IP/extensions/CirrusSearch/CirrusSearch.php";
	$wgSearchType = 'CirrusSearch';
	$wgCirrusSearchServers = array( '85.214.215.12' );
	# Enable the "experimental" highlighter
	$wgCirrusSearchUseExperimentalHighlighter = true;

	# WikiEditor/graphical Editor
	require_once "$IP/extensions/WikiEditor/WikiEditor.php";

	# CodeEditor (extension for WikiEditor
	require_once "$IP/extensions/CodeEditor/CodeEditor.php";
	# Enable it on JS/CSS pages
	$wgCodeEditorEnableCore = true;

	# Cite (ref-tags)
	require_once "$IP/extensions/Cite/Cite.php";

	# ParserFunctions
	require_once "$IP/extensions/ParserFunctions/ParserFunctions.php";

	# Syntaxhighlight
	require_once "extensions/SyntaxHighlight_GeSHi/SyntaxHighlight_GeSHi.php";

	# Add Google-Analytics
	require_once "$IP/extensions/googleAnalytics/googleAnalytics.php";
	$wgGoogleAnalyticsAccount = $wmgGoogleAnalyticsAccount;
	$wgGoogleAnalyticsIgnoreSysops = $wmgGoogleAnalyticsIgnoreSysops;
	$wgGoogleAnalyticsIgnoreBots = $wmgGoogleAnalyticsIgnoreBots;

	# Mantle for MobileFrontend
	require_once "$IP/extensions/Mantle/Mantle.php";

	# MobileFrontend
	require_once "$IP/extensions/MobileFrontend/MobileFrontend.php";
	$wgMobileFrontendLogo = "{$wgScriptPath}androide.png";
	$wgMFAutodetectMobileView = true;
	$wgMFAnonymousEditing = true;
	$wgMFEnableBeta = true;

	# MobileWebAd
	require_once "$IP/extensions/MobileWebAd/MobileWebAd.php";

	# Extensions needed by ArticleFeedback
	require_once "$IP/extensions/UserDailyContribs/UserDailyContribs.php";
	require_once "$IP/extensions/ClickTracking/ClickTracking.php";
	require_once "$IP/extensions/EmailCapture/EmailCapture.php";
	require_once "$IP/extensions/PrefSwitch/PrefSwitch.php";

	# ArticleFeedback
	require_once "$IP/extensions/ArticleFeedback/ArticleFeedback.php";
	$wgArticleFeedbackBlacklistCategories = array( 'KeinVoting' );
	$wgArticleFeedbackLotteryOdds = 100;
	$wgArticleFeedbackDashboard = true;

	# Googlerating adds rich snippets on base of ArticleFeedback ratings
	require_once "$IP/extensions/GoogleRating/GoogleRating.php";
	$GoogleRatingUseAF = true;
	$GoogleRatingMax = '5';

	# Generates a sitemap for search engines
	require_once "$IP/extensions/ManualSitemap/ManualSitemap.php";

	# Add meta description to articles
	require_once "$IP/extensions/Description2/Description2.php";

	# Canonical Links
	require_once "$IP/extensions/CanonURL/CanonURL.php";

	# InputBox
	require_once "$IP/extensions/InputBox/InputBox.php";

	# TitleKey
	require_once "$IP/extensions/TitleKey/TitleKey.php";

	# NewestPages
	require_once "$IP/extensions/NewestPages/NewestPages.php";

	# TagCloud
	require_once "$IP/extensions/WikiCategoryTagCloud/WikiCategoryTagCloud.php";

	# OpenGraphMeta-Tag Feature for Social Media
	require_once "$IP/extensions/OpenGraphMeta/OpenGraphMeta.php";

	# MultimediaViwer and CommonsMetadata (replaces FancyBox)
	require_once "$IP/extensions/MultimediaViewer/MultimediaViewer.php";
	require_once "$IP/extensions/CommonsMetadata/CommonsMetadata.php";

	# Add amazon id to amazon links
	require_once "$IP/extensions/Dereferer/Dereferer.php";

	# Allows to embed YouTube videos into wikipages
	require_once "$IP/extensions/Embedvideo/EmbedVideo.php";

	# Adds a search field to 404 pages
	require_once "$IP/extensions/Special404/Special404.php";

	# Provides a contact form
	require_once "$IP/extensions/Tipp/Tipp.php";

	# Scribunto
	require_once "$IP/extensions/Scribunto/Scribunto.php";
	$wgScribuntoDefaultEngine = 'luastandalone';
	$wgScribuntoUseCodeEditor = true;

	# Add's Facebook and G+ buttons to articles
	require_once "$IP/extensions/SocialButtons/SocialButtons.php";
	$wgSBDisallowedNamespaces = array('-1', '4', '5', '8', '9', '10', '12', '13');
	$wgSBDisallowedSiteTitles = array();

	# Disambiguator
	require_once "$IP/extensions/Disambiguator/Disambiguator.php";

	# DynamicPageList
	require_once "$IP/extensions/intersection/DynamicPageList.php";

	# Echo Notifications
	require_once "$IP/extensions/Echo/Echo.php";

	# Thanks
	require_once "$IP/extensions/Thanks/Thanks.php";
	$wgIncludejQueryMigrate = true;
	$wgThanksConfirmationRequired = true;

	# CMDev loads a list of supported CyanogenMod devices
	require_once "$IP/extensions/CyanogenModDev/CyanogenModDev.php";

	# BeatFutures
	require_once "$IP/extensions/BetaFeatures/BetaFeatures.php";

	# PageImages (needed by MobileFrontend and HoverCards)
	require_once "$IP/extensions/PageImages/PageImages.php";

	# TextExtracts (needed by MobileFrontend and HoverCards)
	require_once "$IP/extensions/TextExtracts/TextExtracts.php";

	# Popups
	require_once "$IP/extensions/Popups/Popups.php";

	# MaintenanceShell
	require_once "$IP/extensions/MaintenanceShell/MaintenanceShell.php";
	$wgGroupPermissions['developer']['maintenanceshell'] = true;

	# Maintenance
	require_once "$IP/extensions/Maintenance/Maintenance.php";
	$wgGroupPermissions['developer']['maintenance'] = true;

	# ExpandTamplates
	require_once "$IP/extensions/ExpandTemplates/ExpandTemplates.php";

	# GoogleLogin
	require_once "$IP/extensions/GoogleLogin/GoogleLogin.php";
	$wgGLSecret = $wmgGLSecret;
	$wgGLAppId = $wmgGLAppId;
	$wgGLShowCreateReason = true;

	# CentralNotice - 01.08.2014
	require_once "$IP/extensions/CentralNotice/CentralNotice.php";
	$wgNoticeInfrastructure = true;
	$wgNoticeProjects = array( 'droidwiki' );
	$wgNoticeProject = 'droidwiki';

	require_once "$IP/extensions/GoogleAPIClient/GoogleAPIClient.php";
	require_once "$IP/extensions/GoogleAnalyticsTopPages/GoogleAnalyticsTopPages.php";
	$wgGATPProfileId = $wmgGATPProfileId;
	$wgGATPKeyFileLocation = $wmgGATPKeyFileLocation;
	$wgGATPServiceAccountName = $wmgGATPServiceAccountName;
