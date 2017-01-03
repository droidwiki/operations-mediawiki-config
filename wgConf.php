<?php

$wgConf = new SiteConfiguration;

$wgConf->wikis = [
	'droidwikiwiki',
	'opswiki',
	'datawiki',
];

$wgConf->suffixes = [ 'wiki' ];
$wgConf->localVHosts = [ 'localhost' ];
$wgConf->fullLoadCallback = 'wmfLoadInitialiseSettings';
$wgConf->suffixes = $wgConf->wikis;
$wgConf->loadFullData();
$wgConf->extractAllGlobals( $multiversion->getWikiName() );

