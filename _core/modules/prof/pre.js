var ProfilerMain = function (infoJS){
	var me = this;
	this.pro_main_nav = null;
	this.infoJS = {
		iconsMenu:[
			{
				header : "Tienes 4 Mensajes",
				type : 1, /* 1:Message, 2:Notifications, 3:Task, 4:Custom html*/
				cant : 2,
				icofa : "fa fa-envelope-o",
				typeLabel : "label-success",
				items:[
					{
						info :  "Equipo de desarrollo",
						desc :  "Repositorio actualizado",
						time : " 5 mins",
						ico :   "http://localhost:8070/atx//_core/lte/dist/img/user2-160x160.jpg",
						icofa:  "fa fa-users text-aqua",
						href : ""
					},
					{
						info : "Unidad Administrativa",
						desc : "Debe Modificar una nueva hoja de ruta",
						time : " 2 hours",
						ico : "http://localhost:8070/atx//_core/lte/dist/img/user3-128x128.jpg",
						icofa: "fa fa-users text-aqua",
						href : ""
					},
				],
				linkMessage : "Ver Todos los Mensajes",
				haveLink: true,
				href : "/mensajes"
			},
			{
				header : "Tienes 10 Notificaciones",
				type : 2, /* 1:Message, 2:Notifications, 3:Goals, 4:Custom html*/
				cant : 10,
				icofa : "fa fa-bell",
				typeLabel : "label-warning",
				items:[
					{
						info : "5 nuevos miembros se unieron hoy",
						icofa: "fa fa-users text-aqua",
						href : ""
					},
					{
						info : "Descripcion muy larga",
						icofa: "fa fa-warning text-yellow",
						href : ""
					},
					{
						info : "5 nuebos miembros se unieron",
						icofa: "fa fa-users text-red",
						href : ""
					},
					{
						info : "25 ventas realizadas",
						icofa: "fa fa-shopping-cart text-green",
						href : ""
					},
					{
						info : "Cambiaste tu nombre de usuario",
						icofa: "fa fa-user text-red",
						href : ""
					}
				],
				linkMessage : "Ver todos las notificaciones",
				haveLink: true,
				href : "/mensajes"
			},
			{
				header : "Tienes 9 tareas",
				type : 3, /* 1:Message, 2:Notifications, 3:Goals, 4:Custom html*/
				cant : 9,
				icofa : "fa fa-flag-o",
				typeLabel : "label-danger",
				items:[
					{
						info : "Diseñar algunos botones",
						per : "20%",
						col: "progress-bar-aqua",
						href : "#"
					},
					{
						info : "Crear un buen tema",
						per : "40%",
						col: "progress-bar-green",
						href : "#"
					},
					{
						info : "Algunas tareas que necesito hacer",
						per : "60%",
						col: "progress-bar-red",
						href : "#"
					},
					{
						info : "Hacer hermosas transiciones",
						per : "80%",
						col: "progress-bar-yellow",
						href : "#"
					}
				],
				linkMessage : "Ver todas las tareas",
				haveLink: true,
				href : "/mensajes"
			}
		],
		profiler : {
			ico: 'http://localhost:8070/atx//_core/lte/dist/img/user2-160x160.jpg',
			name: 'Jorge Tordoya',
			desc: 'Jorge Tordoya - Web Developer <small>Miembro desde el 2012</small>',
			links : [{
				href : "#",
				name : "Seguidores"				
			},{
				href : "#",
				name : "Ventas"				
			},{
				href : "#",
				name : "Amigos"				
			}],
			hrefPerfil : '#',
			hrefCerrar : 'http://localhost:8070/atx//login'
		}
	};
	var pro_main_nav = $(".pro-main-nav");
	me.pro_main_nav = pro_main_nav;  
	
	var pro_icons_nav = $(".pro-icons-nav"); 
	if (infoJS != null) this.infoJS = infoJS;
	if (infoJS == "") this.infoJS = infoJS;
	this.setInfo = function (infoJS){
		this.infoJS = infoJS;
	}; 
	this.update = function (infoJS){
		if (infoJS != null) this.infoJS = infoJS;
		if (infoJS == "") this.infoJS = infoJS;
		me.refresh();
	};
	
	this.refresh = function (){
		var nav_ic = $($(pro_icons_nav).find(".navbar-nav")[0]);
		$(nav_ic).empty();
		for (var i = 0 ; i < me.infoJS.iconsMenu.length ; i++){
			var icon = me.infoJS.iconsMenu[i];
			var li1 = $("");			
			if (icon.type == 1)
				li1 = $('<li class="dropdown messages-menu"><a href="#" '+
								'class="dropdown-toggle" data-toggle="dropdown"> <i '+
									'class="'+ icon.icofa +'"></i> <span class="label '+ icon.typeLabel +'">'+ icon.cant +'</span>'+
										'</a></li>');		
			if (icon.type == 2)
				li1 = $('<li class="dropdown notifications-menu"><a href="#" '+
								'class="dropdown-toggle" data-toggle="dropdown"> <i '+
									'class="'+ icon.icofa +'"></i> <span class="label '+ icon.typeLabel +'">'+ icon.cant +'</span>'+
										'</a></li>');		
			if (icon.type == 3)
				li1 = $('<li class="dropdown tasks-menu"><a href="#" '+
								'class="dropdown-toggle" data-toggle="dropdown"> <i '+
									'class="'+ icon.icofa +'"></i> <span class="label '+ icon.typeLabel +'">'+ icon.cant +'</span>'+
										'</a></li>');
			console.log("li21",li21);
			nav_ic.append(li1)
			
			var li2 = $('<ul class="dropdown-menu">'+
					'<li class="header">'+ icon.header +'</li><li><ul class="menu"></li></ul>');
			
			li1.append(li2);
			var li21 = $(li2.find(".menu")[0]);
			console.log("li21",li21);
			
			if (icon.type == 1){
				for (var j = 0 ; j < icon.items.length ; j++){
					var item = icon.items[j];
					var li3 = "";
					
					var li3 = $('<li>'+
						'	<a href="'+ item.href +'">'+
						'	<div class="pull-left">'+
						'		<img src="'+ item.ico +'"'+
						'			class="img-circle" alt="User Image">'+
						'	</div>'+
						'	<h4>'+ item.info + '<small><i class="fa fa-clock-o"></i>' + item.time + '</small></h4>'+
						'<p>'+ item.desc +'</p>'+
						'</a>'+
						'</li>');
					console.log("li3",li3);
					li21.append(li3);
				}
			}
			if (icon.type == 2){
				for (var j = 0 ; j < icon.items.length ; j++){
					var item = icon.items[j];
					var li3 = "";
					
					var li3 = $('<li><a href="'+ item.href +'"> <i class="' + item.icofa +'"></i> '+ item.info  +
							'</a></li>');
					li21.append(li3);
				}
			}
			if (icon.type == 3){
				for (var j = 0 ; j < icon.items.length ; j++){
					var item = icon.items[j];
					var li3 = "";
					
					var li3 = $('<li>'+
					'		<a href="'+ item.href +'">'+
					'		<h3>'+ item.info +' <small class="pull-right">'+ item.per +'</small>'+
					'		</h3>'+
					'		<div class="progress xs">'+
					'			<div class="progress-bar ' + item.col + '" '+
					'				style="width: ' + item.per + '" role="progressbar" aria-valuenow="20" '+
					'				aria-valuemin="0" aria-valuemax="100">'+
					'				<span class="sr-only">' + item.per + ' Completado</span>'+
					'			</div>'+
					'		</div>'+
					'</a>'+
					'</li>');
					li21.append(li3);
				}
			}
			if (icon.haveLink == true){
				var li2x = $('<li class="footer"><a href="'+ icon.href +'">' + icon.linkMessage + '</a></li>');
				li2.append(li2x);
			}
		}
		var prof = me.infoJS.profiler;
		var li1 = $('<li class="dropdown user user-menu"><a href="#" ' +
				'class="dropdown-toggle" data-toggle="dropdown"> <img ' +
				'src="'+ prof.ico +'" ' +
				'class="user-image" alt="User Image"> <span class="hidden-xs pro-user-name">'+ prof.name +'</span> ' +
				'</a></li>');
		nav_ic.append(li1);
		var li2 = $('<ul class="dropdown-menu"></ul>');
		li1.append(li2);
		var li21 = $(	'<li class="user-header"><img src="'+prof.ico +'" ' +
						'class="img-circle" alt="User Image"> <p> '+ prof.desc +'</small></p></li>');
		li2.append(li21);
		var li22 = $('<li class="user-body">'+ 
						'<div class="row"> '+						
						'</div> '+
						'</li>');
		li2.append(li22);
		var li23 = $($(li22).find(".row")[0]);
		
		for (var i = 0 ; i < prof.links.length; i++){
			var li3 = $('<div class="col-xs-4 text-center"><a href="'+ prof.links[i].href +'">'+ prof.links[i].name +'</a></div>');
			li23.append(li3);
		}

		var li24 = $('<li class="user-footer"> ' +
		'		<div class="pull-left"> ' +
		'		<a href="'+ prof.hrefPerfil+'" class="btn btn-default btn-flat">Perf&iacute;l</a> ' +
		'	</div> ' +
		'	<div class="pull-right"> ' +
		'		<a href="'+ prof.hrefCerrar +'" ' +
		'			class="btn btn-default btn-flat">Cerrar Sesi&oacute;n</a> ' +
		'	</div> ' +
		'</li>');
		li2.append(li24);
		
		var li2 = $('<li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>');

		nav_ic.append(li2);
	};
	this.changeUserName = function (user){
		 $(".pro-user-name").text(user); 
	};
	this.newInfo = function (infoJS){
		this.infoJS = infoJS;
	};
};

var profilerMain = new ProfilerMain();


function cargarNav(){
	profilerMain.refresh();
};