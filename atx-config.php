<?php
/******************** 0.4.0 ********************/
/*****************CONFIGURATION*****************/
    
$atx_config['path'] = "http://".$_SERVER['HTTP_HOST']."/atx/";  
//$atx_config['path'] = "http://localhost:8080/javabridge/atx";
//$atx_config['path'] = "http://192.168.0.7:6060/radix";
$atx_config['title'] = "Engine 1.1.8" ;
$atx_config['title-a'] = "Engine" ;
$atx_config['title-b'] = " 1.1.9" ;
$atx_config['version'] = "1.1.9" ;
$atx_config['title-mini-a'] = "At";
$atx_config['title-mini-b'] = "X";
$atx_config['modules'] = ['log','axs','mnu','prof'];		//	Agregar carpetas en addons

$atx_config['db'] = array();
$atx_config['db'][0] = array (
	'type' => 'mysql',
	'server' => '127.0.0.1',
	'user' => 'root',
	'pass' => '12345',
	'db' => 'slimpy',
	'port' => '3306',
	'default' => 'true'
);

function getLastPathSegment($url) {
    $path = parse_url($url, PHP_URL_PATH); // to get the path from a whole URL
    $pathTrimmed = trim($path, '/'); // normalise with no leading or trailing slash
    $pathTokens = explode('/', $pathTrimmed); // get segments delimited by a slash

    if (substr($path, -1) !== '/') {
        array_pop($pathTokens);
    }
    return end($pathTokens); // get the last segment
}

/******************DON'T CHANGE*****************/

session_start(); 
$atx_config['pathcore'] = $atx_config['path']."/_core" ;   
$_SESSION['path'] = $atx_config['path'];
$_SESSION['dir'] = __DIR__;
$_SESSION['dircore'] = __DIR__."/_core";
$_SESSION['atx_db_core'] = __DIR__."/_core/databases";
$_SESSION['atx_databases'] = __DIR__."/_core/includes/databases.php";
$_SESSION['atx_includes'] = __DIR__."/_core/includes/includes.php";
$_SESSION['pathcore'] = $atx_config['pathcore'];
$_SESSION['title'] = $atx_config['title'];
$_SESSION['version'] = $atx_config['version'];
$_SESSION['db'] = $atx_config['db'];
$_SESSION['form_name'] = getLastPathSegment($_SERVER['REQUEST_URI']);
$atx_config['atx_db_core'] = $_SESSION['atx_db_core'] ; 
$atx_config['atx_databases'] = $_SESSION['atx_databases'] ; 
if (!isset($_SESSION['last_page'])) $_SESSION['last_page'] = $_SESSION['path']."principal";

//$_SESSION['atx_includes'] = __DIR__."/_core/includes/core.php";;

	
function config_load_modules($atx_config){
	$mods = [];
	for ($i = 0 ; $i < count($atx_config['modules']); $i++){
		$data = file_get_contents (__DIR__."/_core/modules/".$atx_config['modules'][$i]."/config.js");
        $json = json_decode($data);		
		$json->path = $atx_config['modules'][$i];
		//array_push($mods,$data);	
		array_push($mods,$json);
	}
	return $mods;
}


$atx_config['mod_info'] = config_load_modules($atx_config);

$mods = $_SESSION['mod_info'];
	for ($i=0;$i < count($mods); $i++) if (isset($mods[$i]->path)) if (isset($mods[$i]->core)) include ($_SESSION['dircore']."/modules/".$mods[$i]->path."/".$mods[$i]->core);




$_SESSION['mod_info'] = $atx_config['mod_info'];

echo '<script type="text/javascript">var atx_config = '.json_encode($atx_config).';console.log(atx_config);</script>';
echo "<script type='text/javascript' src='".$atx_config['path'] ."/data.js'></script>";

function config_load_head($atx_config){
	include __DIR__."/_core/templates/atx_generic_header.php";	
}	

function config_load_ext($atx_config){
	include __DIR__."/_core/templates/atx_generic_ext.php";	
}

function config_load_sidebar($atx_config){
	include __DIR__."/_core/templates/atx_generic_sidebar.php";	
}

function config_load_footer($atx_config){
	include __DIR__."/_core/templates/atx_generic_footer.php";	
}

config_load_head($atx_config);
config_load_sidebar($atx_config);
//config_load_ext($atx_config);
config_load_footer($atx_config);

//$_SESSION['atx_last_page'] = $_SERVER['REQUEST_URI']; 
?>