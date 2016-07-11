<?php
	# DO NOT PUT PRIVATE INFORMATION HERE!

	# Protect against web entry
	if ( !defined( 'MEDIAWIKI' ) ) {
		exit;
	}

	function wfApplyUserRightOverrides() {
		global $groupOverrides, $wgGroupPermissions;

		// apply group overrides as aerly as possible
		foreach ( $groupOverrides as $group => $permissions ) {
			if ( !array_key_exists( $group, $wgGroupPermissions ) ) {
				$wgGroupPermissions[$group] = [];
			}
			$wgGroupPermissions[$group] = $permissions + $wgGroupPermissions[$group];
		}
	}

	require_once __DIR__ . '/multiversion/MWMultiVersion.php';

	$multiversion = MWMultiVersion::getInstance();

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

	wfApplyUserRightOverrides();

	# Load ProfileSettings
	# require( 'specialsources/mw-config/ProfileSettings.php' );

	if ( $wgDBname === 'droidwikiwiki' ) {
		$wgScriptPath = "";
		$wgArticlePath = "$wgScriptPath/$1";
	} else {
		$wgArticlePath = "/wiki/$1";
		$wgScriptPath = "/w";
	}
	$wgUsePathInfo = true;
	$wgScriptExtension = ".php";

	# Varnish things
	$wgUseSquid = true;
	$wgSquidServers = [ '127.0.0.1' ];
	$wgUseGzip = true;

	$wgStylePath = "$wgScriptPath/skins";

	// FIXME: Move this config to InitialiseSettings and the favicon to static/ - T8
	$wgFavicon = '//www.droidwiki.de/images/favicon_with_W.ico';

        $wgSMTP = [
                'host'     => 'bits.go2tech.de',
                'IDHost'   => 'droidwiki.de',
                'port'     => 587,
                'auth'     => true,
                'username' => $wmgEmailUser,
                'password' => $wmgEmailPassword,
		];

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
	wfLoadSkins( [ 'Vector', 'MonoBook' ] );

	# Do not show adbanners on this sites
	$wgNoAdSites = [
		'Hauptseite',
		'',
		'Spezial:Anmelden',
		'Spezial:GoogleCSE',
		'Spezial:Raffle',
		'DroidWiki:Impressum'
	];

	$wgDiff3 = "";

	# Autopromote user to emailconfirmed after he confirmed his email address
	$wgAutopromote['emailconfirmed'] = APCOND_EMAILCONFIRMED;

	# Disable new RC Feed
	$wgDefaultUserOptions['usenewrc'] = 0;

	$wgResourceLoaderMaxQueryLength = -1;

	$wgEnableUploads  = true;
	$wgAllowExternalImages = true;

	$wgFileExtensions = [
		'png',
		'gif',
		'jpg',
		'jpeg',
		'pdf',
		'pptx',
		'zip',
		'svg',
		'ico',
	];

	# Enable subpages in the main namespace
	$wgNamespacesWithSubpages[NS_MAIN] = true;
	// ToDo: Remove in one of the next MW/wmf releases (gerrit #147229 or #154306)
	$wgNamespacesWithSubpages[NS_SPECIAL] = true;

	# Spam protection
	$wgEnableDnsBlacklist = true;
	$wgDnsBlacklistUrls = [
		'xbl.spamhaus.org',
		'opm.tornevall.org'
	];

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
		[
			'https://(?:[a-z0-9_\-]+@)?gerrit.go2tech.de/r/(?:p/)?(.*)' =>
				'http://git.go2tech.de/?p=%r.git&a=commit&h=%H',
			'ssh://(?:[a-z0-9_\-]+@)?gerrit.go2tech.de:29418/(.*)' =>
				'http://git.go2tech.de/?p=%r.git&a=commit&h=%H'
		]
	);

	if ( $wmgUseParsoid ) {
		$wgVirtualRestConfig['modules']['parsoid'] = [
			'url' => 'http://37.120.178.25:8142',
			'prefix' => $wgDBname, // deprecated
			'domain' => $wgCanonicalServer,
			'restbaseCompat' => false,
			'forwardCookies' => $wmgParsoidForwardCookies,
		];
	}

	require __DIR__ . "/ExtensionSetup.php";

	wfApplyUserRightOverrides();
