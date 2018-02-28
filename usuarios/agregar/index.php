<?php if (!isset ( $atx_config )){ $_cf = '/atx-config.php';$c = 0; while(!file_exists($_cf) && $c < 5){ $_cf = "../".$_cf;	$c++; }	if (file_exists($_cf)){ include $_cf; } else {echo "no se ha encontrado el archivo de configuración"; exit();}}	else config_load_ext();	?> 
<body>
	<div class="atx-body container " ng-app="appUsuarios" ng-controller="myCtrl" >
		<div class="row">

			<div>

				<form name="userForm" ng-submit="Guardar()" novalidate >
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
							<input type="password" id="clave" ng-minlength="2" ng-maxlength="20" ng-model="clave" class="form-control" placeholder="Ingrese su clave..." required >
						</div>  
					</div>
					
					<div class="col-lg-3">
						<div class="form-group">
							<label>Confirmar:</label>
							<input type="password" id="clave2" ng-model="clave2" class="form-control" placeholder="Repita su clave ..." required >
							<span class="atx-invalid" ng-show="!validar()">las contraseñas deben ser las mismas</span>
						</div>  
					</div> 
				</form>
				
			</div>
			
		</div>
		<div class="atx-foot " >
			<div class="center-block vertical-center">
				<button id="singlebutton" name="singlebutton" ng-model="singlebutton" ng-disabled="!validarTodo()"  ng-click="guardar()" class="btn btn-primary center-block">Guardar</button>
			</div>
		</div>
	</div>	
</body>
<script>
	
	
</script>