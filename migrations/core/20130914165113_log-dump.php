<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Log dump
 */
class Migration_Core_20130914165113 extends Minion_Migration_Base {

	/**
	 * Run queries needed to apply this migration
	 *
	 * @param Kohana_Database $db Database connection
	 */
	public function up(Kohana_Database $db)
	{
		 $db->query(NULL, 'CREATE TABLE IF NOT EXISTS `logs` (
			  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			  `user_id` int(11) unsigned DEFAULT NULL,
			  `location` varchar(255) DEFAULT NULL,
			  `alias` varchar(90) DEFAULT NULL,
			  `alias_id` int(11) unsigned NULL,
			  `agent` varchar(80) DEFAULT NULL,
			  `ip` varchar(45) DEFAULT NULL,
			  `type` varchar(14) DEFAULT NULL,
			  `time` int(10) unsigned DEFAULT NULL,
			  `message` text,
			  `params` text,
			  PRIMARY KEY (`id`),
			  KEY `logs_user` (`user_id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;');

		$db->query(null, 'ALTER TABLE `logs`
 			ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;');

		$db->query(null, "CREATE TABLE IF NOT EXISTS `notifications` (
			  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			  `alias` varchar(120) NOT NULL,
			  `icon` varchar(80) NOT NULL,
			  `title` varchar(48) NOT NULL,
			  `message` text NOT NULL,
			  `url` varchar(255) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

		$db->query(null, "CREATE TABLE IF NOT EXISTS `user_notifications` (
			  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			  `log_id` int(11) unsigned DEFAULT NULL,
			  `user_id` int(11) unsigned DEFAULT NULL,
			  `notification_id` int(11) unsigned NOT NULL,
			  `param` text,
			  `read` enum('0','1') DEFAULT NULL,
			  `created_at` int(11) NOT NULL,
			  PRIMARY KEY (`id`),
			  KEY `notifications_user` (`user_id`),
			  KEY `notifications_log` (`log_id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8AUTO_INCREMENT=1 ;");

		$db->query(null, "ALTER TABLE `user_notifications`
		  ADD CONSTRAINT `user_notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
		  ADD CONSTRAINT `user_notifications_ibfk_3` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE,
		  ADD CONSTRAINT `user_notifications_ibfk_2` FOREIGN KEY (`log_id`) REFERENCES `logs` (`id`) ON DELETE CASCADE;");
	}

	/**
	 * Run queries needed to remove this migration
	 *
	 * @param Kohana_Database $db Database connection
	 */
	public function down(Kohana_Database $db)
	{
		$db->query(NULL, 'DROP TABLE `logs`;');
		$db->query(NULL, 'DROP TABLE `notifications`;');
		$db->query(NULL, 'DROP TABLE `user_notifications`;');
	}

}
