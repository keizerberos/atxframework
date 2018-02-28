<?php if (!isset ( $atx_config )){ $_cf = '/atx-config.php';$c = 0; while(!file_exists($_cf) && $c < 5){ $_cf = "../".$_cf;	$c++; }	if (file_exists($_cf)){ include $_cf; } else {echo "no se ha encontrado el archivo de configuración"; exit();}}	else config_load_ext();	?> 
<body>
	<div class="atx-body" >
	 <section class="content-header">
		  <h1>
			Administración
			<small>Usuario</small>
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li><a href="#">Administración</a></li>
			<li class="active">Usuarios</li>
		  </ol>
		</section>

		<section class="content">
		  <div class="row">
			<div class="col-xs-12">
			<div ng-app="appUsuarios" ng-controller="myCtrl">

				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Usuarios</h3>
					</div>
					<div class="box-body">
						<section class="content-header">
						</section>
						<div>
							<table id="tabla1" style="width:100%" class="table table-bordered table-hover dataTable">
								<thead>
									<tr>
										<th class="text-center">Id</th>
										<th class="text-center">Nombre</th>
										<th class="text-center">Usuario</th>
										<th class="text-center">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="x in datos">
										<td class="text-center">{{ (page)*count + $index + 1 }}</td>
										<td class="text-center">{{ x.nombre }}</td>
										<td class="text-center">{{ x.usuario }}</td>
										<td class="text-center">   
											<a ng-show="true" class="btn btn-xs btn-success">Activo</a>
											<a data-toggle="tooltip" data-placement="top" title="" class="btn btn-xs btn-danger" ng-click="eliminar(datos, $index)" data-original-title="Eliminar"><i class="fa fa-times"></i></a> 
											<a data-toggle="tooltip" data-placement="top"  title="" class="btn btn-xs btn-warning" href="<?php echo $atx_config['path']; ?>usuarios/editar/?cod={{ x.cod }}" data-original-title="Editar"><i class="fa fa-edit"></i> </a> 
											<a ng-show="true" data-toggle="tooltip" data-placement="top" title="" class="btn btn-xs btn-info" href="<?php echo $atx_config['path']; ?>usuarios/accesos/?cod={{ x.cod }}" data-original-title="Agregar Accesos"><i class="fa fa-key"></i> </a> 
											<a ng-show="false" class="btn btn-xs btn-danger ng-hide">Pasivo</a>
										</td>
									</tr>
								</tbody>
							</table><!-- end #tabla1-->
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
<script>


	var app = angular.module('appUsuarios', []);
		app.controller('myCtrl', function($scope) {
			$scope.page = typeof params['p'] == 'undefined'?0: params['p'];
			$scope.count = typeof params['c'] == 'undefined'?10: params['c'];
			$scope.pager = [];
						
			controlador("getUsuariosJsx",{p:$scope.page,c:$scope.count},function (r){ 	
				console.log(r);
				var dat = JSON.parse(r);
				console.log(dat);
				
				for (var i = 0 ; i < dat.count; i++ )
					$scope.pager.push({c:$scope.count,p:i});
				
				$scope.datos = dat.data;
				
				$scope.$apply();
				$("#tabla1").DataTable({
					language: {
						processing:     "Procesando...",
						search:         "Buscar",
						lengthMenu:     "Mostrando _MENU_ entradas",
						info:           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
						infoEmpty:      "Mostrando 0 a 0 de 0 entradas",
						infoFiltered:   "(filtrado de _MAX_ entradas totales)",
						infoPostFix:    "",
						loadingRecords: "Cargando...",
						zeroRecords:    "No registros para mostrar",
						emptyTable:     "No hay datos en la table",
						paginate: {
							first:      "Primer",
							previous:   "Anterior",
							next:       "Siguiente",
							last:       "Ultimo"
						},
						aria: {
							sortAscending:  ": activar para ordenar la columna en ascendente",
							sortDescending: ": activar para ordenar la columna en descendente"
						}
					},
				  "paging": true,
				  "lengthChange": true,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": true,
				  "lengthMenu": [15,20,50]
				});
			});
			
			$scope.cambiarPagina = function(event){
				console.log(event);
				console.log("event.target.innerHtml: " , event.target.innerHtml);
				$scope.page = parseInt(event.target.text)-1;
				window.history.pushState ({"html":"","pageTitle":""},"","?"+StringQuery({c:$scope.count,p:$scope.page}));	
				$scope.pager = [];
							
				controlador("getUsuariosJsx",{p:$scope.page,c:$scope.count},function (r){ 	
					var dat = JSON.parse(r);
					console.log(dat);
					
					for (var i = 0 ; i < dat.count; i++ )
						$scope.pager.push({c:$scope.count,p:i});
					
					$scope.datos = dat.data;					
					$scope.$apply();
				});
				
			};
			
			$scope.eliminar = function (datos,index){
				console.log(index);
				confirm("Mensaje de Sistema", "¿Desea eliminar el registro?", "Cancelar", "Aceptar", function (){
					controlador("delUsuario",{cod:$scope.datos[index].cod},function (r){ 	
						$scope.pager = [];
						controlador("getUsuariosJsx",{p:$scope.page,c:$scope.count},function (r){ 	
							var dat = JSON.parse(r);
							console.log(dat);
							
							for (var i = 0 ; i < dat.count; i++ )
								$scope.pager.push({c:$scope.count,p:i});
							
							$scope.datos = dat.data;							
							$scope.$apply();
						});					
					});			
				});
			};
		});
</script>