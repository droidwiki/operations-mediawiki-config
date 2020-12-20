<?php

$wgConf = new SiteConfiguration;

$wgConf->wikis = [
	'droidwikiwiki',
	'endroidwikiwiki',
	'opswiki',
	'datawiki',
	'armakothwiki',
];

$wgConf->suffixes = [ 'wiki' ];
$wgConf->localVHosts = [ 'localhost' ];
$wgConf->fullLoadCallback = 'wmfLoadInitialiseSettings';
$wgConf->suffixes = $wgConf->wikis;
$wgConf->loadFullData();
$wgConf->extractAllGlobals( $multiversion->getDBName() );

$wgLocalDatabases = $wgConf->getLocalDatabases();
