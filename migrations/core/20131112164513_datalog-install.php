<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * DataLog install
 */
class Migration_Core_20131112164513 extends Minion_Migration_Base {

	/**
	 * Run queries needed to apply this migration
	 *
	 * @param Kohana_Database $db Database connection
	 */
	public function up(Kohana_Database $db)
	{
		// Get the table name from the ORM model
		$table_name = ORM::factory('DataLog')->table_name();
		$sql = "CREATE TABLE IF NOT EXISTS ".$db->quote_table($table_name)." (
               ".$db->quote_column('id')." INT(6) NOT NULL AUTO_INCREMENT,
               ".$db->quote_column('date_and_time')." DATETIME NOT NULL,
               ".$db->quote_column('table_name')." VARCHAR(65) NOT NULL,
               ".$db->quote_column('column_name')." VARCHAR(65) NOT NULL,
               ".$db->quote_column('row_pk')." INT(12) NOT NULL,
               ".$db->quote_column('username')." VARCHAR(150) NOT NULL,
               ".$db->quote_column('old_value')." TEXT,
               ".$db->quote_column('new_value')." TEXT,
               PRIMARY KEY (".$db->quote_column('id').")
             )";
		 $db->query(NULL, $sql);
	}

	/**
	 * Run queries needed to remove this migration
	 *
	 * @param Kohana_Database $db Database connection
	 */
	public function down(Kohana_Database $db)
	{
		$table_name = ORM::factory('DataLog')->table_name();
		$db->query(NULL, 'DROP TABLE `'.$table_name.'`;');
	}

}
