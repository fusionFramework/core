<?php defined('SYSPATH') OR die('No direct script access.');

class Fusion_Model_DataLog extends ORM {
	protected $_table_name = 'datalog';

	protected $_table_columns = array(
		'id' => array('type' => 'int'),
		'date_and_time' => array('type' => 'string'),
		'table_name' => array('type' => 'string'),
		'column_name' => array('type' => 'string'),
		'row_pk' => array('type' => 'int'),
		'username' => array('type' => 'string'),
		'old_value' => array('type' => 'string', 'is_nullable' => TRUE),
		'new_value' => array('type' => 'string', 'is_nullable' => TRUE),
	);

	protected $_created_column = array(
		'column' => 'date_and_time',
		'format' => 'Y-m-d H:i:s'
	);

	/**
	 * Updates or creates the record, setting the username to 'anonymous' (or
	 * a localised equivalent) if the current user is not logged in with Auth.
	 *
	 * @chainable
	 * @param  Validation $validation Validation object
	 * @return Model_DataLog
	 */
	public function save(Validation $validation = NULL, $track_changes = FALSE)
	{
		$this->username = (Fusion::$user != null) ? Fusion::$user->username : __(Kohana::message('datalog', 'anon_username'));

		return $this->loaded() ? $this->update($validation) : $this->create($validation);
	}
}
