<?php include '../../autoload.php'; ?>
<?php  

print_r($_GET);
print_r($_POST);


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

$token = ($_GET['token'] == sha1('alter')) ? 'alter' : 
(($_GET['token'] == sha1('create')) ? 'create' : 
($_GET['token'] == sha1('delete') ? 'delete' : 'false'));

gateway_token($token);

?>
