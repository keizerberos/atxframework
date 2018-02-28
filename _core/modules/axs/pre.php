<?php
	/*header("Location: https://www.google.com");
	die();
	exit();*/
	//session_start();
	
	$tipo = $_SESSION['load_file'];
	
	if ($tipo == "atx_generic_header" && $_SESSION['form_name'] != "login" && $_SESSION['form_name'] != "noaccess"){
		
		
		if (!$_SESSION['axs_logeado']==true){
			$_SESSION['last_page'] = $_SERVER['REQUEST_URI'];
			$_SESSION['axs_logeado']=false;
			header("Location: ".$atx_config['path']."login");
		}
		else{
			 $accesos = new Accesos();
			if ($accesos->canIn($_SESSION['form_name'])){
				
			}
			else
				header("Location: ".$atx_config['path']."noaccess");
		}
	}
	else 
		if ($_SESSION['form_name'] == "login")
			$_SESSION['axs_logeado']=false;
?>