<?php defined('SYSPATH') or die('No direct script access.');

abstract class Fusion_Formo_Innards extends Formo_Core_Innards {
	/**
	 * Set a field's id attribute if the auto_id config setting is TRUE
	 *
	 * The id gets prefixed with input- (non-standard formo behaviour)
	 *
	 * @access protected
	 * @param array & $array
	 * @return void
	 */
	protected function _set_id( array & $array)
	{
		if ($this->config('auto_id') === TRUE AND Arr::path($array, 'attr.id') === NULL)
		{
			if (empty($array['attr']))
			{
				$array['attr'] = array();
			}

			Arr::set_path($array, 'attr.id', 'input-'.$array['alias']);
		}
	}
}