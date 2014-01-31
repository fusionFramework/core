<?php defined('SYSPATH' OR die('No direct access allowed.'));
/**
 * Quill config file
 */
return array(
	'title' => 'Quill',
	'description' => 'Portable discussion helper',
	'formo' => [
		'quill' => [
			'alias' => 'quill',
			'fields' => [
				['time_format', null, null, ['label' => 'Time format']],
				['auto_create_location', 'radios', null, ['opts' => ['disabled', 'enabled'], 'message' => 'Should a location be created if it\'s requested but doesn\'t exist?', 'label' => 'Auto-create locations?']],
				['count_replies', 'radios', null, ['opts' => ['disabled', 'enabled'], 'label' => 'Count replies?']],
				['count_topics', 'radios', null, ['opts' => ['disabled', 'enabled'], 'label' => 'Count topics?']],
				['count_views', 'radios', null, ['opts' => ['disabled', 'enabled'], 'label' => 'Count topic views?']],
				['stickies', 'radios', null, ['opts' => ['disabled', 'enabled'], 'label' => 'Allow stickies?']],
				['record_last_topic', 'radios', null, ['opts' => ['disabled', 'enabled'], 'label' => 'Store last topic made to a category?']],
				['record_last_post', 'radios', null, ['opts' => ['disabled', 'enabled'], 'label' => 'Store last post to a topic?']]
			]
		]
	]
);