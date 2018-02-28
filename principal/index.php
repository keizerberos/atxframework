<?php if (!isset ( $atx_config )){ $_cf = '/atx-config.php';$c = 0; while(!file_exists($_cf) && $c < 5){ $_cf = "../".$_cf;	$c++; }	if (file_exists($_cf)){ include $_cf; } else {echo "no se ha encontrado el archivo de configuración"; exit();}}	else config_load_ext();	?> 
<body >
	<div class="atx-body " >
	 <section class="content-header">
      <h1>Bienvenido <small> PANEL PRINCIPAL</small>
      </h1>
    </section>
		<div class="box row text-center">
			<div class="col-xs-3">
				<img src="img/logo4.png">
			</div>                    
			<div class="col-xs-9 text-left">
				<h1>Sistema de Facturación</h1>
				<ul>
					<li>Versión 1.1.5
						<ul>
							<li>Sistema de autenticación implementado</li>
							<li>Motor de consultas</li>
							<li>Extensión Logger implementado</li>
							<li>Gestor de módulos coregido</li>
						</ul>
					</li>
					<li>Versión 1.1.6
						<ul>
							<li>Implementado Modulo extendido para el control de iconos de navegador <strong>Module ProfilerCtrl 1.0.0</strong></li>
						</ul>
					</li>
					<li>Versión 1.1.9
						<ul>
							<li>Adición del _main, core que ayuda a trabajar las modulos asociados, junto al  <strong>preLoader y postLoader</strong></li>
						</ul>
					</li>
				</ul>
			</div>                    
		</div>
		<section class="content ">
      <!-- Small boxes (Stat box) -->
      <div class="row ">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

    </section>

	</div><!-- end atx-body -->	
	
</body>
<script>
$(document).ready(function (){
		profilerMain.changeUserName(getCookie("user_name"));
	
});
</script>