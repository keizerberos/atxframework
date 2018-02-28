//profilerMain.
var AtxCore = function(){
	this.preLoader = function (){
		/*agregar aca el código adicional*/
	};
	
	this.postLoader = function (){
		/*agregar aca el código adicional*/
		//profilerMain.cargarNav();
		//profilerMain.update(profileInfo);
		console.log("post loader");
	};
};

var atxCore = new AtxCore();

