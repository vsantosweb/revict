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
		echo $values.'<br>';
		echo $keys. '<br>';
		$sql = $this->db->prepare("INSERT INTO ".$table_name."($keys) VALUES ('$values')");
		
		if($sql->execute())
		{
			echo 'cadastro efetuado';

		}else{
			echo 'algo deu errado';
			return false;
		}

	}
	protected function get($table_name, $column = null ,$row = null, $param = null)
	{
		if(isset($table_name) && is_null($column) && is_null($row) && is_null($param))
		{
			$sql = $this->db->prepare("SELECT * FROM ".$table_name."");
			//$sql->bindParam(':id', $id, \PDO::PARAM_INT);
			$sql->execute();
			return $sql->fetchAll(\PDO::FETCH_ASSOC);

		}elseif(is_null($column) && isset($row) && isset($param)){

			$sql = $this->db->prepare("SELECT * FROM ".$table_name." WHERE " .$row."=:param");
			$sql->bindParam(':param', $param, \PDO::PARAM_STR);
			$sql->execute();
			return $sql->fetchAll(\PDO::FETCH_ASSOC);

		}elseif(isset($column) && is_null($row) && is_null($param)){

			$sql = $this->db->prepare("SELECT " .$column." FROM ".$table_name."");
			$sql->bindParam(':param', $param, \PDO::PARAM_STR);
			$sql->execute();
			return $sql->fetchAll(\PDO::FETCH_ASSOC);

		}elseif(isset($column) && isset($row) && isset($param)){

			$sql = $this->db->prepare("SELECT " .$column. " FROM ".$table_name." WHERE " .$row."=:param");
			$sql->bindParam(':param', $param, \PDO::PARAM_STR);
			$sql->execute();
			return $sql->fetchAll(\PDO::FETCH_ASSOC);

		}
		
	}
	protected function custom_get($table_name, $order_by, $start, $end)
	{
		$sql = $this->db->prepare("SELECT * FROM ".$table_name." ORDER BY ". $order_by." desc LIMIT ".$start.",".$end."");
		$sql->execute();

		return $sql->fetchAll(\PDO::FETCH_ASSOC);
	}
	protected function update($table_name, $data, $id = null)
	{
		foreach($data as $keys => $values) {

			$sql = $this->db->prepare("UPDATE ".$table_name." SET $keys='$values' WHERE id= :id ");
			$sql->bindParam(':id', $id, \PDO::PARAM_INT);
			$sql->execute();
		}

	}
	protected function delete($table_name, $data = null)
	{
		foreach($data as $keys => $id){

			$sql = $this->db->prepare("DELETE FROM ".$table_name." WHERE id= :id ");
			$sql->bindParam(':id', $id, \PDO::PARAM_INT);
			$sql->execute();
		}
		
	}

}