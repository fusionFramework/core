<?php defined('SYSPATH') OR die('No direct script access.');

class Fusion_Valid extends Kohana_Valid {

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

	/**
	 * Check if the value is greater than the provided cap.
	 *
	 * @param $value Field value
	 * @param $cap   Min value
	 * @return bool
	 */
	public static function greater($value, $cap)
	{
		return $value > $cap;
	}

	/**
	 * Check if the value is at least as much as the minimum value.
	 *
	 * @param $value Field value
	 * @param $cap   Min value
	 * @return bool
	 */
	public static function at_least($value, $min)
	{
		return $value >= $min;
	}

	/**
	 * Check if the value is smaller than the provided cap.
	 *
	 * @param $value Field value
	 * @param $cap   Max value
	 * @return bool
	 */
	public static function smaller($value, $cap)
	{
		return $value < $cap;
	}

	/**
	 * CHeck if the value is smaller than or equal to the provided cap.
	 *
	 * @param $value Field value
	 * @param $cap   Max value
	 * @return bool
	 */
	public static function smaller_equal($value, $cap)
	{
		return $value <= $cap;
	}
}
