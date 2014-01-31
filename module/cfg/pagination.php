<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(
	'title' => 'Pagination',
	'description' => 'General pagination options',
	'formo' => [
		'pagination' => [
				'alias' => 'pagination',
				'fields' => [
					['total_items', 'input|number', null, ['label' => 'Max records', 'message' => 'Max records per page']],
					['param', null, null, ['message' => 'Which request param to check to know the current page']],
					['view', null, null, ['message' => 'Which view to load in order to render the pagination']],
					['class', null, null, ['message' => 'Class to give the pagination\'s UL']],
					['auto_hide', 'radios', null, ['opts' => ['No', 'Yes'], 'label' => 'Auto hide?', 'message' => 'Should the pagination be shown if there\'s only 1 page?']]
				]
			]
	]
);
