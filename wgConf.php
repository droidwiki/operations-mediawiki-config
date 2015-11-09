<?php

$wgConf = new SiteConfiguration;

$wgLocalDatabases = array(
	'droidwiki',
	'opswiki',
	'testdroidwiki',
);

$wgConf->wikis = $wgLocalDatabases;
$wgConf->suffixes = array( 'wiki' );
$wgConf->localVHosts = array( 'localhost' );

$wgConf->fullLoadCallback = 'wmfLoadInitialiseSettings';
$wgConf->suffixes = $wgLocalDatabases;
$wgConf->loadFullData();
$wgConf->extractAllGlobals( $wmgWikiName );

