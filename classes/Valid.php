<?php defined('SYSPATH') OR die('No direct script access.');

class Valid extends Kohana_Valid {

	/**
	 * Checks if a provided value is a timestamp
	 *
	 * @param $timestamp
	 * @return bool
	 */
	public static function is_timestamp($timestamp)
	{
		return ((string) (int) $timestamp === $timestamp)
			&& ($timestamp <= PHP_INT_MAX)
			&& ($timestamp >= ~PHP_INT_MAX);
	}
}
