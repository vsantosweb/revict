<?php

namespace model;

use model\RVCT_model;

class Clientes extends RVCT_model {

	public $pagination;
	public $data = array();

	function __construct()
	{
		parent::__construct();
		$this->relatorios();
	}
	
	public function create($data)
	{
		$rows = $this->get('rvct_clientes', 'cli_cpf', $data['cli_cpf']);

		if(is_null($rows) || empty($rows) || $rows < 0){

			$this->insert('rvct_clientes', $data);

			return true;

		}else{

			return false;
		}
	}
	public function list(){


		$url_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;

		$max_reg = 4;

		$num_regisros = count($this->get('rvct_clientes'));

		$inicio = ($max_reg  * $url_page) - $max_reg;

		$num_pages = ceil($num_regisros / $max_reg);


		$this->pagination = $num_pages;

		//$inicio = ($this->limit * $url_page) - $this->limit;
		//echo $inicio;
		return $this->custom_get('rvct_clientes', 'cli_data_reg', $inicio, $max_reg);
	}

	public function find($id)
	{
		return $this->get('rvct_clientes', 'id', $id);
	}

	public function alter($data, $id){

		$this->update('rvct_clientes', $data, $id);
	}
	public function del($id){
		
		$this->delete('rvct_clientes', $id);
	}
	public function relatorios()
	{
		$this->data['total'] = $this->get('rvct_clientes');
	}
}

/*
items::

Data
Empresa
Cliente
Total
Pago
Balanço
Vencimento
Status

Açoes
Ver
Inserir Pgto

*/