<?php defined('SYSPATH') OR die('No direct script access.');

return array(
	'title' => 'Mail',
	'description' => 'Mail gateways',
	'formo' => [
		'mail' => [
			'alias' => 'mail',
			'fields' => [
			]
		],
		'sender' => [
			'alias' => 'sender',
			'legend' => 'Sender',
			'as_sub_to' => 'mail',
			'fields' => [
				['name', null, null, ['message' => 'This will the author\'s name from which mails will be sent to users.']],
				['address', 'input|email', null, ['label' => 'Email address', 'message' => 'This will the email address from which mails will be sent to users.']]
			]
		],
		'mail.transports' => [
			'alias' => 'transports',
			'as_sub_to' => 'mail',
			'fields' => [
				['default', 'select', null, ['opts' => ['smtp' => 'SMTP', 'mail' => 'Mail', 'sendmail' => 'sendmail']]]
			]
		],
		'mail.transports.smtp' => [
			'alias' => 'smtp',
			'as_sub_to' => 'mail.transports',
			'legend' => 'SMTP',
			'fields' => [
				['host'],
				['port', 'input|number'],
				['security', 'select', null, ['opts' => [0 => 'None', 'ssl' => 'SSL']]],
				['username'],
				['password', 'input']
			]
		],
		'mail.transports.sendmail' => [
			'alias' => 'sendmail',
			'as_sub_to' => 'mail.transports',
			'legend' => 'sendmail',
			'fields' => [
				['command', null, '/usr/sbin/exim -bs'],
			]
		]
	]
);