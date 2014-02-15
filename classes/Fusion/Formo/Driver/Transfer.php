<?php defined('SYSPATH') or die('No direct script access.');

class Fusion_Formo_Driver_Transfer extends Formo_Driver {

	public static function get_attr( array $array)
	{
		$field = $array['field'];

		return array
		(
			'name' => $field->name(),
		);
	}

	public static function get_opts( array $array)
	{
		$field = $array['field'];

		$opts_array = array('selected' => array(), 'available' => array());

		$selected = $field->val();

		foreach ($field->get('opts', array()) as $key => $value)
		{
			if(in_array($key, $selected))
			{
				$opts_array['selected'][] = '<option value="'.$key.'">'.$value.'</option>';
			}
			else
			{
				$opts_array['available'][] = '<option value="'.$key.'">'.$value.'</option>';
			}
		}

		return $opts_array;
	}

	public static function new_val( array $array)
	{
		$new_val = $array['new_val'];

		return ($new_val === NULL OR $new_val === '')
			? NULL
			: $new_val;
	}

	/**
	 * Return a field's template used with $field->render()
	 *
	 * @access public
	 * @static
	 * @param array $array
	 * @return void
	 */
	public static function get_template( array $array)
	{
		$field = $array['field'];

		if ($template = $field->get('template'))
		{
			return $template;
		}

		return 'transfer_template';
	}
}
