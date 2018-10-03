<?php

namespace views\login\components;

include ('../../../autoload.php');




//echo sha1('usr_passwd');
//print_r($login->validate());



function auth_validate($post) {

	$login = new Login();

	foreach($login->validate() as $keys)
	{
		
		if((strtolower($keys['usr_usuario']) == strtolower($post['usr_usuario'])) && 
			$keys['usr_passwd'] == $post['usr_passwd']){
			
			$login->auth = true;

			return $keys;
		} 

	}


	return $login->auth() ? header('location: http://localhost/revict/app/views/home.php') : header('location: http://localhost/revict/app/views/login/') ;
}


header('location: http://localhost/revict/app/views/home.php');

$_SESSION = auth_validate($_POST);

print_r($_SESSION);


