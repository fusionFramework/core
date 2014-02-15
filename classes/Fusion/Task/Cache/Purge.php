<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Completely clean out your application's cache folder
 *
 * @package    fusionFramework
 * @category   Core/Assets
 * @author     Maxim Kerstens
 */
class Fusion_Task_Cache_Purge extends Minion_Task
{

	protected function _execute(array $params)
	{
		Minion_CLI::write('Starting cache purge');

		$cache_folder = APPPATH.'cache';

		foreach(glob($cache_folder . '/*') as $file) {

			if(is_dir($file))
			{
				Minion_CLI::write('removing '.$file);
				$this->rmdir($file);
				rmdir($file);
			}
			else
				unlink($file);
		}

		Minion_CLI::write('Completed cache purge');
	}
	public function rmdir($dir)
	{
		foreach(glob($dir . '/*') as $file) {

			if(is_dir($file))
			{
				Minion_CLI::write('removing '.$file);
				$this->rmdir($file);
				rmdir($file);
			}
			else
				unlink($file);
		}
	}
}