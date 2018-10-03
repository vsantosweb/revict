<?php

namespace models;

use config\Database;

class RVCT_model extends Database{

	function __construct()
	{
		parent::__construct();
	}

	public function insert($table_name, $data) {

		$arr_keys = array_keys($data);
		$arr_values = array_values($data);
		$keys = implode(', ' , $arr_keys);
		$values = implode("','", $arr_values);

		$sql = $this->db->prepare("INSERT INTO ".$table_name."($keys) VALUES ('$values')");
		
		if($sql->execute())
		{
			echo 'Tarefa realizada';

		}else{
			echo 'Algo deu errado';
		}

	}
	public function get($table_name, $id = null)
	{
		if(is_null($id))
		{
			$sql = $this->db->prepare("SELECT * FROM ".$table_name."");
			//$sql->bindParam(':id', $id, \PDO::PARAM_INT);
			$sql->execute();
			return $sql->fetchAll();
		}else{

			$sql = $this->db->prepare("SELECT * FROM ".$table_name." WHERE id = :id");
			$sql->bindParam(':id', $id, \PDO::PARAM_INT);
			$sql->execute();
			return $sql->fetchAll();
		}
		
	}
	public function update($table_name, $data, $id = null)
	{

		foreach($data as $keys => $values) {

			$sql = $this->db->prepare("UPDATE ".$table_name." SET $keys='$values' WHERE id= :id ");
			$sql->bindParam(':id', $id, \PDO::PARAM_INT);
			$sql->execute();
		}

	}
	public function delete($table_name, $id = null)
	{

		$sql = $this->db->prepare("DELETE FROM ".$table_name." WHERE id= :id ");
		$sql->bindParam(':id', $id, \PDO::PARAM_INT);
		$sql->execute();
	}
}