<?php defined('SYSPATH') or die('No direct script access.');
return array
(
	'title' => 'Cache',
	'description' => 'Cache mechanisms',
	'formo' => [
		'cache' => [
			'alias' => 'cache',
			'fields' => []
		],
		'file' => [
			'alias' => 'file',
			'as_sub_to' => 'cache',
			'legend' => 'File driver',
			'fields' => [
				['driver', 'input|hidden', 'file'],
				['cache_dir', null],
				['default_expire', 'input|number', '3600']
			]
		],
		'apc' => [
			'alias' => 'apc',
			'as_sub_to' => 'cache',
			'legend' => 'APC driver',
			'fields' => [
				['driver', 'input|hidden', 'apc'],
				['default_expire', 'input|number', '3600']
			]
		],
		'xcache' => [
			'alias' => 'xcache',
			'as_sub_to' => 'cache',
			'legend' => 'Xcache driver',
			'fields' => [
				['driver', 'input|hidden', 'xcache'],
				['default_expire', 'input|number', '3600']
			]
		],
		'cache.memcache' => [
			'alias' => 'memcache',
			'as_sub_to' => 'cache',
			'legend' => 'Memcache driver',
			'fields' => [
				['driver', 'input|hidden', 'memcache'],
				['default_expire', 'input|number', '3600'],
				['instant_death', 'radios', null, ['opts' => [0 => 'off', 1=>'on']]]
			]
		],
		'cache.memcache.servers' => [
			'alias' => 'servers',
			'as_sub_to' => 'cache.memcache',
		],
		'memcache_server_local' => [
			'alias' => 'local',
			'as_sub_to' => 'cache.memcache.servers',
			'fields' => [
				['host'],
				['port', 'input|number'],
				['persistent', 'radios', null, ['opts' => [0 => 'off', 1=>'on']]],
				['weight', 'input|number', '1'],
				['timeout', 'input|number', '1'],
				['retry_interval', 'input|number', '1'],
				['status', 'radios', null, ['opts' => [0 => 'off', 1=>'on']]],
			]
		]
	]
);
