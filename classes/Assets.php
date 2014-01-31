<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Asset helper
 *
 * @package    fusionFramework
 * @category   Core
 * @author     Maxim Kerstens
 * @copyright  (c) 2013-2014 Maxim Kerstens
 * @license    BSD
 */
class Assets {
	protected $_assets = array(
		'js' => array(),
		'css' => array()
	);

	protected $_compile_required = false;
	protected $_compiled = false;

	/**
	 * An array containing files that are required to be compiled.
	 *
	 * @var array
	 */
	protected $_compilees = array();

	public function add($type, $definition)
	{
		if(is_array($definition))
		{
			foreach($definition as $def)
			{
				$this->_add($type, $def);
			}
		}
		else
		{
			$this->_add($type, $definition);
		}

		return $this;
	}

	protected function _add($type, $definition)
	{
		switch($type)
		{
			case 'set':
				$set = Kohana::$config->load('assets')->get($definition, false);

				if($set == false)
				{
					throw new Kohana_Exception('":set" has not been defined.', array(':set' => $definition));
				}

				foreach($set as $type => $files)
				{
					$this->add($type, $files);
				}
				break;
			case 'js':
			case 'css':
				$this->_assets[$type][] = $definition;
			break;
			case 'less':
				$this->_compile_required = true;
				$this->_compilees[] = $definition;

				$this->_assets['css'][] = str_replace('.less', '.css', $definition);
			break;
			default:
				throw new Kohana_Exception('Can\'t add an asset with ":type" as type', array(':type' => $type));
			break;
		}
	}

	public function add_set($set)
	{
		return $this->add('set', $set);
	}

	public function add_js($files)
	{
		return $this->add('js', $files);
	}

	public function add_css($files)
	{
		return $this->add('css', $files);
	}

	public function tags()
	{
		return $this->_assets;
	}
}
