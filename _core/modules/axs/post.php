<?php

	$tipo = $_SESSION['load_file'];
	if ($tipo == "atx_generic_sidebar"){
		
		//if ($_SESSION['axs_logeado']){
			if (isset($_SESSION['form_name']))
				if ($_SESSION['form_name'] == "login")
					echo "<script>document.getElementsByClassName('wrapper')[0].innerHTML  = ''; </script>";
					
		//}
	}
?>