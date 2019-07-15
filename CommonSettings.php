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
require_once __DIR__ . '/logging.php';

$multiversion = MWMultiVersion::getInstance();

# load PrivateSettings.php first
require_once __DIR__ . '/../private/PrivateSettings.php';

# Helper function to load InitialiseSettings when wgConf is ready for initialisation
function wmfLoadInitialiseSettings( $conf ) {
	require_once 'InitialiseSettings.php';
}

require_once __DIR__ . '/wgConf.php';

wfApplyUserRightOverrides();

$wgDBname = $multiversion->getDBName();

require_once __DIR__ . '/db.php';

$wgShowHostnames = true;

$wgUsePathInfo = true;
$wgScriptExtension = '.php';

$wgUseGzip = true;

$wgStylePath = "$wgScriptPath/skins";

$wgSMTP = [
	'host'     => 'mail.droidwiki.org',
	'IDHost'   => 'mail.droidwiki.org',
	'port'     => 587,
	'auth'     => true,
	'username' => $wmgEmailUser,
	'password' => $wmgEmailPassword,
];

$wgEnableEmail = true;
$wgEnableUserEmail = true;

$wgEnotifUserTalk = false;
$wgEnotifWatchlist = false;
$wgEmailAuthentication = true;

$wgDBprefix = '';
$wgDBTableOptions = 'ENGINE=InnoDB, DEFAULT CHARSET=binary';

$wgShellLocale = 'en_US.utf8';

# Additional, alternative skins
wfLoadSkins( [ 'Vector', 'MonoBook' ] );

$wgLocalisationCacheConf['storeDirectory'] = "$IP/cache/l10n";

$wgAmazonPartnernetPartnerID = 'droand-21';

$wgDiff3 = "";

# Autopromote user to emailconfirmed after he confirmed his email address
$wgAutopromote['emailconfirmed'] = APCOND_EMAILCONFIRMED;

# Disable new RC Feed
$wgDefaultUserOptions['usenewrc'] = 0;

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

# Open links in new window
$wgExternalLinkTarget = '_blank';

# Allow DISPLAYTITLE Magic word
$wgAllowDisplayTitle = true;

# Do not restrict DISPLAYTITLE
$wgRestrictDisplayTitle = false;

# Performance things
$wgResourceLoaderStorageEnabled = true;
$wgMiserMode = true;
$wgResourceLoaderMaxage['unversioned'] = [
	'server' => 24 * 60 * 60,
	'client' => 24 * 60 * 60,
];

$wgGitRepositoryViewers = array_merge( $wgGitRepositoryViewers,
	[
		'git@github.com:(.*).git' => 'https://github.com/%R/commit/%H'
	]
);

if ( $wmgUseParsoid ) {
	$wgVirtualRestConfig['modules']['parsoid'] = [
		'url' => 'http://donut.dwnet:8142',
		'prefix' => $wgDBname, // deprecated
		'domain' => $wgCanonicalServer,
		'restbaseCompat' => false,
		'forwardCookies' => $wmgParsoidForwardCookies,
	];
}

if ( $wmgUseRestbase ) {
	$wgVirtualRestConfig['modules']['restbase'] = [
		'url' => 'http://donut.dwnet:7231',
		'domain' => $wmgRestbaseDomain,
		'forwardCookies' => false,
		'parsoidCompat' => false
	];
}

$wgGenerateThumbnailOnParse = false;
if ( $wmgUseDroidWikiForeignRepo ) {
	$wgUseSharedUploads = true;
	$wgSharedUploadPath = 'https://www.droidwiki.org/w/images';
	$wgSharedUploadDirectory = '/data/shareddata/mediawiki/images/';
	$wgHashedSharedUploadDirectory = true;
	$wgFetchCommonsDescriptions = true;
	$wgSharedUploadDBname = 'droidwikiwiki';
	$wgSharedUploadDBprefix = '';
	$wgRepositoryBaseUrl = 'https://www.droidwiki.org/wiki/File:';
	$wgDBuser = $wmgDatabaseUser;
	$wgDBpassword = $wmgDatabasePassword;
	$wgUploadNavigationUrl = 'https://www.droidwiki.org/wiki/Special:Upload';
	$wgEnableUploads = false;
}

if ( $wmgUseVarnish ) {
	$wgUseCdn = true;
	$wgCdnServersNoPurge = [ '172.16.0.1/16' ];
	$wgCdnServers = [ '172.16.0.1:6081' ];
	$wgUsePrivateIPs = true;
}

require_once __DIR__ . '/ExtensionSetup.php';

wfApplyUserRightOverrides();

# THIS MUST BE AFTER ALL EXTENSIONS ARE INCLUDED
#
# REALLY ... we're not kidding here ... NO EXTENSIONS AFTER
require __DIR__ . '/ExtensionMessages.php';
