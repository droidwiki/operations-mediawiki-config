<?php
	# DO NOT PUT PRIVATE INFORMATION HERE!

	# Jenkins-Test
	# Protect against web entry
	if ( !defined( 'MEDIAWIKI' ) ) {
		exit;
	}

	# load PrivateSettings.php first
	require "$IP/specialsources/PrivateSettings.php";

	# Used in errorhandler
	$wgPHPLogFilePref = $wmgPHPLogFilePref;

	# Load Error Handler to handle php errors more beautiful
	require "$IP/specialsources/errorreporting/errorhandler.php";

	# Helper function to load InitialiseSettings when wgConf is ready for initialisation
	function wmfLoadInitialiseSettings( $conf ) {
		require "InitialiseSettings.php";
	}

	require "$IP/specialsources/mw-config/wgConf.php";

	# Load ProfileSettings
	# require( 'specialsources/mw-config/ProfileSettings.php' );

	$wgScriptPath = "";
	$wgArticlePath = "$wgScriptPath/$1";
	$wgUsePathInfo = true;
	$wgScriptExtension = ".php";

	if( $wmgWikiName !== 'testdroidwiki' ) {
		$wgLoadScript = '//bits.go2tech.de/load.php';
	}

	$wgStylePath = "$wgScriptPath/skins";

	$wgLogo = 'androide.png';
	$wgFavicon = 'images/favicon.ico';

	$wgEnableEmail = true;
	$wgEnableUserEmail = true;

	$wgEmergencyContact = "info@droidwiki.de";
	$wgPasswordSender = "info@droidwiki.de";

	$wgEnotifUserTalk = false;
	$wgEnotifWatchlist = false;
	$wgEmailAuthentication = true;

	$wgDBprefix = "";
	$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

	$wgShellLocale = "en_US.utf8";

	$wgLanguageCode = "de";

	# DroidWiki Design
	require_once ( "$IP/skins/droidwiki/DroidWiki.php" );

	# Additional, alternative skins
	require_once ( "$IP/skins/Vector/Vector.php" );
	require_once ( "$IP/skins/MonoBook/MonoBook.php" );

	# Do not show adbanners on this sites
	$wgNoAdSites = array(
		'Hauptseite',
		'',
		'Spezial:Anmelden',
		'Spezial:GoogleCSE',
		'Spezial:Raffle',
		'DroidWiki:Impressum'
	);

	$wgGPlusId = "103862846105145420159";

	$wgDiff3 = "";

	# Special user groups
	$wgGroupPermissions['Testnutzer'] = $wgGroupPermissions['user'];
	$wgGroupPermissions['Autopatrol'] = $wgGroupPermissions['user'];
	$wgGroupPermissions['Moderator'] = $wgGroupPermissions['user'];

	$wgAutopromote['emailconfirmed'] = APCOND_EMAILCONFIRMED;

	$wgGroupPermissions['suppress']['deleterevision'] = true;
	$wgGroupPermissions['suppress']['suppressrevision'] = true;
	$wgGroupPermissions['suppress']['deletelogentry'] = true;
	$wgGroupPermissions['suppress']['deleterevision'] = true;
	$wgGroupPermissions['suppress']['suppressionlog'] = true;
	$wgGroupPermissions['suppress']['hideuser'] = true;

	# Disable new RC Feed
	$wgDefaultUserOptions['usenewrc'] = 0;

	$wgResourceLoaderMaxQueryLength = -1;

	$wgEnableUploads  = true;
	$wgAllowExternalImages = true;

	$wgFileExtensions = array(
		'png',
		'gif',
		'jpg',
		'jpeg',
		'pdf',
		'pptx',
		'zip',
		'svg'
	);

	# Enable subpages in the main namespace
	$wgNamespacesWithSubpages[NS_MAIN] = true;
	// ToDo: Remove in one of the next MW/wmf releases (gerrit #147229 or #154306)
	$wgNamespacesWithSubpages[NS_SPECIAL] = true;

	# Spam protection
	$wgEnableDnsBlacklist = true;
	$wgDnsBlacklistUrls = array(
		'xbl.spamhaus.org',
		'opm.tornevall.org'
	);

	# AJAX Search Suggestions
	$wgEnableMWSuggest = true;
	$wgEnableOpenSearchSuggest = true;

	# Open links in new window
	$wgExternalLinkTarget = '_blank';

	# Allow DISPLAYTITLE Magic word
	$wgAllowDisplayTitle = true;

	# Do not restrict DISPLAYTITLE
	$wgRestrictDisplayTitle = false;

	# MediaWiki UI everywhere
	$wgUseMediaWikiUIEverywhere = true;

	# Add go2tech repository to Git viewer list
	$wgGitRepositoryViewers = array_merge( $wgGitRepositoryViewers,
		array(
			'https://(?:[a-z0-9_\-]+@)?gerrit.go2tech.de/r/(?:p/)?(.*)' =>
				'http://git.go2tech.de/tree/?r=%r&h=%H',
			'ssh://(?:[a-z0-9_\-]+@)?gerrit.go2tech.de:29418/(.*)' =>
				'http://git.go2tech.de/tree/?r=%r&h=%H'
		)
	);

	# load Extension configuration
	if ( $wmgWikiName === 'testdroidwiki' ) {
		$extSuffix = '-pre';
	} else {
		$extSuffix = '';
	}
	require "$IP/specialsources/mw-config/ExtensionSetup{$extSuffix}.php";
