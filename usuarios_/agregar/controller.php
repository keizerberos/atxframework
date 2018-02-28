<?php 
//header('Content-Type: text/html;charset=ISO-8859-1');
session_start();
include $_SESSION['atx_databases'];

$_proceso = $_POST['_proceso'];
if ($_proceso == "nuevoUsuario"){
	$params = new ParamsSQL();
	$params->setString("nombre",$_POST['nombre']);
	$params->setString("usuario",$_POST['usuario']);
	$params->setString("clave",$_POST['clave']);
	//$params->setString("us_cn_id",$_POST['idContacto']);
	
	$ctrl = new TableSet();	
	$res = $ctrl->insertarArg ($params, "usuarios");
}

if ($_proceso == "getUsuarios"){
	$ctrl = new TableSet();	
	//$res = $ctrl->getDatasetTable ( "usuarios", "dsUsuarios" );
	$res = $ctrl->getDatasetQuery ( "select * from usuarios ");
	echo json_encode ( $res );
}
if ($_proceso == "getUsuariosJs"){
	$ctrl = new TableSet();
	$res = $ctrl->getJsonQuery ( "select * from usuarios ");
	echo $res;
}

//echo '{ "records":[ {"Name":"Alfreds Futterkiste","City":"Berlin","Country":"Germany"},{"Name":"Ana Trujillo Emparedados y helados","City":"México D.F.","Country":"Mexico"}]}';

//{ "records":[ {"Name":"Alfreds Futterkiste","City":"Berlin","Country":"Germany"}, {"Name":"Ana Trujillo Emparedados y helados","City":"México D.F.","Country":"Mexico"}, {"Name":"Antonio Moreno Taquería","City":"México D.F.","Country":"Mexico"}, {"Name":"Around the Horn","City":"London","Country":"UK"}, {"Name":"B's Beverages","City":"London","Country":"UK"}, {"Name":"Berglunds snabbköp","City":"Luleå","Country":"Sweden"}, {"Name":"Blauer See Delikatessen","City":"Mannheim","Country":"Germany"}, {"Name":"Blondel père et fils","City":"Strasbourg","Country":"France"}, {"Name":"Bólido Comidas preparadas","City":"Madrid","Country":"Spain"}, {"Name":"Bon app'","City":"Marseille","Country":"France"}, {"Name":"Bottom-Dollar Marketse","City":"Tsawassen","Country":"Canada"}, {"Name":"Cactus Comidas para llevar","City":"Buenos Aires","Country":"Argentina"}, {"Name":"Centro comercial Moctezuma","City":"México D.F.","Country":"Mexico"}, {"Name":"Chop-suey Chinese","City":"Bern","Country":"Switzerland"}, {"Name":"Comércio Mineiro","City":"São Paulo","Country":"Brazil"} ] }
?>

	