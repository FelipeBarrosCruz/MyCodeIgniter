<?php
namespace models;

class User extends \ActiveRecord\Model
{
	public static $table_name = 'users';
	public static $has_one = [ ['user_information'] ];

	public function register($data = []) {
		if(empty($data)) return FALSE;

		return $this->create($data);
	}

	public function login($login, $password) {
		$user = $this->find('all', ['conditions' => ['login = ? AND password = ?', $login, $password]]);

		return ($user) ? $user[0] : FALSE;
	}
}