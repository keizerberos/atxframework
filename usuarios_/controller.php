<?php 
//header('Content-Type: text/html;charset=ISO-8859-1');
session_start();
include $_SESSION['atx_databases'];

$q = $_POST['_proceso'];
if ($q == "getUsuarios"){
	$ctrl = new TableSet();	
	//$res = $ctrl->getDatasetTable ( "usuarios", "dsUsuarios" );
	$res = $ctrl->getDatasetQuery ( "select * from usuarios ");
	//$res ["query"] = "getUsuarios";
	echo json_encode ( $res );
}
if ($q == "getUsuariosJs"){
	$ctrl = new TableSet();
	$res = $ctrl->getJsonQuery ( "select * from usuarios ");
	echo $res;
}
if ($q == "getUsuariosJsx"){
	$page = $_POST['p'];
	$count = $_POST['c'];
	$pc = $page * $count;
	$ctrl = new TableSet();
	$tot = $ctrl->getScalar ( "select count(*) from usuarios ");
	$res = $ctrl->getArrayQuery ( "select * from usuarios ",$pc,$count,"cod");
	$dat['data'] = $res;
	$dat['count'] = ceil($tot/($count));
	
	echo json_encode($dat);
}
if ($q == "delUsuario"){
	$cod = $_POST['cod'];
	
	$ctrl = new TableSet();
	$ctrl->executeQuery ( "delete from usuarios where cod = $cod");
	
	echo "ok";
}

//echo '{ "records":[ {"Name":"Alfreds Futterkiste","City":"Berlin","Country":"Germany"},{"Name":"Ana Trujillo Emparedados y helados","City":"México D.F.","Country":"Mexico"}]}';

//{ "records":[ {"Name":"Alfreds Futterkiste","City":"Berlin","Country":"Germany"}, {"Name":"Ana Trujillo Emparedados y helados","City":"México D.F.","Country":"Mexico"}, {"Name":"Antonio Moreno Taquería","City":"México D.F.","Country":"Mexico"}, {"Name":"Around the Horn","City":"London","Country":"UK"}, {"Name":"B's Beverages","City":"London","Country":"UK"}, {"Name":"Berglunds snabbköp","City":"Luleå","Country":"Sweden"}, {"Name":"Blauer See Delikatessen","City":"Mannheim","Country":"Germany"}, {"Name":"Blondel père et fils","City":"Strasbourg","Country":"France"}, {"Name":"Bólido Comidas preparadas","City":"Madrid","Country":"Spain"}, {"Name":"Bon app'","City":"Marseille","Country":"France"}, {"Name":"Bottom-Dollar Marketse","City":"Tsawassen","Country":"Canada"}, {"Name":"Cactus Comidas para llevar","City":"Buenos Aires","Country":"Argentina"}, {"Name":"Centro comercial Moctezuma","City":"México D.F.","Country":"Mexico"}, {"Name":"Chop-suey Chinese","City":"Bern","Country":"Switzerland"}, {"Name":"Comércio Mineiro","City":"São Paulo","Country":"Brazil"} ] }
?>

	