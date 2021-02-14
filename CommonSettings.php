<?php
# DO NOT PUT PRIVATE INFORMATION HERE!

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

require_once __DIR__ . '/multiversion/MWMultiVersion.php';
require_once __DIR__ . '/ServiceDiscovery.php';
require_once __DIR__ . '/logging.php';

$multiversion = MWMultiVersion::getInstance();
$services = new ServiceDiscovery();

# load PrivateSettings.php first
require_once __DIR__ . '/../private/PrivateSettings.php';

# Helper function to load InitialiseSettings when wgConf is ready for initialisation
function wmfLoadInitialiseSettings( $conf ) {
	require_once 'InitialiseSettings.php';
}

require_once __DIR__ . '/wgConf.php';

$wgDBname = $multiversion->getDBName();

require_once __DIR__ . '/db.php';

foreach ( $wgGroupOverrides as $group => $permissions ) {
	if ( !array_key_exists( $group, $wgGroupPermissions ) ) {
		$wgGroupPermissions[$group] = [];
	}
	$wgGroupPermissions[$group] = $permissions + $wgGroupPermissions[$group];
}

$wgArticlePath = '/wiki/$1';
$wgScriptPath = '/w';
$wgUsePathInfo = true;
$wgScriptExtension = '.php';
$wgStylePath = "$wgScriptPath/skins";
$wgEnableCanonicalServerLink = true;

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
$wgEnableRestAPI = true;

$wgEnotifUserTalk = false;
$wgEnotifWatchlist = false;
$wgEmailAuthentication = true;

$wgDBprefix = '';
$wgDBTableOptions = 'ENGINE=InnoDB, DEFAULT CHARSET=binary';

$wgShowDebug = false;
$wgShowExceptionDetails = false;
$wgShowSQLErrors = false;
$wgShowHostnames = true;

$wgShellLocale = 'en_US.utf8';
$wgDefaultSkin = 'vector';

$wgLogos = [
	'1x' => $wmgSiteLogo1x ?? null,
	'1.5x' => $wmgSiteLogo1_5x ?? null,
	'2x' => $wmgSiteLogo2x ?? null,
	'icon' => $wmgSiteLogoIcon ?? null,
	'wordmark' => $wmgSiteLogoWordmark ?? null,
	'tagline' => $wmgSiteLogoTagline ?? null,
	'variants' => $wmgSiteLogoVariants ?? null,
];

$wgLocalisationCacheConf['storeClass'] = LCStoreStaticArray::class;
$wgLocalisationCacheConf['storeDirectory'] = "$IP/cache/l10n";
$wgLocalisationCacheConf['manualRecache'] = true;

$wgCacheDirectory = '/data/mediawiki/cache/';
$wgGitInfoCacheDirectory = '/data/mediawiki/main/cache/gitinfo';
$wgMemCachedServers = $services->memcached();
$wgMainCacheType = CACHE_MEMCACHED;
$wgMessageCacheType = CACHE_MEMCACHED;
$wgSessionCacheType = CACHE_MEMCACHED;
$wgObjectCaches['redis'] = [
	'class' => 'RedisBagOStuff',
	'servers' => $services->redis(),
];
$wgMainStash = 'redis';

$wgParserCacheType = 'db-replicated';
$wgParserCacheExpireTime = 86400 * 30; // 30 days

$wgJobRunRate = 0;
$wgJobTypeConf['default'] = [
	'class' => 'JobQueueRedis',
	'redisServer' => $services->redis()[0],
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
$wgNativeImageLazyLoading = true;

# Enable subpages in the main namespace
$wgNamespacesWithSubpages[NS_MAIN] = true;
// ToDo: Remove in one of the next MW/wmf releases (gerrit #147229 or #154306)
$wgNamespacesWithSubpages[NS_SPECIAL] = true;

$wgAllowDisplayTitle = true;
$wgRestrictDisplayTitle = false;

$wgMiserMode = true;
$wgResourceLoaderMaxage['unversioned'] = 24 * 60 * 60;

$wgGitRepositoryViewers = array_merge( $wgGitRepositoryViewers,
	[
		'git@github.com:(.*).git' => 'https://github.com/%R/commit/%H',
		'https://github.com/(.*).git' => 'https://github.com/%R/commit/%H',
		'https://gerrit.wikimedia.org/r/(.*).git' => 'https://gerrit.wikimedia.org/g/%R/+/%H',
	]
);

$wgDisableOutputCompression = true;

if ( $wmgUseRestbase ) {
	$wgVirtualRestConfig['modules']['restbase'] = [
		'url' => 'http://restbase:7231',
		'domain' => $wmgRestbaseDomain,
		'forwardCookies' => false
	];
}

$wgGenerateThumbnailOnParse = false;
if ( $wmgUseDroidWikiForeignRepo ) {
	$wgForeignFileRepos[] = [
		'class' => ForeignDBViaLBRepo::class,
		'name' => 'shared',
		'directory' => '/data/shareddata/mediawiki/images/',
		'url' => 'https://www.droidwiki.org/w/images',
		'wiki' => 'droidwikiwiki',
		'hashLevels' => 2,
		'thumbScriptUrl' => false,
		'transformVia404' => !$wgGenerateThumbnailOnParse,
		'hasSharedCache' => true,
		'descBaseUrl' => 'https://www.droidwiki.org/wiki/File:',
		'fetchDescription' => true,
	];
	$wgUploadNavigationUrl = 'https://www.droidwiki.org/wiki/Special:Upload';
	$wgEnableUploads = false;
}

if ( $wmgUseInstantCommons ) {
	$wgForeignFileRepos[] = [
		'class' => ForeignAPIRepo::class,
		'name' => 'wikimediacommons',
		'apibase' => 'https://commons.wikimedia.org/w/api.php',
		'url' => 'https://upload.wikimedia.org/wikipedia/commons',
		'thumbUrl' => 'https://upload.wikimedia.org/wikipedia/commons/thumb',
		'hashLevels' => 2,
		'transformVia404' => true,
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 7 * 24 * 60 * 60,
		'apiThumbCacheExpiry' => 7 * 24 * 60 * 60,
	];
}

if ( $wmgUseVarnish ) {
	$wgUseCdn = true;
	$wgCdnMaxAge = 2678400; // 31 days
	$wgCdnServers = $services->varnish();
	// eclair.dwnet, donut.dwnet
	$wgCdnServersNoPurge = [ '10.0.6.12', '10.0.6.36' ];
	$wgUsePrivateIPs = true;
}

require_once __DIR__ . '/ExtensionSetup.php';

# THIS MUST BE AFTER ALL EXTENSIONS ARE INCLUDED
#
# REALLY ... we're not kidding here ... NO EXTENSIONS AFTER
require __DIR__ . '/ExtensionMessages.php';
