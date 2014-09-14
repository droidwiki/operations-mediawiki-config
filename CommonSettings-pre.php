<?php
	# DO NOT PUT PRIVATE INFORMATION HERE!

	# Load Error Handler to handle php errors more beautiful
	require "$IP/specialsources/errorreporting/errorhandler.php";

	# Load ProfileSettings
	# require( 'specialsources/mw-config/ProfileSettings.php' );

	# Protect against web entry
	if ( !defined( 'MEDIAWIKI' ) ) {
		exit;
	}

	# load PrivateSettings.php first
	require "$IP/specialsources/PrivateSettings.php";

	$wgSitename      = "Android Test-Wiki";
	$wgMetaNamespace = "DroidWiki-pre";

	# set correct Timezone
	$wgLocaltimezone = "Europe/Berlin";
	putenv( "TZ=$wgLocaltimezone" );

	## The URL base path to the directory containing the wiki;
	## defaults for all runtime URL paths are based off of this.
	## For more information on customizing the URLs please see:
	## http://www.mediawiki.org/wiki/Manual:Short_URL
	$wgScriptPath = "";
	$wgArticlePath = "$wgScriptPath/$1";
	$wgUsePathInfo = true;
	$wgScriptExtension = ".php";

	## The relative URL path to the skins directory
	$wgStylePath = "$wgScriptPath/skins";

	## The relative URL path to the logo.  Make sure you change this from the default,
	## or else you'll overwrite your logo when you upgrade!
	$wgLogo = 'androide.png';
	$wgFavicon = 'images/favicon.ico';

	## UPO means: this is also a user preference option
	$wgEnableEmail = true;
	$wgEnableUserEmail = true; # UPO

	$wgEmergencyContact = "info@droidwiki.de";
	$wgPasswordSender = "info@droidwiki.de";

	$wgEnotifUserTalk = false; # UPO
	$wgEnotifWatchlist = false; # UPO
	$wgEmailAuthentication = true;

	# MySQL specific settings
	$wgDBprefix = "wiki_";

	# MySQL table options to use during installation or update
	$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";


	## If you use ImageMagick (or any other shell command) on a
	## Linux server, this will need to be set to the name of an
	## available UTF-8 locale
	$wgShellLocale = "en_US.utf8";

	# Site language code, should be one of ./languages/Language(.*).php
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
	## Default skin: you can change the default skin. Use the internal symbolic
	## names, ie 'standard', 'nostalgia', 'cologneblue', 'monobook', 'vector':
	$wgDefaultSkin = "droidwiki";

	# Path to the GNU diff3 utility. Used for conflict resolution.
	$wgDiff3 = "";

	# Enable Patrol of revisions
	$wgUseRCPatrol = true;

	# Implicit group for all visitors
	$wgGroupPermissions['*']['createaccount'] = false;
	$wgGroupPermissions['*']['edit'] = false;
	$wgGroupPermissions['*']['createpage'] = false;
	$wgGroupPermissions['*']['createtalk'] = false;
	$wgGroupPermissions['*']['read'] = true;

	# Testuser-gruppe
	$wgGroupPermissions['Testnutzer'] =  $wgGroupPermissions['user'];

	# Implicit group for all logged-in accounts
	$wgGroupPermissions['user']['move'] = false;
	$wgGroupPermissions['user']['read'] = false;
	$wgGroupPermissions['user']['edit'] = false;
	$wgGroupPermissions['user']['createpage'] = false;
	$wgGroupPermissions['user']['createtalk'] = false;
	$wgGroupPermissions['user']['upload'] = false;
	$wgGroupPermissions['user']['reupload'] = false;
	$wgGroupPermissions['user']['reupload-shared'] = false;
	$wgGroupPermissions['user']['minoredit'] = false;

	# Berechtigungen für Nutzer, dessen Änderungen automatisch als kontrolliert markiert werden
	$wgGroupPermissions['Autopatrol'] = $wgGroupPermissions['user'];
	$wgGroupPermissions['Autopatrol']['autopatrol'] = true;

	# Moderatorrolle zum Löschen, verschieben und als kontrolliert markieren von Seiten
	$wgGroupPermissions['Moderator'] = $wgGroupPermissions['user'];
	$wgGroupPermissions['Moderator']['autopatrol'] = true;
	$wgGroupPermissions['Moderator']['proxyunbannable'] = true;
	$wgGroupPermissions['Moderator']['delete'] = true;
	$wgGroupPermissions['Moderator']['move'] = true;
	$wgGroupPermissions['Moderator']['patrol'] = true;
	$wgGroupPermissions['user']['purge'] = false;

	# Implicit group for accounts that pass $wgAutoConfirmAge
	$wgGroupPermissions['autoconfirmed']['autoconfirmed'] = true;

	$wgAutopromote['emailconfirmed'] = APCOND_EMAILCONFIRMED;

	# Implicit group for accounts with confirmed email addresses
	# This has little use when email address confirmation is off
	$wgGroupPermissions['emailconfirmed']['emailconfirmed'] = true;

	# Users with bot privilege can have their edits hidden
	# from various log pages by default
	$wgGroupPermissions['bot']['bot'] = true;
	$wgGroupPermissions['bot']['autoconfirmed'] = true;
	$wgGroupPermissions['bot']['nominornewtalk'] = true;
	$wgGroupPermissions['bot']['autopatrol'] = true;

	# Most extra permission abilities go to this group
	$wgGroupPermissions['sysop']['move'] = true;
	$wgGroupPermissions['sysop']['read'] = true;
	$wgGroupPermissions['sysop']['edit'] = true;
	$wgGroupPermissions['sysop']['createpage'] = true;
	$wgGroupPermissions['sysop']['createtalk'] = true;
	$wgGroupPermissions['sysop']['upload'] = true;
	$wgGroupPermissions['sysop']['reupload'] = true;
	$wgGroupPermissions['sysop']['reupload-shared'] = true;
	$wgGroupPermissions['sysop']['minoredit'] = true;
	$wgGroupPermissions['sysop']['block'] = true;
	$wgGroupPermissions['sysop']['delete'] = true;
	$wgGroupPermissions['sysop']['deletedhistory'] = true;
	$wgGroupPermissions['sysop']['editinterface'] = true;
	$wgGroupPermissions['sysop']['import'] = true;
	$wgGroupPermissions['sysop']['importupload'] = true;
	$wgGroupPermissions['sysop']['move'] = true;
	$wgGroupPermissions['sysop']['patrol'] = true;
	$wgGroupPermissions['sysop']['autopatrol'] = true;
	$wgGroupPermissions['sysop']['protect'] = true;
	$wgGroupPermissions['sysop']['proxyunbannable'] = true;
	$wgGroupPermissions['sysop']['rollback'] = true;
	$wgGroupPermissions['sysop']['trackback'] = true;
	$wgGroupPermissions['sysop']['upload'] = true;
	$wgGroupPermissions['sysop']['reupload'] = true;
	$wgGroupPermissions['sysop']['reupload-shared'] = true;
	$wgGroupPermissions['sysop']['unwatchedpages'] = true;
	$wgGroupPermissions['sysop']['autoconfirmed'] = true;
	$wgGroupPermissions['sysop']['upload_by_url'] = true;
	$wgGroupPermissions['sysop']['ipblock-exempt'] = true;
	$wgGroupPermissions['suppress']['deleterevision'] = true;
	$wgGroupPermissions['suppress']['suppressrevision'] = true;
	$wgGroupPermissions['suppress']['deletelogentry'] = true;
	$wgGroupPermissions['suppress']['deleterevision'] = true;
	$wgGroupPermissions['suppress']['suppressionlog'] = true;
	$wgGroupPermissions['suppress']['hideuser'] = true;

	# Permission to change users' group assignments
	$wgGroupPermissions['bureaucrat']['userrights'] = true;

	# Allow User Scripts
	$wgAllowUserJs = true;
	$wgDefaultUserOptions['usebetatoolbar'] = 1;
	$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;
	$wgDefaultUserOptions['wikieditor-preview'] = 1;

	# Query string length limit for ResourceLoader. You should only set this if
	# your web server has a query string length limit (then set it to that limit),
	# or if you have suhosin.get.max_value_length set in php.ini (then set it to
	# that value)
	$wgResourceLoaderMaxQueryLength = -1;

	$wgEnableUploads  = true;
	$wgAllowExternalImages = true;
	$wgUseInstantCommons = true;
	$wgMaxImageArea = 5e7;

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

	# SVG converters
	$wgSVGConverters = array(
		'ImageMagick' => '/usr/bin/convert $input -background transparent $output'
	);
	$wgSVGConverter = 'ImageMagick';
	$wgSVGConverterPath = '/usr/bin/';

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

	$wgHitcounterUpdateFreq = 100;
	$wgSessionsInObjectCache = true;
	$wgMainCacheType = CACHE_DB;

	$wgShowDebug = false;
	$wgShowExceptionDetails = true;
	$wgShowSQLErrors = false;

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
	require "$IP/specialsources/mw-config/ExtensionSetup-pre.php";
