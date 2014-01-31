<?php defined('SYSPATH') OR die('No direct script access.');

return array(
	'title' => 'Core',
	'description' => 'Core configuration',
	'formo' => [
		'core' => [
			'alias' => 'core',
			'fields' => [
				['name', null],
				['default_date_format', null, null, ['label' => 'Default date format']]
			]
		],
		'core.currency' => [
			'alias' => 'currency',
			'legend' => 'Currency',
			'as_sub_to' => 'core',
			'fields' => [
				['plural', null],
				['singular', null],
				['initial_budget', 'input|number', null, ['label' => 'Initial budget', 'message' => 'The amount of points a user starts out with at registration.']],
				['image', 'image']
			]
		],
		'core.site' => [
			'alias' => 'site',
			'legend' => 'Site',
			'as_sub_to' => 'core',
			'fields' => [
				['layout', null],
				['status', 'select', null, ['opts' => ['open' => 'Open', 'message' => 'Message', 'route' => 'Route']]],
				['message', 'textarea', null, ['message' => 'Shown if the site isn\'t open']],
				['route', null, null, ['message' => 'Catch-all route that\'s shown if the site isn\'t open']]
			]
		],
		'core.admin' => [
			'alias' => 'admin',
			'legend' => 'Admin',
			'as_sub_to' => 'core',
			'fields' => [
				['layout', null]
			]
		]
	],
	'images' => [
		'currency' => [
			'input' => 'core[currency][image]',
			'path' => 'core.currency.image',
			'save_to' => WEBPATH.'currency.png'
		]
	]
);