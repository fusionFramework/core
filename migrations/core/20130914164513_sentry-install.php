<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Sentry install
 */
class Migration_Core_20130914164513 extends Minion_Migration_Base {

	/**
	 * Run queries needed to apply this migration
	 *
	 * @param Kohana_Database $db Database connection
	 */
	public function up(Kohana_Database $db)
	{
		 $db->query(NULL, "CREATE TABLE `groups` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
			  `permissions` text COLLATE utf8_unicode_ci,
			  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
			  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
			  PRIMARY KEY (`id`),
			  UNIQUE KEY `groups_name_unique` (`name`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

		 $db->query(NULL, "CREATE TABLE `users` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
			  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
			  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
			  `timezone` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
			  `permissions` text COLLATE utf8_unicode_ci,
			  `settings` text COLLATE utf8_unicode_ci,
			  `activated` tinyint(4) NOT NULL DEFAULT '0',
			  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `activated_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `last_login` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
			  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
			  PRIMARY KEY (`id`),
			  UNIQUE KEY `users_email_unique` (`email`),
			  KEY `users_activation_code_index` (`activation_code`),
			  KEY `users_reset_password_code_index` (`reset_password_code`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

		 $db->query(NULL, "CREATE TABLE `throttle` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `user_id` int(10) unsigned NOT NULL,
			  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `attempts` int(11) NOT NULL DEFAULT '0',
			  `suspended` tinyint(4) NOT NULL DEFAULT '0',
			  `banned` tinyint(4) NOT NULL DEFAULT '0',
			  `last_attempt_at` timestamp NULL DEFAULT NULL,
			  `suspended_at` timestamp NULL DEFAULT NULL,
			  `banned_at` timestamp NULL DEFAULT NULL,
			  PRIMARY KEY (`id`),
			  KEY `fk_user_id` (`user_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");


		 $db->query(NULL, "CREATE TABLE `users_groups` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `user_id` int(10) unsigned NOT NULL,
			  `group_id` int(10) unsigned NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
	}

	/**
	 * Run queries needed to remove this migration
	 *
	 * @param Kohana_Database $db Database connection
	 */
	public function down(Kohana_Database $db)
	{
		$db->query(NULL, 'DROP TABLE `groups`;');
		$db->query(NULL, 'DROP TABLE `users`;');
		$db->query(NULL, 'DROP TABLE `throttle`;');
		$db->query(NULL, 'DROP TABLE `users_groups`;');
	}

}
