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

$wgArticlePath = '/wiki/$1';
$wgScriptPath = '/w';
$wgUsePathInfo = true;
$wgScriptExtension = '.php';
$wgStylePath = "$wgScriptPath/skins";

$wgFavicon = '/static/images/favicons/favicon.ico';
$wgLocaltimezone = 'Europe/Berlin';

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

$wgShowDebug = false;
$wgShowExceptionDetails = false;
$wgShowSQLErrors = false;

$wgShellLocale = 'en_US.utf8';

# Additional, alternative skins
wfLoadSkins( [ 'Vector', 'MonoBook' ] );
$wgDefaultSkin = 'vector';

$wgLocalisationCacheConf = [
	'class' => 'LocalisationCache',
	'store' => 'detect',
	'storeClass' => false,
	'manualRecache' => true,
	'storeDirectory' => "$IP/cache/l10n",
];
$wgCacheDirectory = '/data/mediawiki/cache/';
$wgGitInfoCacheDirectory = '/data/mediawiki/main/cache/gitinfo';
$wgMemCachedServers = [ '172.16.0.1:11211', '172.16.0.2:11211' ];
$wgMainCacheType = CACHE_MEMCACHED;
$wgParserCacheType = CACHE_MEMCACHED;
$wgMessageCacheType = CACHE_MEMCACHED;
$wgSessionCacheType = CACHE_MEMCACHED;
$wgObjectCaches['redis'] = [
	'class' => 'RedisBagOStuff',
	'servers' => [ '172.16.0.1:6379' ],
];
$wgMainStash = 'redis';

$wgJobTypeConf['default'] = [
	'class' => 'JobQueueRedis',
	'redisServer' => '172.16.0.1:6379',
	'redisConfig' => [],
	'claimTTL' => 3600,
	'daemonized' => true,
];

$wgAmazonPartnernetPartnerID = 'droand-21';

$wgDiff3 = "";

# Autopromote user to emailconfirmed after he confirmed his email address
$wgAutopromote['emailconfirmed'] = APCOND_EMAILCONFIRMED;

# Disable new RC Feed
$wgDefaultUserOptions['usenewrc'] = 0;

$wgEnableUploads  = true;
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
$wgMaxImageArea = 5e7;
$wgSVGConverters = [
	'ImageMagick' => '/usr/bin/convert $input -background transparent $output'
];
$wgSVGConverter = 'ImageMagick';
$wgSVGConverterPath = '/usr/bin/';

# Enable subpages in the main namespace
$wgNamespacesWithSubpages[NS_MAIN] = true;
// ToDo: Remove in one of the next MW/wmf releases (gerrit #147229 or #154306)
$wgNamespacesWithSubpages[NS_SPECIAL] = true;

$wgAllowDisplayTitle = true;
$wgRestrictDisplayTitle = false;

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
