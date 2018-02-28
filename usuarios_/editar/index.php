<?php if (!isset ( $atx_config )){ $_cf = '/atx-config.php';$c = 0; while(!file_exists($_cf) && $c < 5){ $_cf = "../".$_cf;	$c++; }	if (file_exists($_cf)){ include $_cf; } else {echo "no se ha encontrado el archivo de configuración"; exit();}}	else config_load_ext();	?> 
<body>

	<div class="atx-body container " ng-app="appUsuarios" ng-controller="myCtrl" >
		<section class="content-header">
			<h3>Mantenimiento de Equipos  <small>Búsqueda Principal</small></h3>
			<ol class="breadcrumb">
				<li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>                    
				<li class="active"><i class="fa fa-desktop"></i> Mantenimiento de Equipos </li>
			</ol>
		</section>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">

					<div class="box-header">
						<h3 class="box-title">Detalle de asignación de Equipo</h3>
						<div class="row pv10"> 
							<form name="userForm" ng-submit="guardar()" novalidate >
								<div class="col-lg-6">
									<div class="form-group">
										<label>Nombre:</label>
										<input type="text" ng-minlength="3" ng-maxlength="20" id="nombre" name="nombre" ng-model="nombre" class="form-control" placeholder="Ingrese su nombre de usuario ..." required >
										<span class="atx-invalid" ng-show="userForm.nombre.$touched && userForm.nombre.$invalid">El nombre debe tener entre 3 a 20 caracteres </span>
									</div>  
								</div> 
								<div class="col-lg-6">
									<div class="form-group">
										<label>Usuario:</label>
										<input type="text" ng-minlength="3" ng-maxlength="20" id="usuario" name="usuario" ng-model="usuario" class="form-control" placeholder="Ingrese su usuario ..." required >
									</div>  
								</div> 
								
								<div class="col-lg-3">
									<div class="form-group">
										<label>Contraseña:</label>
										<input type="password" name="clave" id="clave" ng-minlength="2" ng-maxlength="20" ng-model="clave" class="form-control" placeholder="Ingrese su clave..." required >
									</div>  
								</div>
								
								<div class="col-lg-3">
									<div class="form-group">
										<label>Confirmar:</label>
										<input type="password" name="clave2" id="clave2" ng-model="clave2" class="form-control" placeholder="Repita su clave ..." required >
										<span class="atx-invalid" ng-show="!validar()">las contraseñas deben ser las mismas</span>
									</div>  
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="atx-foot">
			<div class="btn center-block vertical-center " >
				<button id="singlebutton" name="singlebutton" ng-model="singlebutton" ng-disabled="!validarTodo()"  ng-click="guardar()" class="btn btn-primary ">Guardar</button>
				<button id="btnVolver" name="btnVolver" ng-model="btnVolver" ng-click="volver()"  class="btn btn-default ">Volver</button>
			</div>
		</div>
	</div>	
</body>
<script>
	
app.controller('myCtrl', function($scope) {
	$scope.nombre = params['n'];
	$scope.usuario = params['n'];
	$scope.clave = params['c'];
	console.log(params);
	$scope.guardar = function() {
            if ($scope.userForm.$valid) {
                //alert('our form is amazing');
				console.log("guardando");
				controlador("updUsuario",{nombre:$scope.nombre,usuario:$scope.usuario,clave:$scope.clave,cod:params['cod']},function (r){ console.log("respuesta:",r); window.history.back();  });	
				
            }
        };
	$scope.volver = function (){
		window.history.back();
	};
		
	$scope.validar = function () {
		return ($scope.clave == $scope.clave2);
	};
	$scope.validarTodo = function () {
		return ($scope.validar() && $scope.nombre != undefined && $scope.clave != undefined  && $scope.clave2 != undefined);
	};
	
	controlador("getUsuario",params,function (r){ 
		console.log("respuesta getUsuario():",r); 
		r = JSON.parse(r);
		/*$("[name=nombre]").val(r[0].us_usuario);
		$("[name=clave]").val(r[0].us_clave);
		$("[name=clave2]").val(r[0].us_clave);*/
		$scope.nombre = r[0].nombre;
		$scope.usuario = r[0].usuario;
		$scope.clave = r[0].clave;
		$scope.clave2 = r[0].clave;
		$scope.$apply();  
		
	});
});
	
</script>