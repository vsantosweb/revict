<?php

namespace models;

use config\Database;

Class Fatura_model extends Database{

	function __construct()
	{
		parent::__construct();
	}
	public function display()
	{
		$sql = $this->db->query("SELECT * FROM ms_cargos");

		return $sql->fetchAll();
	}
}

