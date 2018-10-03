<?php

namespace views\login\components;

use models\RVCT_model;

class Login extends RVCT_model
{
	public $auth = false;

	private $session_data = array();

	public function status(){}
	public function logout(){}

	public function auth()
	{
		return $this->auth ? session_start() : false;
	}

	public function validate()
	{
		return $this->get('rvct_users');
	}
}



