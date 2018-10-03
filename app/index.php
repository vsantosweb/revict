<?php

include 'autoload.php';

use models\RVCT_model;

$crud = new RVCT_model;


$data = array("usr_usuario" => "Vitor", "usr_nome" => "estou", "usr_passwd"=> "foda");

$crud->delete('rvct_users', 5);
 //$crud->update('rvct_users', $data, 5);
//$crud->get('rvct_clientes');
//$crud->insert('rvct_users', $data);		
