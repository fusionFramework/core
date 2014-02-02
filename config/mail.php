<?php defined('SYSPATH') OR die('No direct script access.');

return array(
	'transports' => array(
		'default' => 'smtp',
		'smtp' => array(
			'host' => 'smtp.gmail.com',
			'port' => 465,
			'security' => 'ssl', //set to null if no ssl is required
			'username' => '',
			'password' => ''
		),
		'sendmail' => array(
			'command' => '/usr/sbin/exim -bs'
		),
		'mail' => null
	),
	'sender' => array('address' => 'thorpion.zenk0@gmail.com', 'name' => 'Maxim Kerstens')
);