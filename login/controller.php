<?php
session_start();
include $_SESSION['atx_includes'];

$q = $_POST['_proceso'];
if ($q == "logearse"){
	$ctrl = new MYSQL($db['m'][0]);
	$u = $_POST['u'];
	$p = $_POST['p'];
	
	$r = $ctrl->getArrayQuery("select * from usuarios where usuario = '$u' and clave = '$p'",null,null,null);
	
	$_SESSION['axs_logeado'] = true;
	if (count($r) > 0 ){		 
		 $id = $r[0]['cod'];
		 $r1 = $ctrl->getArrayQuery("select m.cod, m.nom 'modulo', m.dir from maccesos a join modulos m on (m.cod = a.cod_mod) where a.acceso = 1 and a.cod_usu = $id",null,null,null);
		 $accesos = new Accesos();
		 $accesos->setAccess($r1);
		echo '{"result":"ok","user_name":"'.$r[0]["nombre"].'" ,"lastpage":"'.$_SESSION['last_page'].'"}';	
	}
	else
		echo '{"result":"fail ","lastpage":"'.$_SESSION['last_page'].'"}';		
}
if ($q == "desloguearse"){
	$_SESSION['axs_logeado'] = false;
		echo '{"result":"fail ","lastpage":"'.$_SESSION['last_page'].'"}';	
}

?>