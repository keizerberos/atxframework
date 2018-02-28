var profileInfo = {
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
						ico :   "http://localhost:8080/atx//_core/lte/dist/img/user2-160x160.jpg",
						icofa:  "fa fa-users text-aqua",
						href : ""
					},
					{
						info : "Unidad Administrativa",
						desc : "Debe Modificar una nueva hoja de ruta",
						time : " 2 hours",
						ico : "http://localhost:8080/atx//_core/lte/dist/img/user3-128x128.jpg",
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
			ico: 'http://localhost:8080/atx/_core/lte/dist/img/user2-160x160.jpg',
			name: 'Jorge Tordoyaa',
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
			hrefCerrar : 'http://localhost:8080/atx//login'
		}
	};