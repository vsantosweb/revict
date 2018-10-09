<?php include '../../autoload.php'; ?>
<?php  


function gateway_token($token) {

	$fatura = new models\Faturas;

	switch($token)
	{
		case 'create':

		if(isset($_POST))
		{
			if($fatura->create($_POST))
			{
				$_GET['status'] = 'Fatura Cadastrada com sucesso!';
				header('Location: addfatura.php?status='. $_GET['status']);
			}else{

				$_GET['status'] = 'Usuário já existe.';
				echo 'false';
				header('Location: addfatura.php?status='. $_GET['status']);
			}

		}
		break;
	}
	
}

$token = ($_GET['token'] == sha1('alter')) ? 'alter' : 
(($_GET['token'] == sha1('create')) ? 'create' : 
($_GET['token'] == sha1('delete') ? 'delete' : 'false'));

gateway_token($token);

?>
