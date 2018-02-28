var params = QueryString();
var formUsuarios = new atxPage("Usuarios");
var app = angular.module('appUsuarios', []);

app.controller('myCtrl', function($scope) {
	$scope.nombre = params['n'];
	$scope.clave = params['c'];
	$scope.usuario = params['c'];
	$scope.guardar = function() {
			
            if ($scope.userForm.$valid) {
                //alert('our form is amazing');
				controlador("nuevoUsuario",{nombre:$scope.nombre,usuario:$scope.usuario,clave:$scope.clave},function (r){ console.log("respuesta:",r); window.history.back();  });	
            }
			
        };
	$scope.validar = function () {
		return ($scope.clave == $scope.clave2);
	};
	$scope.validarTodo = function () {
		return ($scope.validar() && $scope.nombre != undefined && $scope.clave != undefined  && $scope.clave2 != undefined);
	};
	
	
});
	
$(document).ready(function (){
	$("#singlebu1tton").click(function (){
		console.log("guardar");
		controlador("nuevoUsuario",{nombre:$("#nombre").val(),clave:$("#clave").val()},function (r){ console.log("respuesta:",r); window.location.href="google.com"; });
	});
	
});	

	
