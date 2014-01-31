<?php defined('SYSPATH' OR die('No direct access allowed.'));
/**
 * Sentry config file
 */
return array(
	'title' => 'Sentry',
	'description' => 'Auth options',
	'formo' => [
		'sentry' => [
			'alias' => 'sentry',
			'fields' => [
				['throttle', 'radios', null, ['opts' => ['disabled', 'enabled']]],
				['throttle_attempts', 'input|number', null, ['message' => 'How many times can a user consecutively fail at logging in?', 'label' => 'Throttle attempts']],
				['throttle_suspension_time', 'input|number', null, ['message' => 'How long is the user suspended (in minutes)', 'label' => 'Throttle suspension time']],
				['session_driver'],
				['session_key'],
				['cookie_key'],
				['hasher', 'select', null, ['opts' => ['Bcrypt' => 'Bcrypt', 'Native' => 'Native', 'Whirlpool' => 'Whirlpool', 'Sha256' => 'Sha256']]]
			]
		]
	]
);