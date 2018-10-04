<?php



function autoload($file_name){

	$file = $_SERVER['DOCUMENT_ROOT'] . '/revict/app/' . str_replace('\\', '/', $file_name) . '.class.php';

	if(file_exists($file))
	 {	
		 
         include_once($file);
	 	
	 }else{
		echo $file. ' nao encontrado';
     }

}


spl_autoload_register('autoload');