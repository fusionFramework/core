<?php defined('SYSPATH') OR die('No direct script access.');

class Kohana extends Kohana_Core {
	/**
	 * Changes the currently enabled modules. Module paths may be relative
	 * or absolute, but must point to a directory:
	 *
	 *     Kohana::modules(array('modules/foo', MODPATH.'bar'));
	 *
	 * @param   array   $modules    list of module paths
	 * @return  array   enabled modules
	 */
	public static function modules(array $modules = NULL)
	{
		if ($modules === NULL)
		{
			// Not changing modules, just return the current set
			return Kohana::$_modules;
		}

		// Start a new list of include paths, APPPATH first
		$paths = array(APPPATH);

		foreach ($modules as $name => $path)
		{
			if (is_dir($path))
			{
				// Add the module to include paths
				$paths[] = $modules[$name] = realpath($path).DIRECTORY_SEPARATOR;
			}
			else
			{
				// This module is invalid, remove it
				throw new Kohana_Exception('Attempted to load an invalid or missing module \':module\' at \':path\'', array(
					':module' => $name,
					':path'   => Debug::path($path),
				));
			}
		}

		// Finish the include paths by adding SYSPATH
		$paths[] = SYSPATH;

		// Set the new include paths
		Kohana::$_paths = $paths;

		// Set the current module list
		Kohana::$_modules = $modules;

		foreach (Kohana::$_modules as $path)
		{
			$init = $path.'init'.EXT;

			if (is_file($init))
			{
				// Include the module initialization file once
				require_once $init;
			}

			$routes = $path.'module'.DIRECTORY_SEPARATOR.'routes'.EXT;
			if (is_file($routes))
			{
				// Include the module routes file once
				require_once $routes;
			}
		}

		return Kohana::$_modules;
	}
}
