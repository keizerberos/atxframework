var params = QueryString();
var formUsuarios = new atxPage("Usuarios");
var app = angular.module('appUsuarios', []);
var ObtenerUsuario;

	
$(document).ready(function (){
	$("#singlebu1tton").click(function (){
		console.log("guardar");
		controlador("actualizarUsuario",{nombre:$("#nombre").val(),clave:$("#clave").val()},function (r){ console.log("respuesta:",r); /*window.location.href="google.com"; */	});
	});
	
	//ObtenerUsuario();
});	

	
