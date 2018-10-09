<?php
namespace models;

class Faturas extends RVCT_model {

	public $pagination;
	public $data = array();
	public $status;

	function __construct()
	{
		parent::__construct();
		$this->relatorios();
	}
	
	public function get_clientes() {

		foreach($this->get('rvct_clientes', 'cli_nome,id') as $keys)
		{

			$clientes[] = $keys;
			
		}
		return $clientes;
	}

	public function create($data)
	{

		$data['cli_nome'] = $this->get('rvct_clientes', 'cli_nome', 'id', $data['cli_id'])[0]['cli_nome'];
		$data['fat_status'] = 'aberto';
		$data['fat_balanco'] = $data['fat_total'];
		$this->insert('rvct_faturas', $data);
		return true;
	}

	public function list(){


		$url_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;

		$max_reg = 4;

		$num_regisros = count($this->get('rvct_faturas'));

		$inicio = ($max_reg  * $url_page) - $max_reg;

		$num_pages = ceil($num_regisros / $max_reg);


		$this->pagination = $num_pages;

		return $this->custom_get('rvct_faturas', 'fat_data_reg', $inicio, $max_reg);
	}
	
	public function find($id)
	{
		return $this->get('rvct_faturas',  null , 'id', $id);
	}

	public function alter($data, $id){

		$this->update('rvct_faturas', $data, $id);
	}
	public function del($id){
		
		$this->delete('rvct_faturas', $id);
	}
	public function status($status) {

		$result = $this->data['status'] = $this->get('rvct_faturas', 'fat_status', 'fat_Status', $status);

		return count($result);
	}
	public function relatorios()
	{

		$this->data['total'] = $this->get('rvct_faturas', 'id');

		$this->data['status'] = $this->get('rvct_faturas', 'cli_status');

	}

	public function fat_rules(){

		$faturas = $this->get('rvct_faturas');

		
		//echo (strtotime($keys['fat_vencimento'] > $hoje) ? 'vencido!!' : 'nao vencido');
		//echo strtotime($faturas[0]['fat_vencimento']) > $hoje ? 'sim': 'nao';
		foreach ($faturas as $key) {
			$data_venc[] = $key['fat_vencimento'];
			$totais_pendentes[] = $key['fat_total'];
			$totais_pagos[] =  $key['fat_pgto'];
			$balancos[] = $key['fat_balanco'];

		}		

		for($i = 0; $i < count($data_venc); $i++)
		{
			if($data_venc[$i] >= date('Y-m-d')) 
			{
				$data['fat_status'] = 'aberto';
				$this->update('rvct_faturas', $data, $faturas[$i]['id']);

			}else{

				$data['fat_status'] = 'atrasado';
				$this->update('rvct_faturas', $data, $faturas[$i]['id']);
			}
		}
		for($i = 0; $i < count($totais_pendentes); $i++)
		{
			if($totais_pendentes[$i] == $totais_pagos[$i]) 
			{
				$data['fat_status'] = 'pago';
				$this->update('rvct_faturas', $data, $faturas[$i]['id']);

			}
		}

	}
	public function insere_pgto($fat_id, $update_pagto)
	{
		$result = $this->get('rvct_faturas', 'fat_pgto, fat_balanco, fat_total' , 'id', $fat_id);

		print_r($result);

		foreach($result  as $key) {

			$total_fatura = $key['fat_total'];
			$current_pgto = $key['fat_pgto'];
			$current_balanco = $key['fat_balanco'];
			

			if($update_pagto > $current_balanco)
			{
				return 'Impossivel realizar a operação';
			}
			else{
				$data['fat_pgto'] = $current_pgto + $update_pagto;
				$data['fat_balanco'] = $current_balanco - $update_pagto;


			}
			$this->update('rvct_faturas', $data, $fat_id);

			echo $data['fat_balanco'];
			if($data['fat_balanco'] < $total_fatura){

				$data['fat_status'] = 'parcial';
				$this->update('rvct_faturas', $data, $fat_id);

			}

			if($data['fat_balanco'] <= 0)
			{
				$data['fat_status'] = 'pago';
				$this->update('rvct_faturas', $data, $fat_id);
			}

			return 'Operação realizada com sucesso!';
		}
		
	}
	public function alter_venc($date, $id){

		$data['fat_vencimento'] = $date;
		return $this->update('rvct_faturas', $data,  $id) ? : 'Operação Realizada!';
	}
}

// total - pagamento = balanco