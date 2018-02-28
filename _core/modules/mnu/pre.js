var _menu = {
	'tipo':'data',	/* json or data*/
	'src' : 'menu/menu.php',
	'areas' : [{'cod':1,'nom':'Actividades'}],
	'grupos':
		[
			{'cod':1,'nom':'Procesos','ico':''},
			{'cod':3,'nom':'Mantenimiento','ico':''},
			{'cod':2,'nom':'Reportes','ico':''}
		],
	'modulos':
		[
			{'nom':'Facturar','dir':'','des':'M�dulo para generar facturas','ord':0,'grupo':1,'ico':''},
			{'nom':'Buscar facturas','dir':'','des':'M�dulo de b�sueda, permite la anulaci�n','ord':0,'grupo':1,'ico':''}
		]
};

var MNU = function (){
	var me = this;
	this.cargarMenu = function(m){
		
		if (m.tipo == 'data'){
			$.post(atx_config.path + m.src, function(r) {
				
				try {
					var rjs = JSON.parse(r);
					m.grupos = JSON.parse(rjs.grp);
					m.modulos = JSON.parse(rjs.mod);
					m.areas = JSON.parse(rjs.area);
					me.drawMenu(m);
					me.setUser();
				}catch(err){
					console.log(r);
					console.log("ERROR",err);
				}
			});
		}
		else{
			me.drawMenu(m);
		}	
	};

	this.drawMenu = function(m){
		console.log(m);
		
		var _atxmenu = $("#atx-menu");
		_atxmenu.empty();
		var _n = 0;
		for (var i = 0; i < m.areas.length ; i++){
			var _li = $('<li class="header">'+m.areas[i].nom+'</li>');
			var _subGroup = m.grupos.finds(function (_x){ return _x.area == m.areas[i].cod });
			_atxmenu.append(_li);
			
			for (var j = 0; j < _subGroup.length; j++){
				var _li2 = $('<li class="treeview"><a href="#">'+
								'<i class="fa '+_subGroup[j].ico+'"></i> <span>' + _subGroup[j].nom + '</span>'+
								   '<span class="pull-right-container">	'+
								       '<i class="fa fa-angle-left pull-right"></i>	'+
								   '</span>  </a><ul class="treeview-menu"></ul>'+
						     '</li>');
			
				var _subMenu = m.modulos.finds(function (_x){ return _x.grupo == _subGroup[j].cod });
			
				for (var k = 0; k < _subMenu.length; k++){
					var _li3 = $('<li><a href="' + atx_config.path + _subMenu[k].dir +'"><i class="fa '+_subMenu[k].ico+'"></i>'+_subMenu[k].nom+'</a></li>');
					
					$(_li2).find(".treeview-menu").append(_li3);
				}
				_atxmenu.append(_li2);
			}
			
			//var _a = $('<a href="#">	<i class="fa fa-dashboard"></i> <span>Dashboard</span>	<span class="pull-right-container">	  <i class="fa fa-angle-left pull-right"></i>	</span>  </a>');
			
		}
		
	        //<a href="#" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-fw fa-search"></i> Modulo 1 <i class="fa fa-fw fa-angle-down pull-right"></i></a>	
	};

	this.drawMenu_x = function(m){
		//console.log(m);
		
		var _atxmenu = $("#atx-menu");
		_atxmenu.empty();
		var _n = 0;
		for (var i = 0; i < m.grupos.length ; i++){
			_n++;
			var _li = $("<li></li>");
			var _nm =  "submenu-"+_n;
			var _a = $('<a href="#" data-toggle="collapse" data-target="#'+_nm+'"><i class="fa fa-fw fa-search"></i> ' + m.grupos[i].nom + ' <i class="fa fa-fw fa-angle-down pull-right"></i></a>');
			var _ul = $('<ul id="'+_nm+'" class="collapse"></ul>');		
			
			var _subMenu = m.modulos.finds(function (_x){ return _x.grupo == m.grupos[i].cod });
			
			//console.log(_subMenu);
			for (var j = 0; j < _subMenu.length ; j++){
				var _li2 = $('<li><a href="'+ atx_config.path +  _subMenu[j].dir  + '"><i class="fa fa-angle-double-right"></i> '+ _subMenu[j].nom +' </a></li>');
				_ul.append(_li2);
				//console.log("adding: ",_li2);
			}
			_li.append(_a);
			_li.append(_ul);
			//console.log(_li);
			_atxmenu.append(_li);
		}
	        //<a href="#" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-fw fa-search"></i> Modulo 1 <i class="fa fa-fw fa-angle-down pull-right"></i></a>	
	};	
	this.setUser = function (user = "Jorge Tordoya.",image = "http://localhost:8070/atx//_core/lte/dist/img/user2-160x160.jpg",statetext = "En l&iacute;nea",textstatecolor = "text-success"){
		var panel = $(".mnu-user-panel");
		var img = $(panel.find("img")[0]);
		var divinfo = $(panel.find(".info")[0]);
		var info = $('<p>'+ user +'</p><a href="#"><i class="fa fa-circle '+ textstatecolor +'"></i> ' + statetext + '</a>');
		divinfo.empty(); 
		divinfo.append(info); 
		
	};
}
var mnu = new MNU();
