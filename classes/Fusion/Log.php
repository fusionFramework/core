<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Log helper
 *
 * @package    fusionFramework
 * @category   Core/Logs
 * @author     Maxim Kerstens
 * @copyright  (c) 2013-2014 Maxim Kerstens
 * @license    BSD
 */
class Fusion_Log {

	/**
	 * Create a new log
	 *
	 * @param string     $alias   An identifier to help index logs
	 * @param string     $type    Module name that's logging (e.g. item, pet,..)
	 * @param string     $message A general message describing the action
	 * @param array      $params  Parameters that give insight into the action that has been performed
	 * @param Model_User $user    The user that did an action(defaults to the logged in user if null)
	 *
	 * @return Model_Log
	 */
	public function create($alias, $type, $message, $params = array(), $user = NULL)
	{
		//if no user was supplied take the logged in user
		if ($user == null)
		{
			$user = Fusion::$user;
		}

		//add the username to the params
		$params['username'] = $user->username;

		if(isset($params['alias_id']))
		{
			$alias_id = $params['alias_id'];
			unset($params['alias_id']);
		}
		else
		{
			$alias_id = null;
		}

		$values = array(
			'alias' => $alias,
			'alias_id' => $alias_id,
			'message' => $message,
			'user_id' => $user->id,
			'username' => $user->username,
			'agent' => implode('-', Request::user_agent(array('browser', 'platform'))),
			'ip' => Request::$client_ip,
			'location' => Request::current()->uri(),
			'type' => $type,
			'params' => $params,
		);

		return ORM::factory('Log')
			->values($values)
			->create();
	}

	public function read($path, $all = false)
	{
		if (Fusion::$user != null)
		{
			if ($all == true)
			{
				$path .= '%';
				$op = 'LIKE';
			}
			else
			{
				$op = '=';
			}

			DB::update('user_notifications')
				->set(array('read' => 1))
				->where('user_id', '=', Fusion::$user->id)
				->where('type', $op, $path)
				->execute();
		}
	}
}
