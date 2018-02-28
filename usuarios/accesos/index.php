<?php if (!isset ( $atx_config )){ $_cf = '/atx-config.php';$c = 0; while(!file_exists($_cf) && $c < 5){ $_cf = "../".$_cf;	$c++; }	if (file_exists($_cf)){ include $_cf; } else {echo "no se ha encontrado el archivo de configuración"; exit();}}	else config_load_ext();	?> 
<body>

	<div class="atx-body container " ng-app="appAccesos" ng-controller="myCtrl" >		
	
		<section class="content">
		  <div class="row">

				<div class="box ">
					<div class="box-body">
						<div>
							<form name="formAccesos">
							<table  style="width:100%" class="table table-bordered table-striped table-condensed">
								<thead>
									<tr >
										<th class="text-center">Módulo</th>
										<th class="text-center">Descripcion</th>
										<th class="text-center">Acceso</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="(k, x) in datos">
										<td class="text-center">{{ x.modulo }}</td>
										<td class="text-left">{{ x.descripcion }}</td>
										<td class="text-center">   
											<input type="checkbox" atx-cod-mod="{{x.cod_modulo}}" value="{{ x.cod_acceso }}" name="inpCheck" ng-model="inpCheck[k]" ng-checked="x.acceso==1?true:false"></input>
										</td>
									</tr>
								</tbody>
							</table>
						</form>
						</div><!-- end div-->				
					</div><!-- end box-body-->
				</div><!-- end box-->
			</div><!-- end body-->
			 <!-- Main content -->
		  <!-- /.row -->
		</section>
	
		<div class="btn center-block vertical-center " >
			<button id="btnSave" name="btnSave" ng-model="btnSave" ng-disabled="" ng-click="guardar()" class="btn btn-primary ">Guardar</button>
			<button id="btnVolver" name="btnVolver" ng-model="btnVolver" ng-click="volver()"  class="btn btn-default ">Volver</button>
		</div>
		
			
	</div>	
	<div class="atx-foot">
	</div>
</body>
<script>
	
</script>