<?php
	# DO NOT PUT PRIVATE INFORMATION HERE!

	# Protect against web entry
	if ( !defined( 'MEDIAWIKI' ) ) {
		exit;
	}

	# load PrivateSettings.php first
	require __DIR__ . "/../private/PrivateSettings.php";

	# Used in errorhandler
	$wgPHPLogFilePref = $wmgPHPLogFilePref;

	# Load Error Handler to handle php errors more beautiful
	require __DIR__ . "/../errorreporting/errorhandler.php";

	# Helper function to load InitialiseSettings when wgConf is ready for initialisation
	function wmfLoadInitialiseSettings( $conf ) {
		require "InitialiseSettings.php";
	}

	require __DIR__ . "/wgConf.php";


	# Load ProfileSettings
	# require( 'specialsources/mw-config/ProfileSettings.php' );

	$wgScriptPath = "";
	$wgArticlePath = "$wgScriptPath/$1";
	$wgUsePathInfo = true;
	$wgScriptExtension = ".php";
	$wgServer = "//www.droidwiki.de";

	# Varnish things
	$wgUseSquid = true;
	$wgSquidServers = array( '127.0.0.1' );
	$wgUseGzip = true;

	$wgStylePath = "$wgScriptPath/skins";

	$wgLogo = '/images/androide.png';
	$wgFavicon = '//www.droidwiki.de/images/favicon_with_W.ico';

        $wgSMTP = array(
                'host'     => 'bits.go2tech.de',
                'IDHost'   => 'droidwiki.de',
                'port'     => 587,
                'auth'     => true,
                'username' => $wmgEmailUser,
                'password' => $wmgEmailPassword,
        );

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

	# Additional, alternative skins
	wfLoadSkins( array( 'Vector', 'MonoBook' ) );

	# Do not show adbanners on this sites
	$wgNoAdSites = array(
		'Hauptseite',
		'',
		'Spezial:Anmelden',
		'Spezial:GoogleCSE',
		'Spezial:Raffle',
		'DroidWiki:Impressum'
	);

	$wgDiff3 = "";

	# Autopromote user to emailconfirmed after he confirmed his email address
	$wgAutopromote['emailconfirmed'] = APCOND_EMAILCONFIRMED;

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
		'svg',
		'ico',
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

	# Performance things
	$wgResourceLoaderStorageEnabled = true;
	$wgMiserMode = true;

	# Add go2tech repository to Git viewer list
	$wgGitRepositoryViewers = array_merge( $wgGitRepositoryViewers,
		array(
			'https://(?:[a-z0-9_\-]+@)?gerrit.go2tech.de/r/(?:p/)?(.*)' =>
				'http://git.go2tech.de/tree/?r=%r&h=%H',
			'ssh://(?:[a-z0-9_\-]+@)?gerrit.go2tech.de:29418/(.*)' =>
				'http://git.go2tech.de/tree/?r=%r&h=%H'
		)
	);

	require __DIR__ . "/ExtensionSetup.php";
