<?php 
	class Tableset extends MYSQL{
		function __construct() {
			parent::MYSQL($_SESSION['db_default']);
		}
	}
?>