<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Abstract base controller for frontend controllers.
 *
 * @todo take over 404 error handling
 *
 * @package    fusionFramework
 * @category   Core
 * @author     Maxim Kerstens
 * @copyright  (c) 2013-2014 Maxim Kerstens
 * @license    BSD
 */
abstract class Fusion_Controller_Fusion extends Controller_Req {

	/**
	 * @var Mustache View class to render
	 */
	protected $_tpl = null; // View to render.

	/**
	 * @var bool Is the controller accessible to guests?
	 */
	protected $_login_required = true;

	/**
	 * @var string The name of the base template in which we'll parse the content
	 */
	protected $_template_cfg = '';

	/**
	 * Run CSRF check and load frontend assets.
	 */
	public function before()
	{
		//if the site status isn't open
		if (Fusion::$config['site']['status'] != 'open')
		{
			if ( Fusion::$user == null || !Fusion::$user->hasAccess('offline'))
			{
				//site is closed
				$route = Fusion::$config['site']['route'];

				if (!empty($route))
				{
					$response = Request::factory($route)->execute();
				}
				else
				{
					$response = Request::factory('site.closed')->execute();
				}

				$this->response->body($response);

				$this->_break_request_flow = true;
			}

			//always show that the site is offline
			RD::set('warning', 'Currently the site is accessible for staff only!');
		}

		/**
		 * Is the controller protected from visitors
		 */
		if($this->_login_required)
		{
			$this->_login_required();
		}

		$this->_validate_csrf();
	}

	/**
	 * Set the response body to $this->view if $this->view is defined..
	 * @todo refactor so it's modular
	 */
	public function after()
	{
		if ($this->_tpl != NULL)
		{
			$this->_tpl->flash_messages = $this->_view_alerts();
			$this->_tpl->assets = Fusion::$assets->tags();

			$renderer = Kostache_Layout::factory();
			$renderer->set_layout(Fusion::$config[$this->_template_cfg]['layout']);

			if (Fusion::$user != null)
			{
				$this->_tpl->access_admin = Fusion::$user->hasAccess('admin');

				/*$notifications = $this->user->notifications->where('read', '=', 0);
				$loaded_notifications = $notifications->limit(8)->order_by('id', 'desc')->find_all();
				$this->view->noticiations = array(
					'active' => (count($loaded_notifications) > 0),
					'count' => $notifications->count_all(),
					'list' => $loaded_notifications,
					'link' => Route::url('user.notifications', null, true)
				);*/
			}

			$this->response->body($renderer->render($this->_tpl));
		}

		parent::after();
	}

	/**
	 * Check to ensure POST requests contains CSRF.
	 *
	 * @todo refactor
	 *
	 * @throws HTTP_Exception
	 */
	protected function _validate_csrf()
	{
		if ($this->request->method() == HTTP_Request::POST)
		{
			$validation = Validation::factory($this->request->post())
				->rule('csrf', 'not_empty')
				->rule('csrf', 'Security::check');

			if (!$validation->check())
			{
				throw HTTP_Exception::Factory(403, 'CSRF check failed!');
			}
		}
	}

	/**
	 * Ensure the user is logged in, else throw a 403 Exception.
	 *
	 * @throws HTTP_Exception
	 */
	protected function _login_required()
	{
		if (Fusion::$user == null)
		{
			throw HTTP_Exception::Factory(403, 'Only logged in users can view this page.');
		}
	}

	protected $_break_request_flow = false;

	public function execute()
	{
		// Execute the "before action" method
		$this->before();

		if ($this->_break_request_flow == false)
		{
			// Determine the action to use
			$action = 'action_' . $this->request->action();

			// If the action doesn't exist, it's a 404
			if (!method_exists($this, $action))
			{
				throw HTTP_Exception::factory(404,
					'The requested URL :uri was not found on this server.',
					array(':uri' => $this->request->uri())
				)->request($this->request);
			}

			// Execute the action itself
			$this->{$action}();

			// Execute the "after action" method
			$this->after();
		}

		// Return the response
		return $this->response;
	}

	/**
	 * @param string $uri           Where to redirect to
	 * @param null   $code          Status code to redirect with
	 * @param bool   $during_ajax   Should we redirect during an ajax request?
	 */
	public static function redirect($uri='', $code=null, $during_ajax=false)
	{
		// if this is called during ajax request, check if we should actually redirect
		if(Request::initial()->is_ajax() && $during_ajax == false)
			return;

		if($code == null)
		{
			$code = 302;
		}

		return parent::redirect($uri, $code);
	}

	/**
	 * Check if the logged in user has a permission.
	 * Throw a 403 exception if not.
	 *
	 * @param      $perm    string  Permissions to check the user against
	 * @param null $message string  [Optional] The message to return when the user does not have permission
	 * @throws HTTP_Exception
	 */
	public function access($perm, $message=null)
	{
		if(Fusion::$user != null && !Fusion::$user->hasAccess($perm))
		{
			if($message == null)
			{
				$message = 'You are not permitted to view this page';
			}

			throw HTTP_Exception::Factory(403, $message);
		}
	}

} // End Fusion controller
