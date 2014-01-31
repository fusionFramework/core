<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'title' => 'Database',
	'description' => 'DB connections',
	'formo' => [
		'database' => [
			'alias' => 'database'
		],
		'database.default' => [
			'alias' => 'default',
			'legend' => 'Default connection',
			'as_sub_to' => 'database',
			'fields' => [
				['type', 'select', null, ['opts' => ['MySQL' => 'MySQL', 'MySQLi' => 'MySQLi']]],
				['table_prefix'],
				['caching', 'radios', null, ['opts' => ['off', 'on']]]
			]
		],
		'database.default.connection' => [
			'alias' => 'connection',
			'as_sub_to' => 'database.default',
			'fields' => [
				['hostname'],
				['database'],
				['username'],
				['password'],
				['persistent', 'radios', null, ['opts' => ['off', 'on']]]
			]
		]
	]
);
