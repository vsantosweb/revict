<?php include '../../autoload.php'; ?>
<?php  

print_r($_GET);
print_r($_POST);
//$token  = ($_GET['token'] == sha1('alterar') ? 'alterar': $_GET['token'] == sha1('criar') ? 'criar' : $_GET['token'] == sha1('deletar') ? 'deletar': 'nao');



function set_token($token) {

	if($token['token'] == sha1('alter')) {

		$v_token = 'alter';
	}
	elseif($token['token'] == sha1('create')) {

		$v_token = 'create';
	}
	elseif($token['token'] == sha1('delete')) {

		$v_token = 'delete';
	}else{
		$v_token = null;
	}

	return $v_token;
}

function gateway_token($token) {

	$cliente = new models\Clientes;

	switch($token)
	{
		case 'create':

		if(isset($_POST))
		{
			if($cliente->create($_POST))
			{
				$_GET['status'] = 'Usuario registrado com Sucesso!';
				header('Location: addcliente.php?status='. $_GET['status']);
			}else{

				$_GET['status'] = 'Usuário já existe.';
				header('Location: addcliente.php?status='. $_GET['status']);
			}

		}
		break;
		case 'alter':

		if(isset($_POST))
		{
				$cliente->alter($_POST, $_POST['id']);
				$_GET['id'] = $_POST['id'];
				$_GET['status'] = 'Usuario Alterado';
				header('Location: updatecliente.php?id='. $_GET['id'] .'&status='. $_GET['status']);

				// $_GET['status'] = 'Usuario Não pode ser Alterado';
				// header('Location: addcliente.php?status=Usuário Usuario Não pode ser Alterado.');
		}
		break;
		case 'delete':
		
		if(isset($_POST))
		{
				$cliente->del($_POST);
				$_GET['status'] = 'Usuario Alterado';
				header('Location: index.php?status=Cliente removido!');
		}
		break;
	}
	
}

echo set_token($_GET);
gateway_token(set_token($_GET));

?>
