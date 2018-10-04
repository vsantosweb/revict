<?php

namespace views\login\components;

include ('../../../autoload.php');


function auth_validate($post) {

	$login = new Login();

	foreach($login->validate() as $keys)
	{
		
		if((strtolower($keys['usr_usuario']) == strtolower($post['usr_usuario'])) && $keys['usr_passwd'] == $post['usr_passwd']){
			
			$login->auth = true;
		} 

	}
	

	if($login->auth()) {

		$_SESSION = $keys;
		header('location: http://localhost/revict/app/views/clientes');

	}else{

		unset($_SESSION);
		session_destroy();
		header('location: http://localhost/revict/app/views/login');
	}
	//header('location: http://localhost/revict/app/views/dashboard');

}


auth_validate($_POST);





