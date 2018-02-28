
var QueryString = function () {
  // This function is anonymous, is executed immediately and 
  // the return value is assigned to QueryString!
  var query_string = {};
  var query = "";
  
  if (window.location.search == "") query = window.location.hash.substring(1);
  if (window.location.hash == "") query = window.location.search.substring(1);
  
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
        // If first entry with this name
    if (typeof query_string[pair[0]] === "undefined") {
      query_string[pair[0]] = decodeURIComponent(pair[1]);
        // If second entry with this name
    } else if (typeof query_string[pair[0]] === "string") {
      var arr = [ query_string[pair[0]],decodeURIComponent(pair[1]) ];
      query_string[pair[0]] = arr;
        // If third or later entry with this name
    } else {
      query_string[pair[0]].push(decodeURIComponent(pair[1]));
    }
  } 
  return query_string;
};
var Input2ArrayVal = function (obj){
	var arInp = obj;
	var ar = [];
	$.each(arInp, function (k,v){
		ar.push($(v).val());
	});
	return ar;
};
var Input2ArrayType = function (obj){
	var arInp = obj;
	var ar = [];
	$.each(arInp, function (k,v){
		if ($(v).attr('type')=='checkbox')	ar.push(v.checked);
		if ($(v).attr('type')=='text')	ar.push($(v).val());
	});
	return ar;
};
var Input2ArrayAttr = function (obj,attr){
	var arInp = obj;
	var ar = [];
	$.each(arInp, function (k,v){
		ar.push($(v).attr(attr));
	});
	return ar;
};
var Input2ArrayDual = function (name){
	var arInp = $('[name='+name+']');
	var ar = [];
	$.each(arInp, function (k,v){
		var ta = [];
		ta['key'] = v.checked;
		ta['val'] = $(v).val();
		ar.push(ta);
	});
	return ar;
};

function confirm(heading, question, cancelButtonTxt, okButtonTxt, callback) {

		var confirmModal = 
		  $('<div class="modal fade">' +        
			  '<div class="modal-dialog">' +
			  '<div class="modal-content">' +
			  '<div class="modal-header">' +
				'<a class="close" data-dismiss="modal" >&times;</a>' +
				'<h3>' + heading +'</h3>' +
			  '</div>' +

			  '<div class="modal-body">' +
				'<p>' + question + '</p>' +
			  '</div>' +

			  '<div class="modal-footer">' +
				'<a href="#!" class="btn" data-dismiss="modal">' + 
				  cancelButtonTxt + 
				'</a>' +
				'<a href="#!" id="okButton" class="btn btn-primary">' + 
				  okButtonTxt + 
				'</a>' +
			  '</div>' +
			  '</div>' +
			  '</div>' +
			'</div>');

		confirmModal.find('#okButton').click(function(event) {
		  callback();
		  confirmModal.modal('hide');
		}); 

		confirmModal.modal('show');     
	};

var StringQuery = function (_js) {
  // This function is anonymous, is executed immediately and 
  // the return value is assigned to QueryString!
  var query_string = [];
  var query = "";
  
  for (var x in _js)
	  query_string.push(x+"="+_js[x]);
  
  query = query_string.join("&");
    
  
  return query;
};

function formularioCargar(_formulario, _params, _funcion) {
	$.post( _formulario, _params,function(responseText) {
		//$(_en).append(responseText);
		//console.log("DEBUG",responseText);
		if (_funcion !=  'undefined' && _funcion!=null) _funcion(responseText);
	});
}; 

function controlador(_proceso, _params, _funcion) {
	jQuery.extend(_params,{"_proceso":_proceso});
	//console.log(_params);
	formularioCargar('controller.php', _params, _funcion);
};


var atxPage = function(nameTitle,funcName){
	
	formularioCargar(atx_config.pathcore + "/templates/atx_generic_main.php",{},function (res){ 
		//console.log(res);
		$("body").append(res);
		//$(".atx-body").append($(nameClass));
		//$(".atx-body").appendTo($(".content"));
		$(".atx-body").appendTo($(".content-wrapper"));
		$(".atx-foot").appendTo($(".atx-main-footer"));
		if (funcName != null) funcName();		
	});
	
	this.post = function (params,afterOf){
		$.post('controller.php',params, function (res){
			afterOf(res);
		});		
	};	
	
	this.getJson = function (pagePhp,params,afterOf){
		$.post(atx_config.pathcore + '/' + pagePhp,params, function (res){
			return json_decode(res);
		});
	};
};

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function post1 (params,afterOf){
	$.post('controller.php',params, function (res){
		afterOf(res);
	});		
};

function formularioCargar1(_formulario, _en) {
	
	pc.cargar();
	pc.ponTexto("Cargando Formulario");
	pc.noBarra();

	$.post(config.screens + _formulario, function(responseText) {
		$(_en).append(responseText);
		// pc.ponTexto("Completado");
		pc.descargar();

	});
}

/*
function finds(ar, func){
	var _tempAr = [];
	for (var i = 0; i < m.grupos.length ; i++){
		if (func(ar[i])) _tempAr.push(ar[i]);
	}
	return _tempAr;
}*/
Array.prototype.finds = function (func){
	var _tempAr = [];
	for (var i = 0; i < this.length ; i++){
		if (func(this[i])) _tempAr.push(this[i]);
	}
	return _tempAr;
};


$(document).ready(function (){	
	
	/*$(".a1").on("click",function (){
		//console.log(window.location.href );
		window.history.pushState({"html":"","pageTitle":"miPagina2"},"", "");
		atx.loadBody();
	});*/
	
	loadPosEvents();
	atxCore.postLoader();
});

function loadPosEvents(){
	for (var i=0;i<loadJS.length;i++)
		eval(loadJS[i]);
	
};

 function processAjaxData(response, urlPath){
     document.getElementById("content").innerHTML = response.html;
     document.title = response.pageTitle;
     window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);
 }