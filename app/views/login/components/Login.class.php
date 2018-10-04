<?php

namespace views\login\components;

use models\RVCT_model;

class Login extends RVCT_model
{
	public $auth;

	private $session_data = array();
 	
	public function logout(){

		session_start();

		print_r($_SESSION);

		session_destroy();

		header('location: http://localhost/revict/app/views/login');
	}

	public function auth()
	{
		return $this->auth ? session_start() : false;
	}

	public function validate()
	{
		return $this->get('rvct_users');
	}
}



