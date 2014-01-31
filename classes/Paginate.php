<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Paginate extends Kohana_Paginate {

	// Config array
	private $config = NULL;

	/**
	 * @var Kohana_Request
	 */
	private $request;

	/**
	 * @var Kohana_Route
	 */
	private $route;

	// Route parameters.
	private $route_params;

	public $query = FALSE;

	// Current page
	public $current_page = FALSE;

	public static function factory($object, $config = array(), $query = FALSE)
	{
		$instance = parent::factory($object);
		$instance->set_config($config);
		$instance->query = $query;

		$instance->request = Request::initial();
		$instance->route = $instance->request->route();

		// Assign default route params
		$instance->route_params = array(
			'directory' => $instance->request->directory(),
			'controller' => $instance->request->controller(),
			'action' => $instance->request->action(),
		) + $instance->request->param();

		// get the current page
		$page = $instance->request->param($instance->config['param']);

		if (!Valid::digit($page))
		{
			$page = 1;
		}

		$instance->current_page = (int)$page;

		// limit the pagination results
		$instance->limit(($page - 1) * $instance->config['total_items'], $instance->config['total_items']);

		return $instance;
	}

	public function set_config($config = 'default')
	{
		if ($config == 'default')
		{
			$this->config = Kohana::$config->load('pagination')->as_array();
		}
		elseif (is_array($config))
		{
			if (count($config) < 4)
			{
				$this->config = array_merge(Kohana::$config->load('pagination')->as_array(), $config);
			}
			else
			{
				$this->config = $config;
			}
		}
		else
		{
			$this->config = Kohana::$config->load($config)->as_array();
		}
	}

	/**
	 * Get the number of pages for the paginate
	 *
	 * @return int
	 */
	public function pages()
	{
		return ceil($this->_count_total / $this->config['total_items']);
	}

	/**
	 * Generate the url for the specified page.
	 *
	 * @param  int  $page
	 * @return  String
	 */
	public function url($page = 1)
	{
		// Clean the page number
		$page = max(1, (int)$page);

		// No page number in URLs to first page
		if ($page === 1 AND !$this->config['first_page_in_url'])
		{
			$page = NULL;
		}

		$params = array_merge(
			$this->route_params,
			array($this->config['param'] => $page)
		);

		$suffix = '';

		if ($this->query != FALSE)
		{
			if (is_string($this->query))
			{
				$suffix = ($this->query != FALSE) ? '?' . $this->query . '=' . $this->request->query($this->query) : '';
			}
			elseif (is_array($this->query))
			{
				$suffix = '?';
				$first = TRUE;

				foreach ($this->query as $q)
				{
					if ($first)
					{
						$first = FALSE;
						$suffix .= $q . '=' . $this->request->query($q);
					}
					else
					{
						$suffix .= '&' . $q . '=' . $this->request->query($q);
					}
				}
			}
		}

		return URL::site($this->route->uri($params)) . $suffix;
	}

	/**
	 * Add a class to the pagination element.
	 *
	 * @param $class
	 *
	 * @return Paginate
	 */
	public function add_class($class)
	{
		$this->config['class'] .= ' '.$class;
		return $this;
	}

	public function get_class()
	{
		return $this->config['class'];
	}

	/**
	 * Renders the pagination links.
	 *
	 * @param View $view View object
	 * @return string Pagination output (HTML)
	 */
	public function render($view = NULL)
	{
		// Automatically hide pagination whenever it is superfluous
		if ($this->config['auto_hide'] === TRUE AND $this->pages() <= 1)
		{
			return '';
		}

		if ($view === NULL)
		{
			// Use the view class from config
			$refl = new ReflectionClass('View_' . $this->config['view']);
			$view = $refl->newInstanceArgs();
		}

		$view->paginate = $this;

		$renderer = Kostache::factory();
		return $renderer->render($view);
	}

	/**
	 * Magic method to auto render when cast to string.
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->render();
	}
}
