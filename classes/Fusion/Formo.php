<?php defined('SYSPATH') or die('No direct script access.');

class Fusion_Formo extends Formo_Core_Formo {
	public function render($template = NULL, $fields = FALSE, $exclude = FALSE)
	{
		if($fields != false)
		{
			foreach($this->_fields as $alias => $field)
			{
				if( ($exclude == false && !in_array($field->alias(), $fields)) || ($exclude == true && in_array($field->alias(), $fields)) )
				{
					unset($this->_fields[$alias]);
				}
			}
		}

		return parent::render($template);
	}
}