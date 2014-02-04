<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Base view for pages
 *
 * @package    fusionFramework
 * @category   Core
 * @author     Maxim Kerstens
 * @copyright  (c) 2013-2014 Maxim Kerstens
 * @license    BSD
 */
abstract class Views {

	/**
	 * @var  string  Page title
	 */
	public $title = 'Welcome';

	/**
	 * @var string Flash messages (set by the controller)
	 */
	public $flash_messages = '';

	/**
	 * @var array A list of asset groups
	 */
	public $assets = null;

	/**
	 * @var bool Can the user access the admin?
	 */
	public $access_admin = false;

	/**
	 * @return string The site's name
	 */
	public function site_name()
	{
		return Fusion::$config['name'];
	}

	/**
	 * @return string The site's copyright
	 */
	public function copyright()
	{
		$name = 'fusionFramework';

		if($name != $this->site_name())
		{
			$name .= ' & ' . $this->site_name();
		}

		$date = '2013';

		if(date('Y') != '2013')
		{
			$date .= ' - ' . date('Y');
		}
		return '&copy; '.$name.' '.$date;
	}

	/**
	 * Is the player logged in?
	 * @return boolean
	 */
	public function logged_in()
	{
		return Fusion::$user != null;
	}

	public function currency()
	{
		return Fusion::$config['currency']['plural'];
	}

	/**
	 * Get the logged in user's information.
	 * @return  array
	 */
	public function player()
	{
		$user = Fusion::$user->as_array();
		$user['points'] = Fusion::$user->setting('points') . ' ';
		$user['points'] .= ($user['points'] != 1) ?  Kohana::$config->load('core.currency.plural') : Kohana::$config->load('core.currency.singular');
		return $user;
	}

	/**
	 * Get the current CSRF (Cross-site request forgery) token
	 *
	 * @return string
	 */
	public function csrf()
	{
		return Security::token();
	}

	/**
	 * Returns a proper site-related URL when you didn't parse
	 * the url with Route::url before sending it to the view
	 *
	 * Use: {{#url}}welcome/index{{/url}}
	 *    --> localhost/fusionFramework/welcome/index
	 * @return callable
	 */
	public function url()
	{
		return function($link)
		{
			return URL::site($link, true, false);
		};
	}

	/**
	 * Returns a proper site-related URL based on a provided route name
	 *
	 * Use: {{#uri}}index{{/uri}}
	 *    --> localhost/fusionFramework/welcome/index
	 * @return callable
	 */
	public function uri()
	{
		return function($uri)
		{
			return Route::url($uri, null, true);
		};
	}

	public function js_files()
	{
		$output = '';

		foreach($this->assets['js'] as $file)
		{
			if(!Text::starts_with($file, 'http'))
				$file = 'assets/js/' .$file;

			$output .= "\t" . HTML::script($file, null, true) . "\n";
		}

		return $output;
	}

	public function css_files()
	{
		$output = '';

		foreach($this->assets['css'] as $file)
		{
			if(!Text::starts_with($file, 'http'))
				$file = 'assets/css/' .$file;

			$output .= "\t" . HTML::style($file, null, true) . "\n";
		}

		return $output;
	}
}