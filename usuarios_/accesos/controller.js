var params = QueryString();
var formUsuarios = new atxPage("accesos");

var app = angular.module('appAccesos', []);

app.controller('myCtrl', function($scope) {
		
	controlador("getAccesos",{cod:params['cod']},function (r){ 	
		var dat = JSON.parse(r);
		
		$scope.datos = dat;
		$scope.$apply();
	});
	
	$scope.guardar = function() {
		//console.log($scope.datos);		
		//alert('our form is amazing');
				
		var accesos = {"cod_mod":Input2ArrayAttr($('[name=inpCheck]'),"atx-cod-mod"),"cod":Input2ArrayVal($('[name=inpCheck]'),"atx-cod-mod"),"val":Input2ArrayType($('[name=inpCheck]'))}
		
		//console.log(accesos);
		
		controlador("updAccesos",{cod_usu:params['cod'],"accesos": JSON.stringify(accesos) },function (r){ console.log("respuesta:",r); window.history.back(); });	
		
		//console.log($scope);
		//console.log(Input2ArrayDual('inpCheck'));
	};

	$scope.volver = function (){
		window.history.back();
	};
});

$(document).ready(function (){
	$("#btnSave").click(function (){
		//console.log("guardar");
		//controlador("actualizarUsuario",{nombre:$("#nombre").val(),clave:$("#clave").val()},function (r){ console.log("respuesta:",r); /*window.location.href="google.com"; */	});
	});
	
	//ObtenerUsuario();
});

