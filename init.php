<?php defined('SYSPATH') OR die('No direct script access.');

Route::set('assets', 'assets/<file>', array('file' => '.*'))
	->defaults(array(
		'controller' => 'Assets',
		'action'     => 'media'
	)
);
