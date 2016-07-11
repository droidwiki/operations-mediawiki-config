<?php

$wgConf = new SiteConfiguration;

$wgLocalDatabases = [
	'droidwiki',
	'opswiki',
	'testdroidwiki',
	'datawiki',
];

$wgConf->wikis = $wgLocalDatabases;
$wgConf->suffixes = [ 'wiki' ];
$wgConf->localVHosts = [ 'localhost' ];

$wgConf->fullLoadCallback = 'wmfLoadInitialiseSettings';
$wgConf->suffixes = $wgLocalDatabases;
$wgConf->loadFullData();
$wgConf->extractAllGlobals( $wmgWikiName );

