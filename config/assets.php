<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Asset sets (libraries and plugins)
 */
return array(
	// The set that is loaded on every page of the site
	'site' => array(
		'set'  => array('jquery', 'bootstrap'),
		'css'   => 'http://bootswatch.com/lumen/bootstrap.css'
	),
	'jquery' => array(
		'js'    => 'jquery-2.0.3.min.js'
	),
	'bootstrap' => array(
		'js'    => 'bootstrap.min.js',
		'css'   => array(
			'bootstrap.min.css',
			'http://netdna.bootstrapcdn.com/font-awesome/4.0.2/css/font-awesome.min.css',
		)
	),
	// Supersedes bootstrap's modals, offers stackables & a modal manager
	'modals' => array(
		'js'    => array('plugins/bootstrap-modal.js', 'plugins/bootstrap-modalmanager.js'),
		'css'   => array('plugins/bootstrap-modal-bs3patch.css', 'plugins/bootstrap-modal.css')
	),
	'notifications' => array(
		'js'    => 'plugins/bootstrap-notify.js',
		'css'   => 'plugins/bootstrap-notify.css',
		'less'  => 'plugins/bootstrap-notify.less'
	),
	'editor' => array(
		'js'    => 'plugins/summernote.min.js',
		'css'   => ['plugins/summernote.css','plugins/summernote-bs3.css']
	),
	'datatables' => array(
		'js'    => array('plugins/jquery.dataTables.js', 'plugins/jquery.dataTables.extend.js', 'plugins/bootbox.min.js'),
		'css'   => 'plugins/jquery.dataTables.css',
		'set'   => array('req', 'modals')
	),
	'datepicker' => array(
		'js'    => 'plugins/bootstrap-datepicker.js',
		'css'   => 'plugins/bootstrap-datepicker.min.css'
	),
	'timepicker' => array(
		'js'    => 'plugins/bootstrap-timepicker.js',
		'css'   => 'plugins/bootstrap-timepicker.min.css'
	),
	'maxlength' => array(
		'js'    => 'plugins/bootstrap-maxlength.js'
	),
	'sortable' => array(
		'js'    => 'plugins/jquery-sortable.js'
	),
	'typeahead' => array(
		'js'    => ['hogan.js', 'plugins/typeahead.min.js'],
		'css'   => 'plugins/typeahead.css'
	),
	'file-upload' => array(
		'js'    => 'plugins/bootstrap-fileupload.min.js',
		'css'   => 'plugins/bootstrap-fileupload.min.css'
	),
	'uploadify' => array(
		'js'    => 'plugins/jquery.uploadify.min.js',
		'css'   => 'plugins/uploadify.css'
	),
	// Form validation
	'parsley' => array(
		'js'    => 'plugins/parsley.js'
	),
	'parsley-extended' => array(
		'js'    => 'plugins/parsley.extend.js'
	),
	// Take over ajax requests (handles standardised request data)
	'req' => array(
		'set' => 'notifications',
		'js' => array('plugins/req.js', 'plugins/req-defaults.js')
	),
	// Make divs scrollable
	'slimScroll' => array(
		'js'    => 'plugins/jquery.slimscroll.min.js'
	),
	// Lazy load content
	'jScroll' => array(
		'js'    => 'plugins/jquery.jscroll.min.js'
	),
	'toolbar' => array(
		'js' => 'plugins/jquery.toolbar.min.js',
		'css' => 'plugins/jquery.toolbars.css'
		)
);