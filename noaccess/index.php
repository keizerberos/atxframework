<?php if (!isset ( $atx_config )){ $_cf = '/atx-config.php';$c = 0; while(!file_exists($_cf) && $c < 5){ $_cf = "../".$_cf;	$c++; }	if (file_exists($_cf)){ include $_cf; } else {echo "no se ha encontrado el archivo de configuración"; exit();}}	else config_load_ext();	?> 
<body>
	<div class="atx-body" >

		<section class="content">
		  <div class="row">

				<div class="box alert alert-danger">
					<div class="box-body">
						<div>
							<h3>No tiene accesso a este módulo</h3>
						</div><!-- end div-->				
					</div><!-- end box-body-->
				</div><!-- end box-->
			</div><!-- end body-->
			 <!-- Main content -->
			  
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	</div><!-- end atx-body -->	
	
</body>