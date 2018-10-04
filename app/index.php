<?php

include 'autoload.php';

header('Location: views');

use models\RVCT_model;

$crud = new RVCT_model;

$data = array("usr_usuario" => "cobranca@teste.com", "usr_nome" => "estou", "usr_passwd"=> "123");

$ids = array(49);


//$crud->delete('rvct_clientes', $ids);
//$crud->update('rvct_users', $data, 5);
//$crud->delete('rvct_users', $values);
//$crud->insert('rvct_users', $data);		
