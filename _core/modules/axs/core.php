<?php
class Accesos{
	function setAccess($data){
		//session_start();
		$_SESSION['axs_data'] = json_encode($data);
	}
	function logout(){
		
	}
	function canIn($formName){
		//session_start();
		$forms = json_decode($_SESSION['axs_data']);
		Logger::write($_SESSION['axs_data']);
				
		for( $i = 0 ; $i < count($forms); $i++){
			Logger::write($forms[$i]->dir . " == " . $formName);
			if (strtoupper($forms[$i]->dir) == strtoupper($formName))
				return true;
		} 
		return false;
	}
}
?>
