<?php
namespace models;

class Clientes extends RVCT_model {

	public $pagination;
	public $data = array();
	public $status;

	function __construct()
	{
		parent::__construct();
		$this->relatorios();
		$this->get_status();
	}
	
	public function create($data)
	{
		$rows = $this->get('rvct_clientes', 'cli_cpf', 'cli_cpf', $data['cli_cpf']);

		if(is_null($rows) || empty($rows) || $rows < 0){

			$data['cli_status'] = 'ativo';
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
	public function get_status()
	{
		foreach($this->get('rvct_cliente_status') as $keys)
		{

			$this->status[] = $keys;
			
		}
		return $this->status;
	}
	public function find($id)
	{
		return $this->get('rvct_clientes',  null , 'id', $id);
	}

	public function alter($data, $id){

		$this->update('rvct_clientes', $data, $id);
	}
	public function del($id){
		
		$this->delete('rvct_clientes', $id);
	}
	public function status($status) {

		$result = $this->data['status'] = $this->get('rvct_clientes', 'cli_status', 'cli_Status', $status);

		return count($result);
	}
	public function relatorios()
	{

		$this->data['total'] = $this->get('rvct_clientes', 'id');

		$this->data['status'] = $this->get('rvct_clientes', 'cli_status');

	}
}