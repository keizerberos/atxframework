<?php
	$mods = $_SESSION['mod_info'];	
	for ($i=0;$i < count($mods); $i++) if (isset($mods[$i]->path)) if (isset($mods[$i]->core)) include ($_SESSION['dircore']."/modules/".$mods[$i]->path."/".$mods[$i]->core);
	
?>