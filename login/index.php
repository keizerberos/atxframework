<?php if (!isset ( $atx_config )){ $_cf = '/atx-config.php';$c = 0; while(!file_exists($_cf) && $c < 5){ $_cf = "../".$_cf;	$c++; }	if (file_exists($_cf)){ include $_cf; } else {echo "no se ha encontrado el archivo de configuración"; exit();}}	else config_load_ext();	?>

<div class="atx-body">
	<div class="login-box">

		<div class="login-logo">
			<a href="../../index2.html"><b><?php echo $atx_config['title-a'] ?></b><?php echo $atx_config['title-b'] ?></a>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">Identifiquese para iniciar sesion</p>

			<form method="post" action="../principal"
				onsubmit="evt.preventDefault();">
				<div class="form-group has-feedback">
					<input id="inpUsuario" type="text" class="form-control"
						placeholder="Usuario"> <span
						class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input id="inpClave" type="password" class="form-control"
						placeholder="Clave"> <span
						class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="form-group">
					<div class=" col-xs-12">
						<div class="checkbox icheck">
							<label> <input type="checkbox"> Recordarme
							</label>
						</div>
					</div>
				</div>
				<div class="col-xs-4">
					<button id="goSubmit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
				</div>
			</form>
			<!--
<div class="social-auth-links text-center">
<p>- O -</p>
<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Usar
Facebook</a>
<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Usar
Google+</a>
</div>
-->
			<!-- /.social-auth-links -->

			<a href="#">Olvid&eacute; mi clave</a></br> <a href="register.html"
				class="text-center">Registrar un nuevo miembro</a>

		</div>
		<!-- /.login-box-body -->
	</div>
</div>
<script>

	$("body").css("background-image",'url(img/logo2.jpg)');
	$("body").css("background-size",'cover');

	$("#goSubmit").click(function (){
		controlador("logearse",{u:$("#inpUsuario").val(),p:$("#inpClave").val()},function (r){ 	
			console.log(r);
			var j = JSON.parse(r);
			console.log(j);
			if (j.result == "ok"){				
				//history.pushState('data', '', j.lastpage);
				console.log("j.user_name",j.user_name);
				setCookie("user_name",j.user_name,5);
				window.location.href =  j.lastpage;
			}
			
		});
	});
</script>