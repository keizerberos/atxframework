<?php if (!isset ( $atx_config )){ $_cf = '/atx-config.php';$c = 0; while(!file_exists($_cf) && $c < 5){ $_cf = "../".$_cf;	$c++; }	if (file_exists($_cf)){ include $_cf; } else {echo "no se ha encontrado el archivo de configuración"; exit();}}	else config_load_ext();	?> 
<body>
	<div class="atx-body container " >
		<div class="row">

			<div ng-app="appUsuarios" ng-controller="myCtrl">

				<section class="content-header">
					<h3>Usuarios <small>Búsqueda Principal</small></h3>
					<ol class="breadcrumb">
						<li><a href="<?php echo $atx_config['path']; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>                    
						<li class="active"><i class="fa fa-desktop"></i> Usuarios </li>
					</ol>
				</section>
			
				
				<div class="col-lg-3">
					<a href="agregar/"><button class="btn btn-success" id="btnTest"> <i class="fa fa-save"></i> Nuevo </button></a> 
				</div>
				<div >
					<table  style="width:100%" class="table table-bordered table-striped table-condensed">
						<thead>
							<tr >
								<th class="text-center">id</th>
								<th class="text-center">nombre</th>
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
									<a ng-show="true" data-toggle="tooltip" data-placement="top" title="" class="btn btn-xs btn-info" href="<?php echo $atx_config['path']; ?>usuarios/accesos/?cod={{ x.cod }}" data-original-title="Agregar Dependientes"><i class="fa fa-key"></i> </a> 
									<a ng-show="false" class="btn btn-xs btn-danger ng-hide">Pasivo</a>
								</td>
							</tr>
						</tbody>
					</table>
					<table style="display:block">					
						<tbody>
							<tr>
								<th class="text-center" ng-repeat="x in pager">
									<a  href="#" class="btn" ng-click="cambiarPagina($event)"> {{ x.p +1 }} </a>
								</th>
							</tr>
						</tbody>
					</table>
				</div>				
			</div>
		</div>
	</div>
</body>
<script>
	var app = angular.module('appUsuarios', []);
		app.controller('myCtrl', function($scope) {
			$scope.page = typeof params['p'] == 'undefined'?0: params['p'];
			$scope.count = typeof params['c'] == 'undefined'?10: params['c'];
			$scope.pager = [];
						
			controlador("getUsuariosJsx",{p:$scope.page,c:$scope.count},function (r){ 	
				var dat = JSON.parse(r);
				console.log(dat);
				
				for (var i = 0 ; i < dat.count; i++ )
					$scope.pager.push({c:$scope.count,p:i});
				
				$scope.datos = dat.data;
				
				$scope.$apply();
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