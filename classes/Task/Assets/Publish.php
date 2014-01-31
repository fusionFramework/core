<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Move asset files out of the modules into your HTDOCPATH/assets
 * so they won't have to be routed through Kohana no more.
 *
 * Optionally there's a parameter called overwrite (defaults to true),
 * if set to false it won't overwrite existing asset files.
 *
 * @package    fusionFramework
 * @category   Core/Assets
 * @author     Maxim Kerstens
 */
class Task_Assets_Publish extends Minion_Task
{
	protected $_options = [
		'overwrite' => true
	];

	protected function _execute(array $params)
	{
		$root = new DirectoryIterator(FUSIONPATH);

		foreach($root as $dir)
		{
			if($dir->isDot()) continue;

			if($dir->isDir())
			{
				$path = $dir->getRealPath().DIRECTORY_SEPARATOR.'media';
				if(file_exists($path))
				{
					$assets = new DirectoryIterator($path);

					foreach($assets as $asset_dir)
					{
						if($asset_dir->isDot()) continue;

						if($asset_dir->isDir())
						{
							$this->_copy($asset_dir->getRealPath(), HTDOCPATH.'assets'.DIRECTORY_SEPARATOR.$asset_dir->getFileName(), $params['overwrite']);
						}
					}
				}
			}
		}
	}

	protected function _copy($src, $dest, $overwrite=true)
	{
		// If source is not a directory stop processing
		if(!is_dir($src)) return false;

		// If the destination directory does not exist create it
		if(!is_dir($dest))
		{
			if(!mkdir($dest))
			{
				// If the destination directory could not be created stop processing
				return false;
			}
		}

		// Open the source directory to read in files
		$i = new DirectoryIterator($src);

		foreach($i as $f)
		{
			if($f->isFile())
			{
				if(file_exists($dest."/" . $f->getFilename()) && $overwrite == true)
				{
					copy($f->getRealPath(), $dest."/" . $f->getFilename());
					Minion_CLI::write($dest."/" . $f->getFilename() . " copied.");
				}
				else
				{
					Minion_CLI::write($f->getRealPath() . " not copied, overwrite necessary.");
				}
			}
			else if(!$f->isDot() && $f->isDir())
			{
				$this->_copy($f->getRealPath(), $dest."/".$f);
			}
		}
	}
}