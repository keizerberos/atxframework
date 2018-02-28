<?php
//header('Content-Type: text/html;charset=ISO-8859-1');
//ini_set("log_errors", 1);

class SQLSERVER {
	var $con;
	var $nombreTabla;
	public function SQLSERVER($opt) {
		$serverName = $opt ["server"].",".$opt ["port"]; //serverName\instanceName, portNumber (por defecto es 1433)
		$connectionInfo = array( "CharacterSet" => "UTF-8", "Database"=>$opt ["db"], "UID"=>$opt ["user"], "PWD"=>$opt ["pass"]);
		$this->con = sqlsrv_connect( $serverName, $connectionInfo);
		if( $this->con ) {
		}else{
			 die( print_r( sqlsrv_errors(), true));
		}
		// mysqli_select_db ( $GLOBALS ["cfg_database"], $this->con );
		SQLSRV_PHPTYPE_STRING('UTF-8');
		//sqlsrv_query($this->con,"SET CHARACTER SET utf8");
		date_default_timezone_set('America/La_Paz');
	}
	public function close() {
		sqlsrv_close($this->con);
	}
	public function insertar($fields, $values, $tabla) {
		/* NO APLICABLE AÚN*/
	}
	public function insertarArg($params, $tabla) {
		$fields = $params->formatted_fields;
		$values = $params->formatted_insert;
		
		$file = fopen ( "log.txt", "a" );		
		fwrite ( $file, date("Y-m-d h:i:sa").' [TRY QUERY] ' . "insert into " . $tabla . " ($fields) values ($values)" . PHP_EOL );
		fclose ( $file );
		
		$result = sqlsrv_query ( $this->con, "insert into " . $tabla . " ($fields) values ($values)" );
		//$id = mysqli_insert_id ( $this->con );
		
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, date("Y-m-d h:i:sa").' [ID QUERY] ' . '0' . PHP_EOL );
		
		if( ($errors = sqlsrv_errors() ) != null) {
			foreach( $errors as $error ) {				
				fwrite ($file, "SQLSTATE: ".$error[ 'SQLSTATE'] . PHP_EOL );
				fwrite ($file, "SQLSTATE: ".$error[ 'SQLSTATE']. PHP_EOL);
				fwrite ($file, "code: ".$error[ 'code']. PHP_EOL);
				fwrite ($file, "message: ".$error[ 'message']. PHP_EOL);
			}
		}
		fclose ( $file );
		
