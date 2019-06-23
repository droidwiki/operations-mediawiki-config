<?php

$wgLBFactoryConf = [

	'class' => 'LBFactoryMulti',

	'sectionsByDB' => [
		'droidwikiwiki' => 's1',
		'datawiki' => 's1',
		'endroidwikiwiki' => 's1',
		'opswiki' => 's1',
		'dstatic' => 's1',
	],

	'sectionLoads' => [
		's1' => [
			'db1001' => 50, # master
			'db1002' => 50, # slave
		],
	],

	'serverTemplate' => [
		'dbname' => $wgDBname,
		'user' => $wmgDatabaseUser,
		'password' => $wmgDatabasePassword,
		'type' => 'mysql',
		'flags' => DBO_DEFAULT,
		'max lag' => 6, // should be safely less than $wgCdnReboundPurgeDelay
		'variables' => [
			'innodb_lock_wait_timeout' => 15,
		],
	],

	'hostsByName' => [
		'db1001' => '172.16.0.1', # do not remove or comment out
		'db1002' => '172.16.0.2', # do not remove or comment out
	],
];
