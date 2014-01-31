<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(
	'title' => 'Plugins',
	'description' => 'Plugin options',
	'formo' => [
		'plugins' => [
			'alias' => 'plugins'
		],
		'plugins.manager' => [
			'alias' => 'manager',
			'as_sub_to' => 'plugins',
			'fields' => [
				['loader', 'select', null, ['opts' => ['Config' => 'Config', 'DB' => 'Database']]]
			]
		],
		'config' => [
			'alias' => 'Config',
			'as_sub_to' => 'plugins.manager',
			'fields' => [
				['dir', null, null, ['message' => 'name of the directory we\'ll use if your config dir']]
			]
		],
		'db' => [
			'alias' => 'DB',
			'as_sub_to' => 'plugins.manager',
			'fields' => [
				['connection', null, 'default', ['message' => 'name of the database connection']],
				['table', null, null, ['message' => 'name of the table where the plugins\' state will be stored']]
			]
		]
	]
);