		return 1;
	}
	public function actualizar($fields, $values, $tabla, $condition) {
		/*no aplica*/
	}
	public function actualizarArg($params, $tabla) {
		$fields = $params->formatted_fields;
		$values = $params->formatted_update;
		$condition = $params->formatted_conditions;
		
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, date("Y-m-d h:i:sa").'[TRY QUERY] ' . "update " . $tabla . " SET $values WHERE $condition" . PHP_EOL );
		fclose ( $file );
		
		$result = sqlsrv_query ( $this->con, "update " . $tabla . " SET $values WHERE $condition" );
		//$id = mysqli_insert_id ( $this->con );
		
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, '[ID QUERY] ' . 0 . PHP_EOL );
		//fwrite ( $file, mysqli_error ( $this->con ) . PHP_EOL );
		if( ($errors = sqlsrv_errors() ) != null) {
			foreach( $errors as $error ) {				
				fwrite ($file, "SQLSTATE: ".$error[ 'SQLSTATE'] . PHP_EOL );
				fwrite ($file, "code: ".$error[ 'code']. PHP_EOL);
				fwrite ($file, "message: ".$error[ 'message']. PHP_EOL);
			}
		}
		fclose ( $file );
		
		return 0;
	}
	public function executeQuery($query) {
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, date("Y-m-d h:i:sa").' [EXEC QUERY] ' . $query . PHP_EOL );
		fclose ( $file );
		
		$result = sqlsrv_query ( $this->con, $query );
		//$id = mysqli_insert_id ( $this->con );
		
		return 1;
	}
	public function getScalar($query) {
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, date("Y-m-d h:i:sa").' [EXEC QUERY] ' . $query . PHP_EOL );
		fclose ( $file );
		
		$result = sqlsrv_query ( $this->con, $query );
		$value = sqlsrv_fetch_array ( $result );
		return $value [0];
	}
	
	public function getArrayQueryOk($query){		
		
		
		$resultado = sqlsrv_query ( $this->con, $query ) or die ( "Error query array ".$query); 
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, date("Y-m-d h:i:sa").' [EXEC QUERY] ' . $query . PHP_EOL );
		
		if( ($errors = sqlsrv_errors() ) != null) {
			foreach( $errors as $error ) {				
				fwrite ($file, "SQLSTATE: ".$error[ 'SQLSTATE'] . PHP_EOL );
				fwrite ($file, "code: ".$error[ 'code']. PHP_EOL);
				fwrite ($file, "message: ".$error[ 'message']. PHP_EOL);
				
				echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
				echo "code: ".$error[ 'code']."<br />";
				echo "message: ".$error[ 'message']."<br />";
			}
		}
		fclose ( $file );
		
		
		$js = array ();
		
		while ( $fila = sqlsrv_fetch_array ( $resultado ) ) {
					
			array_push ( $js, $fila );
		}
		
		return $js;
	}
	
	public function getArrayQuery($query,$de,$cuantos,$sort){		
		
		if ( !is_null($de) )
			$query = "
				SELECT t2.*
				FROM (
					SELECT ROW_NUMBER() OVER (ORDER BY $sort) AS row, t1.* 
					FROM ($query ) t1
				) t2	
				WHERE t2.row BETWEEN $de + 1 AND $cuantos + $de;";
		
		
		$resultado = sqlsrv_query ( $this->con, $query ) or die ( "Error query array ".$query); 
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, date("Y-m-d h:i:sa").' [EXEC QUERY] ' . $query . PHP_EOL );
		
		if( ($errors = sqlsrv_errors() ) != null) {
			foreach( $errors as $error ) {				
				fwrite ($file, "SQLSTATE: ".$error[ 'SQLSTATE'] . PHP_EOL );
				fwrite ($file, "code: ".$error[ 'code']. PHP_EOL);
				fwrite ($file, "message: ".$error[ 'message']. PHP_EOL);
				
				echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
				echo "code: ".$error[ 'code']."<br />";
				echo "message: ".$error[ 'message']."<br />";
			}
		}
		fclose ( $file );
		
		
		$js = array ();
		
		while ( $fila = sqlsrv_fetch_array ( $resultado,SQLSRV_FETCH_ASSOC ) ) {
					
			array_push ( $js, $fila );
		}
		
		return $js;
	}
	public function getSchema($tableName) {
		$resultado = sqlsrv_query ( $this->con, "SHOW FULL COLUMNS FROM " . $tableName );
		
		$ds = array ();
		$ds ["name"] = "ds" . $tableName;
		$ds ["table"] = array ();
		$ds ["table"] ["nameTable"] = $tableName;
		$ds ["table"] ["type"] = "table";
		$ds ["table"] ["columns"] = array ();
		$ds ["table"] ["rows"] = array ();
		while ( $fila = mysqli_fetch_assoc ( $resultado ) ) {
			$var = array ();
			
			$tam = 0;
			$par1 = strpos ( $fila ["Type"], "(" );
			$par2 = strpos ( $fila ["Type"], ")" );
			
			if ($par1 > 0) {
				$tipo = substr ( $fila ["Type"], 0, $par1 );
				$tam = substr ( $fila ["Type"], $par1 + 1, $par2 - $par1 - 1 );
			} else {
				$tipo = $fila ["Type"];
			}
			
			$var ["name"] = $fila ["Field"];
			$var ["type"] = $tipo;
			$var ["size"] = $tam;
			$var ["isnull"] = $fila ["Null"] == "YES" ? true : false;
			$var ["pk"] = $fila ["Key"] == "PRI" ? true : false;
			$var ["def"] = $fila ["Default"];
			$var ["auto"] = $fila ["Extra"] == "auto_increment" ? true : false;
			$var ["desc"] = $fila ["Comment"];
			
			array_push ( $ds ["table"] ["columns"], $var );
		}
		return $ds;
	}
	public function getDatasetTable($tableName, $dsName) {
		$resultado = sqlsrv_query ( $this->con, "SELECT * FROM sys.columns WHERE object_id = OBJECT_ID('$tableName') " );
		
		$ds = array ();
		$ds ["name"] = $dsName;
		$ds ["table"] = array ();
		$ds ["table"] ["nameTable"] = $tableName;
		$ds ["table"] ["type"] = "table";
		$ds ["table"] ["columns"] = array ();
		$ds ["table"] ["rows"] = array ();
		// $ds ["table"] ["relations"] = array ();
		while ( $fila = mysqli_fetch_assoc ( $resultado ) ) {
			$var = array ();
			
			$tam = 0;
			$par1 = strpos ( $fila ["Type"], "(" );
			$par2 = strpos ( $fila ["Type"], ")" );
			
			if ($par1 > 0) {
				$tipo = substr ( $fila ["Type"], 0, $par1 );
				$tam = substr ( $fila ["Type"], $par1 + 1, $par2 - $par1 - 1 );
			} else {
				$tipo = $fila ["Type"];
			}
			
			$var ["name"] = $fila ["Field"];
			$var ["type"] = $tipo;
			$var ["size"] = $tam;
			$var ["isnull"] = $fila ["Null"] == "YES" ? true : false;
			$var ["pk"] = $fila ["Key"] == "PRI" ? true : false;
			$var ["def"] = $fila ["Default"];
			$var ["auto"] = $fila ["Extra"] == "auto_increment" ? true : false;
			$var ["desc"] = utf8_encode ( $fila ["Comment"] );
			$var ["rel"] = array ();
			
			// $resultado2 = sqlsrv_query ( "SELECT CONSTRAINT_NAME 'name',COLUMN_NAME 'columna',REFERENCED_TABLE_NAME 'tabla',REFERENCED_COLUMN_NAME 'ref' FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA = '".$GLOBALS ["cfg_database"]."' AND `TABLE_NAME` = '" . $tableName . "' AND COLUMN_NAME = '".$var ["name"]."'" );
			$resultado2 = sqlsrv_query ( $this->con, "SELECT CONSTRAINT_NAME 'name',COLUMN_NAME 'columna',REFERENCED_TABLE_NAME 'tabla',REFERENCED_COLUMN_NAME 'ref',`cmb_key`,`cmb_desc` FROM information_schema.KEY_COLUMN_USAGE LEFT JOIN " . $GLOBALS ["cfg_database"] . ".`combobox` ON (combobox.`cmb_tabla` = REFERENCED_TABLE_NAME AND `combobox`.`cmb_key` = REFERENCED_COLUMN_NAME ) WHERE CONSTRAINT_SCHEMA = '" . $GLOBALS ["cfg_database"] . "' AND `TABLE_NAME` = '" . $tableName . "' AND COLUMN_NAME = '" . $var ["name"] . "' AND NOT CONSTRAINT_NAME = 'PRIMARY'" );
			
			while ( $fila2 = mysqli_fetch_row ( $resultado2 ) ) {
				$var2 = array ();
				
				$var2 ["name"] = $fila2 [0];
				$var2 ["columna"] = $fila2 [1];
				$var2 ["table"] = $fila2 [2];
				$var2 ["desc"] = $fila2 [5];
				$var2 ["ref"] = $fila2 [3];
				
				array_push ( $var ["rel"], $var2 );
			}
			
			array_push ( $ds ["table"] ["columns"], $var );
		}
		
		$resultado = sqlsrv_query ( $this->con, "SELECT * FROM " . $tableName . "" );
		
		while ( $fila = mysqli_fetch_row ( $resultado ) ) {
			$var = array ();
			
			$var ["state"] = "nothing";
			$var ["hidden"] = false;
			$var ["data"] = $fila;
			
			array_push ( $ds ["table"] ["rows"], $var );
		}
		
		$resultado = sqlsrv_query ( $this->con, "SELECT CONSTRAINT_NAME 'name',COLUMN_NAME 'columna',REFERENCED_TABLE_NAME 'tabla',REFERENCED_COLUMN_NAME 'ref' FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA = '" . $GLOBALS ["cfg_database"] . "' AND `TABLE_NAME` = '" . $tableName . "'" );
		/*
		 * while ( $fila = mysqli_fetch_row ( $resultado ) ) { $var = array (); $var ["name"] = $fila[0]; $var ["column"] = $fila[1]; $var ["table"] = $fila[2]; $var ["ref"] = $fila[3]; array_push ( $ds ["table"] ["relations"], $var ); }
		 */
		return $ds;
	}
	public function getDatasetTableId($tableName, $dsName, $forKey, $id) {
		$resultado = sqlsrv_query ( "SHOW FULL COLUMNS FROM " . $tableName, $this->con );
		
		$ds = array ();
		$ds ["name"] = $dsName;
		$ds ["table"] = array ();
		$ds ["table"] ["nameTable"] = $tableName;
		$ds ["table"] ["type"] = "table";
		$ds ["table"] ["columns"] = array ();
		$ds ["table"] ["rows"] = array ();
		// $ds ["table"] ["relations"] = array ();
		// $idKey = "ID";
		while ( $fila = mysqli_fetch_assoc ( $resultado ) ) {
			$var = array ();
			
			$tam = 0;
			$par1 = strpos ( $fila ["Type"], "(" );
			$par2 = strpos ( $fila ["Type"], ")" );
			
			if ($par1 > 0) {
				$tipo = substr ( $fila ["Type"], 0, $par1 );
				$tam = substr ( $fila ["Type"], $par1 + 1, $par2 - $par1 - 1 );
			} else {
				$tipo = $fila ["Type"];
			}
			
			$var ["name"] = $fila ["Field"];
			$var ["type"] = $tipo;
			$var ["size"] = $tam;
			$var ["isnull"] = $fila ["Null"] == "YES" ? true : false;
			$var ["pk"] = $fila ["Key"] == "PRI" ? true : false;
			// if ($fila ["Key"] == "PRI") $idKey = $fila ["Field"];
			
			$var ["def"] = $fila ["Default"];
			$var ["auto"] = $fila ["Extra"] == "auto_increment" ? true : false;
			$var ["desc"] = utf8_encode ( $fila ["Comment"] );
			$var ["rel"] = array ();
			
			// $resultado2 = sqlsrv_query ( "SELECT CONSTRAINT_NAME 'name',COLUMN_NAME 'columna',REFERENCED_TABLE_NAME 'tabla',REFERENCED_COLUMN_NAME 'ref' FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA = '".$GLOBALS ["cfg_database"]."' AND `TABLE_NAME` = '" . $tableName . "' AND COLUMN_NAME = '".$var ["name"]."'" );
			$resultado2 = sqlsrv_query ( $this->con, "SELECT CONSTRAINT_NAME 'name',COLUMN_NAME 'columna',REFERENCED_TABLE_NAME 'tabla',REFERENCED_COLUMN_NAME 'ref',`cmb_key`,`cmb_desc` FROM information_schema.KEY_COLUMN_USAGE LEFT JOIN " . $GLOBALS ["cfg_database"] . ".`combobox` ON (combobox.`cmb_tabla` = REFERENCED_TABLE_NAME AND `combobox`.`cmb_key` = REFERENCED_COLUMN_NAME ) WHERE CONSTRAINT_SCHEMA = '" . $GLOBALS ["cfg_database"] . "' AND `TABLE_NAME` = '" . $tableName . "' AND COLUMN_NAME = '" . $var ["name"] . "' AND NOT CONSTRAINT_NAME = 'PRIMARY'" );
			
			while ( $fila2 = mysqli_fetch_row ( $resultado2 ) ) {
				$var2 = array ();
				
				$var2 ["name"] = $fila2 [0];
				$var2 ["columna"] = $fila2 [1];
				$var2 ["table"] = $fila2 [2];
				$var2 ["desc"] = $fila2 [5];
				$var2 ["ref"] = $fila2 [3];
				
				array_push ( $var ["rel"], $var2 );
			}
			
			array_push ( $ds ["table"] ["columns"], $var );
		}
		
		$resultado = sqlsrv_query ( $this->con, "SELECT * FROM " . $tableName . " where $forKey = '$id'" );
		
		while ( $fila = mysqli_fetch_row ( $resultado ) ) {
			$var = array ();
			
			$var ["state"] = "nothing";
			$var ["hidden"] = false;
			$var ["data"] = $fila;
			
			array_push ( $ds ["table"] ["rows"], $var );
		}
		
		$resultado = sqlsrv_query ( $this->con, "SELECT CONSTRAINT_NAME 'name',COLUMN_NAME 'columna',REFERENCED_TABLE_NAME 'tabla',REFERENCED_COLUMN_NAME 'ref' FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA = '" . $GLOBALS ["cfg_database"] . "' AND `TABLE_NAME` = '" . $tableName . "'" );
		
		return $ds;
	}
	public function getDatasetQuery($query, $dsName) {
		$tableName = "empleados";
		$resultado = sqlsrv_query ( $this->con, $query ) or die ( "Error " . mysqli_error ( $this->con ) ); 
		
		$ds = array ();
		$ds ["name"] = "";
		$ds ["table"] = array ();
		$ds ["table"] ["nameTable"] = "";
		$ds ["table"] ["type"] = "query";
		$ds ["table"] ["columns"] = array ();
		$ds ["table"] ["rows"] = array ();
		
		// $numfields = mysqli_num_fields ( $resultado );
		// $arrayFields = array ();
		
		while ( $property = mysqli_fetch_field ( $resultado ) ) {
			// for($i = 0; $i < $numfields; $i ++) {
			// $arrayFields [] = mysqli_field_name ( $resultado, $i );
			$var = array ();
			$var ["name"] = $property->name;
			$var ["type"] = "";
			$var ["size"] = "";
			$var ["isnull"] = "";
			$var ["pk"] = "";
			$var ["def"] = "";
			$var ["auto"] = "";
			$var ["desc"] = $var ["name"];
			
			array_push ( $ds ["table"] ["columns"], $var );
		}
		
		while ( $fila = mysqli_fetch_row ( $resultado ) ) {
			$var = array ();
			$filaR = array ();
			
			$var ["state"] = "nothing";
			$var ["hidden"] = false;
			$var ["data"] = $fila;
			
			array_push ( $ds ["table"] ["rows"], $var );
		}
		
		return $ds;
	}
	
	public function getJsonQuery($query) {
		
		$resultado = sqlsrv_query ( $this->con, $query ) or die( "erro en query" ); 
		$js = array ();
		
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, date("Y-m-d h:i:sa").' [EXEC QUERY] ' . $query . PHP_EOL );
		
		if( ($errors = sqlsrv_errors() ) != null) {
			foreach( $errors as $error ) {				
				fwrite ($file, "SQLSTATE: ".$error[ 'SQLSTATE'] . PHP_EOL );
				fwrite ($file, "SQLSTATE: ".$error[ 'SQLSTATE']. PHP_EOL);
				fwrite ($file, "code: ".$error[ 'code']. PHP_EOL);
				fwrite ($file, "message: ".$error[ 'message']. PHP_EOL);
			}
		}
		fclose ( $file );
		
		while ( $fila = sqlsrv_fetch_array ( $resultado ,SQLSRV_FETCH_ASSOC) ) {
			array_push ( $js, $fila );
		}
		
		return json_encode($js);
	}
}

?>