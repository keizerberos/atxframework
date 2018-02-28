<?php


	$mods = $_SESSION['mod_info'];
	for ($i=0;$i < count($mods); $i++) if (isset($mods[$i]->path)) if (isset($mods[$i]->db)) include ($_SESSION['dircore']."/modules/".$mods[$i]->path."/".$mods[$i]->db);
	
	include $_SESSION['atx_db_core']."/tools.php";
			
	$db = array();
	$s=0;
	$m=0;
	$p=0;
	$a=0;

	for ($i=0 ;  $i<count($_SESSION['db']); $i++ ){
		
		if ($_SESSION['db'][$i]['type'] == "sqlserver"){
			if ($s==0) include $_SESSION['atx_db_core']."/sqlserver_tableset.php";
			$db['sqlserver'][$s] = $_SESSION['db'][$i];
			$db['s'][$s] = $_SESSION['db'][$i];
			$_SESSION['db_default'] = $_SESSION['db'][$i];			
			if (isset($_SESSION['db'][$i]['default']))
				if ($_SESSION['db'][$i]['default'])
					include $_SESSION['atx_db_core']."/def_sqlserver.php";					
			$s++;
		}
		if ($_SESSION['db'][$i]['type'] == "mysql"){
			if ($m==0) include $_SESSION['atx_db_core']."/mysql_tableset.php";
			$db['mysql'][$m] = $_SESSION['db'][$i];
			$db['m'][$m] = $_SESSION['db'][$i];
			$_SESSION['db_default'] = $_SESSION['db'][$i];
			if (isset($_SESSION['db'][$i]['default']))
				if ($_SESSION['db'][$i]['default'])
					include $_SESSION['atx_db_core']."/def_mysql.php";	
			$m++;
			
		}
		if ($_SESSION['db'][$i]['type'] == "postgresql"){
			if ($p==0) include $_SESSION['atx_db_core']."/postgresql_tableset.php";
			$db['postgresql'][$p] = $_SESSION['db'][$i];
			$db['p'][$p] = $_SESSION['db'][$i];
			$_SESSION['db_default'] = $_SESSION['db'][$i];
			if (isset($_SESSION['db'][$i]['default']))
				if ($_SESSION['db'][$i]['default'])
					include $_SESSION['atx_db_core']."/def_postgresql.php";	
			$p++;
		}
		if ($_SESSION['db'][$i]['type'] == "access"){
			if ($a==0) include $_SESSION['atx_db_core']."/access_tableset.php";
			$db['access'][$a] = $_SESSION['db'][$i];
			$db['a'][$a] = $_SESSION['db'][$i];
			$_SESSION['db_default'] = $_SESSION['db'][$i];
			if (isset($_SESSION['db'][$i]['default']))
				if ($_SESSION['db'][$i]['default'])
					include $_SESSION['atx_db_core']."/def_access.php";	
			$a++;
		}
	}
	
?>