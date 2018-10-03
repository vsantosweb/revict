<?php

namespace config;

class Database {

	protected $db;
	private $host ='localhost';
	private $dbname ='revict';
	private $dbuser ='root';
	private $dbpasswd ='developer';
	private $charset = 'utf8';

	function __construct(){
		try{

			$this->db = new \PDO('mysql:host='.$this->host.';dbname='.$this->dbname. ';charset='.$this->charset, $this->dbuser, $this->dbpasswd);

		}catch(PDOExpection $e){

			echo 'ERROR:'. $e->getMessage();

		}
	}
}
