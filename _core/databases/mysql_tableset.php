<?php
//header('Content-Type: text/html;charset=ISO-8859-1');
//ini_set("log_errors", 1);

class MYSQL {
	var $con;
	var $nombreTabla;
	public function MYSQL($opt) {
		$this->con = mysqli_connect ( $opt ["server"], $opt ["user"], $opt ["pass"], $opt ["db"] ) or die ( "No se pudo conectar: " . mysqli_error ( $this->con ) );
		// mysqli_select_db ( $GLOBALS ["cfg_database"], $this->con );
		
		mysqli_query($this->con,"SET CHARACTER SET utf8");
		date_default_timezone_set('America/La_Paz');
	}
	public function insertar($fields, $values, $tabla) {
		$file = fopen ( "log.txt", "a" );		
		fwrite ( $file, date("Y-m-d h:i:sa").' [TRY QUERY] ' . "insert into " . $tabla . " ($fields) values ($values)" . PHP_EOL );
		fclose ( $file );
		
		$result = mysqli_query ( $this->con, "insert into " . $tabla . " ($fields) values ($values)" );
		$id = mysqli_insert_id ( $this->con );
		
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, date("Y-m-d h:i:sa").' [ID QUERY] ' . $id . PHP_EOL );
		fclose ( $file );
		
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, date("Y-m-d h:i:sa").' [ERROR] '. mysqli_error ( $this->con ) . PHP_EOL );
		fclose ( $file );
		
		echo  mysqli_error ( $this->con );
		
		return $id;
	}
	public function insertarArg($params, $tabla) {
		$fields = $params->formatted_fields;
		$values = $params->formatted_insert;
		
		$file = fopen ( "log.txt", "a" );		
		fwrite ( $file, date("Y-m-d h:i:sa").' [TRY QUERY] ' . "insert into " . $tabla . " ($fields) values ($values)" . PHP_EOL );
		fclose ( $file );
		
		$result = mysqli_query ( $this->con, "insert into " . $tabla . " ($fields) values ($values)" );
		$id = mysqli_insert_id ( $this->con );
		
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, date("Y-m-d h:i:sa").' [ID QUERY] ' . $id . PHP_EOL );
		fwrite ( $file, date("Y-m-d h:i:sa").' [ERROR] '. mysqli_error ( $this->con ) . PHP_EOL );
		fclose ( $file );
		
		echo  mysqli_error ( $this->con );
		
		return $id;
	}
	public function actualizar($fields, $values, $tabla, $condition) {
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file,  date("Y-m-d h:i:sa").' [TRY QUERY] ' . "update " . $tabla . "SET ($fields) WHERE ($condition)" . PHP_EOL );
		fclose ( $file );
		
		$result = mysqli_query ( $this->con, "update " . $tabla . "SET ($fields) WHERE ($condition)" );
		$id = mysqli_insert_id ( $this->con );
		
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file,  date("Y-m-d h:i:sa").' [ID QUERY] ' . $id . PHP_EOL );
		fwrite ( $file,  date("Y-m-d h:i:sa").mysqli_error ( $this->con ) . PHP_EOL );
		fclose ( $file );
		
		return $id;
	}
	public function actualizarArg($params, $tabla) {
		$fields = $params->formatted_fields;
		$values = $params->formatted_update;
		$condition = $params->formatted_conditions;
		
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, date("Y-m-d h:i:sa").'[TRY QUERY] ' . "update " . $tabla . " SET $values WHERE $condition" . PHP_EOL );
		fclose ( $file );
		
		$result = mysqli_query ( $this->con, "update " . $tabla . " SET $values WHERE $condition" );
		$id = mysqli_insert_id ( $this->con );
		
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, '[ID QUERY] ' . $id . PHP_EOL );
		fwrite ( $file, mysqli_error ( $this->con ) . PHP_EOL );
		fclose ( $file );
		
		return $id;
	}
	public function executeQuery($query) {
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, date("Y-m-d h:i:sa").' [EXEC QUERY] ' . $query . PHP_EOL );
		fclose ( $file );
		
		$result = mysqli_query ( $this->con, $query );
		$id = mysqli_insert_id ( $this->con );
		
		return $id;
	}
	public function getScalar($query) {
		$file = fopen ( "log.txt", "a" );
		fwrite ( $file, date("Y-m-d h:i:sa").' [EXEC QUERY] ' . $query . PHP_EOL );
		fclose ( $file );
		
		$result = mysqli_query ( $this->con, $query );
		$value = mysqli_fetch_array ( $result, MYSQLI_NUM );
		return $value [0];
	}
	public function getSchema($tableName) {
		$resultado = mysqli_query ( $this->con, "SHOW FULL COLUMNS FROM " . $tableName );
		
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
		$resultado = mysqli_query ( $this->con, "SHOW FULL COLUMNS FROM " . $tableName );
		
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
			
			
			// $resultado2 = mysqli_query ( "SELECT CONSTRAINT_NAME 'name',COLUMN_NAME 'columna',REFERENCED_TABLE_NAME 'tabla',REFERENCED_COLUMN_NAME 'ref' FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA = '".$GLOBALS ["cfg_database"]."' AND `TABLE_NAME` = '" . $tableName . "' AND COLUMN_NAME = '".$var ["name"]."'" );
			$resultado2 = mysqli_query ( $this->con, "SELECT CONSTRAINT_NAME 'name',COLUMN_NAME 'columna',REFERENCED_TABLE_NAME 'tabla',REFERENCED_COLUMN_NAME 'ref',`cmb_key`,`cmb_desc` FROM information_schema.KEY_COLUMN_USAGE LEFT JOIN " . $GLOBALS ["cfg_database"] . ".`combobox` ON (combobox.`cmb_tabla` = REFERENCED_TABLE_NAME AND `combobox`.`cmb_key` = REFERENCED_COLUMN_NAME ) WHERE CONSTRAINT_SCHEMA = '" . $GLOBALS ["cfg_database"] . "' AND `TABLE_NAME` = '" . $tableName . "' AND COLUMN_NAME = '" . $var ["name"] . "' AND NOT CONSTRAINT_NAME = 'PRIMARY'" );
			
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
		
		$resultado = mysqli_query ( $this->con, "SELECT * FROM " . $tableName . "" );
		
		while ( $fila = mysqli_fetch_row ( $resultado ) ) {
			$var = array ();
			
			$var ["state"] = "nothing";
			$var ["hidden"] = false;
			$var ["data"] = $fila;
			
			array_push ( $ds ["table"] ["rows"], $var );
		}
		
		$resultado = mysqli_query ( $this->con, "SELECT CONSTRAINT_NAME 'name',COLUMN_NAME 'columna',REFERENCED_TABLE_NAME 'tabla',REFERENCED_COLUMN_NAME 'ref' FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA = '" . $GLOBALS ["cfg_database"] . "' AND `TABLE_NAME` = '" . $tableName . "'" );
		/*
		 * while ( $fila = mysqli_fetch_row ( $resultado ) ) { $var = array (); $var ["name"] = $fila[0]; $var ["column"] = $fila[1]; $var ["table"] = $fila[2]; $var ["ref"] = $fila[3]; array_push ( $ds ["table"] ["relations"], $var ); }
		 */
		return $ds;
	}
	public function getDatasetTableId($tableName, $dsName, $forKey, $id) {
		$resultado = mysqli_query ( "SHOW FULL COLUMNS FROM " . $tableName, $this->con );
		
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
			
			// $resultado2 = mysqli_query ( "SELECT CONSTRAINT_NAME 'name',COLUMN_NAME 'columna',REFERENCED_TABLE_NAME 'tabla',REFERENCED_COLUMN_NAME 'ref' FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA = '".$GLOBALS ["cfg_database"]."' AND `TABLE_NAME` = '" . $tableName . "' AND COLUMN_NAME = '".$var ["name"]."'" );
			$resultado2 = mysqli_query ( $this->con, "SELECT CONSTRAINT_NAME 'name',COLUMN_NAME 'columna',REFERENCED_TABLE_NAME 'tabla',REFERENCED_COLUMN_NAME 'ref',`cmb_key`,`cmb_desc` FROM information_schema.KEY_COLUMN_USAGE LEFT JOIN " . $GLOBALS ["cfg_database"] . ".`combobox` ON (combobox.`cmb_tabla` = REFERENCED_TABLE_NAME AND `combobox`.`cmb_key` = REFERENCED_COLUMN_NAME ) WHERE CONSTRAINT_SCHEMA = '" . $GLOBALS ["cfg_database"] . "' AND `TABLE_NAME` = '" . $tableName . "' AND COLUMN_NAME = '" . $var ["name"] . "' AND NOT CONSTRAINT_NAME = 'PRIMARY'" );
			
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
		
		$resultado = mysqli_query ( $this->con, "SELECT * FROM " . $tableName . " where $forKey = '$id'" );
		
		while ( $fila = mysqli_fetch_row ( $resultado ) ) {
			$var = array ();
			
			$var ["state"] = "nothing";
			$var ["hidden"] = false;
			$var ["data"] = $fila;
			
			array_push ( $ds ["table"] ["rows"], $var );
		}
		
		$resultado = mysqli_query ( $this->con, "SELECT CONSTRAINT_NAME 'name',COLUMN_NAME 'columna',REFERENCED_TABLE_NAME 'tabla',REFERENCED_COLUMN_NAME 'ref' FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA = '" . $GLOBALS ["cfg_database"] . "' AND `TABLE_NAME` = '" . $tableName . "'" );
		
		return $ds;
	}
	public function getDatasetQuery($query, $dsName) {
		$tableName = "empleados";
		$resultado = mysqli_query ( $this->con, $query ) or die ( "Error " . mysqli_error ( $this->con ) ); 
		
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
		$tableName = "empleados";
		$resultado = mysqli_query ( $this->con, $query ) or die ( "Error " . mysqli_error ( $this->con ) ); 
		
		$js = array ();
		
		while ( $fila = mysqli_fetch_array ( $resultado ) ) {
					
			array_push ( $js, $fila );
		}
		
		return json_encode($js);
	}
	
	public function getArrayQuery($query,$de,$count,$sort) {
		
		if (is_null($de))
			$resultado = mysqli_query ( $this->con, $query ) or die ( "Error " . mysqli_error ( $this->con ) ); 
		else
			$resultado = mysqli_query ( $this->con , $query . " limit $de,$count") or die ( "Error " . mysqli_error ( $this->con ) ); 
	
		$file = fopen ( "log.txt", "a" );		
		fwrite ( $file, date("Y-m-d h:i:sa").' [TRY QUERY] ' . $query . PHP_EOL );
		fclose ( $file );
		
		$js = array ();
		
		while ( $fila = mysqli_fetch_array ( $resultado, MYSQLI_ASSOC ) ) {
					
			array_push ( $js, $fila );
		}
		
		return $js;
	}
	
	public function getArrayQueryOk($query) {
		
		$resultado = mysqli_query ( $this->con, $query ) or die ( "Error " . mysqli_error ( $this->con ) ); 
		
		$js = array ();
		
		while ( $fila = mysqli_fetch_array ( $resultado ) ) {
					
			array_push ( $js, $fila );
		}
		
		return $js;
	}
}

?>