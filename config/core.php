<?php defined('SYSPATH') OR die('No direct script access.');

return array(
	'name' => 'fusionFramework',
	'currency' => array(
		'plural' => 'points',
		'singular' => 'point',
		'image' => false, //the URL to the image that depicts currency
		'initial_budget' => 2000 // this is the amount of points a user starts with
	),
	'default_date_format' => 'h:ia m/d/Y',
	'site' => array(
		'layout' => 'base',
		'status' => 'open',
		'message' => '',
		'route' => '',
	),
);