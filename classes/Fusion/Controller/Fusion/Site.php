<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Base controller for site pages
 *
 * @package    fusionFramework
 * @category   Core
 * @author     Maxim Kerstens
 * @copyright  (c) 2013-2014 Maxim Kerstens
 * @license    BSD
 */
abstract class Fusion_Controller_Fusion_Site extends Controller_Fusion {
	protected $_template_cfg = 'site';
	public function before()
	{
		parent::before();
		Fusion::$assets->add_set('site');
	}

} // End Fusion's Site controller
