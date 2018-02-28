<?php

/* ParamsSQL es para formatear los parámetros de sql*/
/* version 1.0.2*/
/*  -Corregido SetNumber comillas*/
/*  -Añadido addNumber */

	class ParamsSQL{
		var $insert_values = array();
		var $update_values = array();
		var $formatted_fields;
		var $formatted_insert;
		var $formatted_update;
		var $formatted_conditions;
		var $fields = array();
		var $conditions = array();
		var $errors = array();
		var $error = false;
		function setNumber0($field,$value){
			array_push($this->fields,$field);
			array_push($this->insert_values," ".$value." ");
			array_push($this->update_values," ".$field." = ".$value." ");
			$this->formattedStrings();
		}
		function setNumber($field,$value){
			$e = false;			
			for ($i = 0; $i < count($this->fields); $i++){
				if ($field == $this->fields[$i]){
					$e = true;
					return;
				}
			}
			if (!$e){
				array_push($this->fields,$field);
				array_push($this->insert_values," ".$value." ");
				array_push($this->update_values," ".$field." = ".$value." ");
			}
			$this->formattedStrings();
		}
		function setString($field,$value){
			array_push($this->fields,$field);
			array_push($this->insert_values,"'".$value."'");
			array_push($this->update_values," ".$field." = '".$value."' ");
			$this->formattedStrings();
		}
		function setBoolean($field,$value){
			array_push($this->fields,$field);
			if ($value == 1) $value = "true";
			if ($value == 0) $value = "false";
			array_push($this->insert_values,$value);
			array_push($this->update_values," ".$field." = ".$value." ");
			$this->formattedStrings();
		}
		function setDate($field,$value){
			array_push($this->fields,$field);
			array_push($this->insert_values,"'".$value."'");
			array_push($this->update_values," ".$field." = '".$value."' ");
			$this->formattedStrings();
		}
		function setCondition($value){
			array_push($this->conditions,$value);
			$this->formatted_conditions = join($this->conditions," AND ");
		}
		function formattedStrings(){
			$this->formatted_fields = join($this->fields,",");
			$this->formatted_insert = join($this->insert_values,",");
			$this->formatted_update = join($this->update_values,",");
		}
	}

?>