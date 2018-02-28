<?php 
	class Tableset extends POSTGRESQL{		
		function __construct() {
			parent::POSTGRESQL($_SESSION['db_default']);
		}
	}
?>