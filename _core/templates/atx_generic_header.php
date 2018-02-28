	
<head>
	<?php	//PRE PHP
		$_SESSION['load_file'] = "atx_generic_header";
	
		$mods = $_SESSION['mod_info'];
		for ($i=0;$i < count($mods); $i++) if (isset($mods[$i]->path)) if (isset($mods[$i]->prePHP)) include ($_SESSION['dircore']."/modules/".$mods[$i]->path."/".$mods[$i]->prePHP);
	?>
	<title class="atx-title"><?php echo $atx_config['title']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
	<meta charset="iso-8859-1">
	
<!--	<link href="<?php echo $atx_config['pathcore']; ?>/css/bootstrap.css" type="text/css" rel="stylesheet" />	
	<link href="<?php echo $atx_config['pathcore']; ?>/css/core.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo $atx_config['pathcore']; ?>/addons/fa/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
 -->
    <link href="<?php echo $atx_config['pathcore']; ?>/addons/fa/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $atx_config['pathcore']; ?>/lte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> -->
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
    <link rel="stylesheet" href="<?php echo $atx_config['pathcore']; ?>/addons/ionicons-2.0.1/css/ionicons.min.css" >
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $atx_config['pathcore']; ?>/lte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo $atx_config['pathcore']; ?>/lte/dist/css/skins/_all-skins.min.css">
    
    <!-- datatables -->
    <link rel="stylesheet" href="<?php echo $atx_config['pathcore']; ?>/lte/plugins/datatables/dataTables.bootstrap.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo $atx_config['pathcore']; ?>/lte/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo $atx_config['pathcore']; ?>/lte/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo $atx_config['pathcore']; ?>/lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo $atx_config['pathcore']; ?>/lte/plugins/datepicker/datepicker3.css">
    
    <link rel="stylesheet" href="<?php echo $atx_config['pathcore']; ?>/lte/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo $atx_config['pathcore']; ?>/lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    
    <link rel="stylesheet" type="text/css" href="style.css">
	<!-- <link rel="shortcut icon" href="/favicon.ico"> -->
	
	<script src="<?php echo $atx_config['pathcore']; ?>/js/angular.js" type="text/javascript"></script>
<!-- <script src="<?php echo $atx_config['pathcore']; ?>/js/jquery-2.2.4.min.js" type="text/javascript"></script> -->
	<script src="<?php echo $atx_config['pathcore']; ?>/js/tether.min.js" type="text/javascript"></script>
<!-- <script src="<?php echo $atx_config['pathcore']; ?>/js/bootstrap.js" type="text/javascript"></script> -->

	<script src="<?php echo $atx_config['pathcore']; ?>/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo $atx_config['pathcore']; ?>/lte/bootstrap/js/bootstrap.min.js"></script>
	<!-- DataTables -->
	<script src="<?php echo $atx_config['pathcore']; ?>/lte/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo $atx_config['pathcore']; ?>/lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<!-- SlimScroll -->
	
	<script src="<?php echo $atx_config['pathcore']; ?>/lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo $atx_config['pathcore']; ?>/lte/plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo $atx_config['pathcore']; ?>/lte/dist/js/app.min.js"></script>

	<script > 
	
	</script>
</head>
