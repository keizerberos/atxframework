<?php 
	class Tableset extends SQLSERVER{		
		function __construct() {
			parent::SQLSERVER($_SESSION['db_default']);
		}
	}
?>