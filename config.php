<?php
/********************** 0.3v  *******************/
/** -Multi Dbs
/**
/**
/******************CONFIGURATION*****************/

$atx_config['db'] = "db_name" ;    
$atx_config['path'] = "http://localhost:8070/activos";  
$atx_config['title'] = "atxRock 0.0.0" ;  

$atx_config['db'] = array();
$atx_config['db'][0] = array (
	'type' => 'mysql',
	'server' => '10.0.37.38',
	'user' => 'root',
	'pass' => '12345',
	'db' => 'slimpy',
	'port' => '3306'
);
$atx_config['db'][1] = array (
	'type' => 'sqlserver',
	'server' => '10.0.9.134',
	'user' => 'sa',
	'pass' => 'Santi99',
	'db' => 'DBUA_ACT',
	'port' => '1433'
);
$atx_config['db'][2] = array (
	'type' => 'postgresql',
	'server' => '10.0.0.15',
	'user' => 'postgres',
	'pass' => 'min2014123%',
	'db' => 'sicopsource',
	'port' => '5432'
);
$atx_config['db'][3] = array (
	'type' => 'access',
	'server' => $_SERVER["DOCUMENT_ROOT"]."/acc/",
	'user' => '',
	'pass' => '',
	'db' => 'att-cap-ravelo.mdb'
);
$atx_config['db'][4] = array (
	'type' => 'access',
	'server' => $_SERVER["DOCUMENT_ROOT"]."/acc/",
	'user' => '',
	'pass' => '',
	'db' => 'att-loteria.mdb'
);
$atx_config['db'][5] = array (
	'type' => 'access',
	'server' => $_SERVER["DOCUMENT_ROOT"]."/acc/",
	'user' => '',
	'pass' => '',
	'db' => 'att-central.mdb'
);

$atx_config['modules'] = ['log','axs'];		//	Agregar carpetas en addons

/******************DON'T CHANGE*****************/


session_start(); 
$atx_config['pathcore'] = $atx_config['path']."/_core" ;  
$_SESSION['path'] = $atx_config['path'];
$_SESSION['dir'] = __DIR__;
$_SESSION['dircore'] = __DIR__."/_core";
$_SESSION['atx_db_core'] = __DIR__."/_core/databases";
$_SESSION['atx_databases'] = __DIR__."/_core/includes/databases.php";
$_SESSION['pathcore'] = $atx_config['pathcore'];
$_SESSION['title'] = $atx_config['title'];
$_SESSION['db'] = $atx_config['db'];
include "tools.php";
$db = array();
$s=0;
$m=0;
$p=0;
$a=0;

for ($i=0 ;  $i<count($_SESSION['db']); $i++ ){
	
	if ($_SESSION['db'][$i]['type'] == "sqlserver"){
		if ($s==0) include "sqlserver_tableset.php";
		$db['sqlserver'][$s] = $_SESSION['db'][$i];
		$db['s'][$s] = $_SESSION['db'][$i];
		$s++;
	}
	if ($_SESSION['db'][$i]['type'] == "mysql"){
		if ($m==0) include "mysql_tableset.php";
		$db['mysql'][$m] = $_SESSION['db'][$i];
		$db['m'][$m] = $_SESSION['db'][$i];
		$m++;
	}
	if ($_SESSION['db'][$i]['type'] == "postgresql"){
		if ($p==0) include "postgresql_tableset.php";
		$db['postgresql'][$p] = $_SESSION['db'][$i];
		$db['p'][$p] = $_SESSION['db'][$i];
		$p++;
	}
	if ($_SESSION['db'][$i]['type'] == "access"){
		if ($a==0) include "access_tableset.php";
		$db['access'][$a] = $_SESSION['db'][$i];
		$db['a'][$a] = $_SESSION['db'][$i];
		$a++;
	}
}


?>