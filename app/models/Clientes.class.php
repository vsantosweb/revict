<?php
/**
 * @author Vitor Santos (vsantosweb@vsantosweb.com)
 */

namespace models;

class Clientes extends RVCT_model {

	/**
	 * pagination cria paginação genérica de uma listagem do banco de dados
	 * @var pagination
	 */

	public $pagination;

	/**
   * Recebe o resultado de relatórios por consultas no banco
   *
   * @var data
   */

	public $data = array();


	/**
   * Retorna o status do cliente
   *
   * @return status
   */
	public $status;

	function __construct()
	{
		parent::__construct();
		$this->relatorios();
		$this->get_status();
	}
	
	public function create($data)
	{

		// valida se o cpf existe, e retorna erro caso exista, caso contrário cadastra um novo cliente

		$rows = $this->get('rvct_clientes', 'cli_cpf', 'cli_cpf', $data['cli_cpf']);

		if(is_null($rows) || empty($rows) || $rows <= 0){

			$data['cli_status'] = 'ativo';
			$this->insert('rvct_clientes', $data);

			return true;

		}else{

			return false;
		}
	}
	public function list(){

		// cria paginação genérica da listagem do banco

		$url_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;

		$max_reg = 4;

		$num_regisros = count($this->get('rvct_clientes'));

		$inicio = ($max_reg  * $url_page) - $max_reg;

		$num_pages = ceil($num_regisros / $max_reg);

		$this->pagination = $num_pages;

		return $this->custom_get('rvct_clientes', 'cli_data_reg', $inicio, $max_reg);
	}
	public function get_status()
	{
		//Faz a consulta de status dos clientes no banco e retorna 

		foreach($this->get('rvct_cliente_status') as $keys)
		{

			$this->status[] = $keys;
			
		}
		return $this->status;
	}
	public function find($id)
	{
		// recebe id como parametro e para retornar o resultado de 1 usuário
		return $this->get('rvct_clientes',  null , 'id', $id);
	}

	public function alter($data, $id){

		// Usamos para alterar dados cadastrais 
		$this->update('rvct_clientes', $data, $id);
	}
	public function del($id){
		// Usamos para deletar um cliente
		$this->delete('rvct_clientes', $id);
	}
	public function status($status) {

		// Usamos para fazer contagem e gerar relatórios de quantos clientes possui e seus status
		$result = $this->data['status'] = $this->get('rvct_clientes', 'cli_status', 'cli_Status', $status);

		return count($result);
	}
	public function relatorios()
	{
		//Retorna relatórios geneéricos 

		$this->data['total'] = $this->get('rvct_clientes', 'id');

		$this->data['status'] = $this->get('rvct_clientes', 'cli_status');

	}
}