<?php

namespace models;

class System {

	private $session;
	protected $task;
	protected $action;

	protected function check_route()
	{
		$this->session = session_start();

		$this->task = $_GET['task'];
		$this->action = $_GET['action'];

		if(empty($_GET)) {

			header('location: ?task=login');

			if(empty($_SESSION))
			{
				header('location: ?task=login');	
			}else{
				header('location: ?task=launcher');
			}
		}
	}
	protected function check_task()
	{
		if(class_exists('controllers\\'. $this->task))
		{
			if(method_exists('controllers\\'. $this->task, $this->action)){

				echo 'existe';
			}
		}else{
			'caralho';
		}
	}
	public function init(){

		$this->check_route();
		$this->check_task();
	}
}