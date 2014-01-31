<?php defined('SYSPATH') OR die('No direct script access.');

class ORM extends Kohana_ORM {
	/**
	 * Added ability to optionally track changes when a model is saved.
	 *
	 * @param Validation $validation
	 * @param bool       $track_changes
	 * @return ORM
	 */
	public function save(Validation $validation = NULL, $track_changes = FALSE)
	{
		if($track_changes)
		{
			$datalog = new DataLog($this->_table_name, $this->_original_values);
		}

		$save = parent::save($validation);

		if($track_changes)
		{
			$datalog->save($this->pk(), $this->_object, $this->_belongs_to);
		}

		return $save;
	}
}
