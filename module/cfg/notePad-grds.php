<?php defined('SYSPATH') OR die('No direct script access.');

return array(
	'title' => 'dataTable',
	'description' => 'Admin table generation',
	'formo' => [
		'datatable' => [
			'alias' => 'notePad-grds',
			'fields' => [
				['cache_lifetime', 'input|number', null, ['label' => 'Cache lifetime', 'message' => 'in seconds']],
				['cache_group', null, null, ['label' => 'Cache group', 'message' => 'which cache group to use']]
			]
		]
	]
);