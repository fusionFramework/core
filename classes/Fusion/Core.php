<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Main helper
 *
 * @package    fusionFramework
 * @category   Core
 * @author     Maxim Kerstens
 * @copyright  (c) 2013-2014 Maxim Kerstens
 * @license    BSD
 */
class Fusion_Core {
	/**
	 * @var Model_User
	 */
	public static $user = null;

	/**
	 * @var array
	 */
	public static $config = array();

	/**
	 * @var Fusion_Log
	 */
	public static $log = null;

	/**
	 * @var Permissions
	 */
	public static $permissions = null;

	/**
	 * @var Mail
	 */
	public static $mail = null;

	/**
	 * @var Assets
	 */
	public static $assets = null;

	/**
	 * Initialise this static class
	 */
	public static function init()
	{
		self::$config = Kohana::$config->load('core')->as_array();
		self::$log = new Fusion_Log;

		try
		{
			// Get the current active/logged in user
			self::$user = Sentry::getUser();
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			// User wasn't found, should only happen if the user was deleted
			// when they were already logged in or had a "remember me" cookie set
			// and they were deleted.
			self::$user = null;
		}

		self::$permissions = Permissions::instance();
		self::$mail = new Mail;
		self::$assets = new Assets;
	}

	public static function date($timestamp, $format=null)
	{
		$timezone = (Fusion::$user == null) ? null : new DateTimeZone(Fusion::$user->timezone);

		$date = DateTime::createFromFormat("U", $timestamp, $timezone);

		if($date == false)
		{
			throw new Kohana_Exception('No valid timestamp (:timestamp) supplied', array(':timestamp' => $timestamp));
		}

		if($format == null)
		{
			$format = self::$config['default_date_format'];
		}

		return $date->format($format);
	}
}
