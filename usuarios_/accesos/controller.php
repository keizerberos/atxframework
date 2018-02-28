<?php 
//header('Content-Type: text/html;charset=ISO-8859-1');
session_start();

include $_SESSION['atx_includes'];
include $_SESSION['atx_databases'];

$_proceso = $_POST['_proceso'];
if ($_proceso == "getAccesos"){
	$ctrl = new TableSet();
	$cod = $_POST['cod'];
	$res = $ctrl->getJsonQuery ("SELECT m.cod 'cod_modulo', m.nom 'modulo', m.des 'descripcion',a.cod 'cod_acceso', a.cod_mod 'cod_modulo_acceso',a.acceso, a.* FROM modulos m LEFT JOIN maccesos a ON (m.cod = a.cod_mod AND a.cod_usu = $cod)");
	echo $res;
}

if ($_proceso == "updAccesos"){
	$params = new ParamsSQL();
	$accesos = json_decode($_POST['accesos']);
	$cod_usu = $_POST['cod_usu'];
	Logger::write("accesos = ". $_POST['accesos']);	
	//Logger::write($_POST['accesosVal']);	
	$res = "";
	for ($i = 0; $i < count($accesos->val); $i++) {		
		if ($accesos->cod[$i] == ""){
			$params = new ParamsSQL();
			$params->setString("cod_mod",$accesos->cod_mod[$i]);
			$params->setString("cod_usu",$cod_usu);
			$params->setString("acceso",$accesos->val[$i]?'1':'0');			
			$ctrl = new TableSet();	
			$res = $ctrl->insertarArg ($params, "maccesos");			
		}
		else{
			$params = new ParamsSQL();
			$params->setString("cod_mod",$accesos->cod_mod[$i]);
			$params->setString("cod_usu",$cod_usu);
			$params->setString("acceso",$accesos->val[$i]?'1':'0');
			$params->setCondition("cod = ".$accesos->cod[$i]);
			
			$ctrl = new TableSet();	
			$res = $ctrl->actualizarArg ($params, "maccesos");			
		}
	}
	
	//$ctrl = new TableSet();	
	//$res = $ctrl->actualizarArg ($params, "accesos");
	echo $res;
}

?>

	