<?php

$wgLBFactoryConf = [

'class' => 'LBFactoryMulti',

'sectionsByDB' => [
        'droidwikiwiki' => 's1',
        'datawiki' => 's1',
	'endroidwikiwiki' => 's1',
        'opswiki' => 's2',
],

'sectionLoads' => [
        's1' => [
                'db1001' => 70, # master
                'db1002' => 30, # slave
        ],
        's2' => [
                'db1001' => 0,   #master
                'db1002' => 100, #slave
        ],
],

'serverTemplate' => [
        'dbname'          => $wgDBname,
        'user'            => $wmgDatabaseUser,
        'password'        => $wmgDatabasePassword,
        'type'            => 'mysql',
        'flags'           => DBO_DEFAULT,
        'max lag'         => 6, // should be safely less than $wgCdnReboundPurgeDelay
        'variables'   => [
                'innodb_lock_wait_timeout' => 15
        ]
],

'hostsByName' => [
        'db1001' => '37.120.178.25', # do not remove or comment out
        'db1002' => '188.68.49.74', # do not remove or comment out
],

];

