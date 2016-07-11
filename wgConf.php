<?php

$wgConf = new SiteConfiguration;

$wgConf->wikis = [
	'droidwiki',
	'opswiki',
	'testdroidwiki',
	'datawiki',
];

$wgConf->suffixes = [ 'wiki' ];
$wgConf->localVHosts = [ 'localhost' ];
$wgConf->fullLoadCallback = 'wmfLoadInitialiseSettings';
$wgConf->suffixes = $wgConf->wikis;
$wgConf->loadFullData();
$wgConf->extractAllGlobals( $wmgWikiName );

