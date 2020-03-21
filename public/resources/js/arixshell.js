function arixshell_download_datos(urls){//Solicita datos a un determinado servidor
	//var a= null;
    $.ajax({
     	type: 'POST',
        url: urls,
        async: !1,
        dataType: 'json',
        success: function (data){
	        if (!$.isEmptyObject(data)){
	            urls = data;
	        }else{ 
	            urls = false;
	        }
        },
        error: function(e){
            urls = false;
        }
    });
    return urls; 
}
function arixshell_upload_datos(urls, datas) { // si es uno solo archivo
    $.ajax({
        type: 'POST',
        url: urls,
        async: !1,
        dataType: 'json',
        data: datas,
        success: function(data) {
            if (!$.isEmptyObject(data)) {
                urls = data;
            } else {
                urls = false;
            }
        },
        error: function(e) {
            urls = false;
        }
    });
    return urls;
}
function arixshell_limpiar_string(s) {//elimina caracteres raros de un string *#$
    s = s.replace(/[^a-zA-Z0-9\_]/g,'');
    return s;
}
function arixshell_cargar_titulo(title,next = 0){
    //title = arixshell_limpiar_string(title);
    ubicacion = '#layoutSidenav_content #user-title-breadcrumb';
    if(next == 0){
        $(ubicacion).html('<li class="breadcrumb-item">'+title+'</li>');
        $('title').text(title+" - Arix Shell v1.0");
    }
    else if (next == 1){
        $(ubicacion).append('<li class="breadcrumb-item">'+title+'</li>')
    }
    else{
        $( "#user-title-breadcrumb li" ).last().remove();
        $(ubicacion).append('<li class="breadcrumb-item">'+title+'</li>')
    }
}
function arixshell_activeshadow_app(a,b){return b==a?"active":""}//dessaroolando su mejora
function arixshell_desactivehref_app(r,a,e){return r==a?(arixshell_cargar_titulo(e,0),"javascript:;"):r}//desarrollando su mejora
function arixshell_cargar_apps() {//esta funcion es estatica -> siempre cargará en el mismo lugar
	var apps = arixshell_download_datos('arixapi/arixapi_mostrar_apps_usuario');
    if (apps!= false) {
        control=window.location.pathname;
        control= control.split("/"); ////********b[2] restar menos uno -> si arixmee no esta en un directorio
        control = arixshell_limpiar_string(control[2]);
        var list = '', elocation = '#navbarNav .navbar-nav';        
        $(elocation).html(list);//borras los registros actuales
        for (var i = 0; i < apps.length; i++) {
            list ='<li class="nav-item"><a class="nav-link '+arixshell_activeshadow_app(apps[i].controller,control)+'" href="'+arixshell_desactivehref_app(apps[i].controller,control,apps[i].app)+'">'+apps[i].app+'</a></li>';
            $(elocation).append(list);//agregas al final
        }
        list = ''; //limpias la memoria
    }else{
        console.log('arixshell_cargar_apps -> error');
    }
}

function arixshell_cargar_menu(){
    var menu = arixshell_download_datos('arixapi/arixapi_mostrar_menu_aplicaciones');
    var list = '', elocation = '#sidenavAccordion .nav';
    $(elocation).html(list);//borras los registros actuales
    if(menu != 403){
        for (var i = 0; i < menu.length; i++) {
            list = '<div class="sb-sidenav-menu-heading">'+menu[i].submenu+'</div>';
            for (var j = 0; j < menu[i][0].length; j++) {
                list += '<a class="nav-link" href="javascript:;" controller = '+menu[i][0][j].controller+'><div class="sb-nav-link-icon"><i class="fas fa-angle-right"></i></div>'+menu[i][0][j].subapp+'</a>';
            }
            $(elocation).append(list);//agregas al final
        }
        list = ''; //limpias la memoria
        $( "#sidenavAccordion a" ).first().click(); //click automatico en el primer item de la aplicacion
    }else{
        console.log('arixshell_cargar_menu -> error');
    }
}

function arixshell_cargar_usuario(){
    var user = arixshell_download_datos('arixapi/arixapi_mostrar_usuario_actual');
    if (user != null && user != 403) {
        $("nav").find('#dropdown-item-u1').text(user.documento+" | "+user.nombres+" "+user.paterno+" "+user.materno);
    }else{
        console.log('arixshell_cargar_usuario -> error');
    }
}

function arixshell_cargar_sucursal(){
    var sucursal = arixshell_download_datos('arixapi/arixapi_mostrar_sucursal_actual');
    if (sucursal != null && sucursal != 403) {        
        if (sucursal.nombre.length >= 20) {
            $("nav").find('#sucursal-db small').text(sucursal.nombre.substring(0,20)+"...");
        }else{
            $("nav").find('#sucursal-db small').text(sucursal.nombre);
        }
    }else{
        console.log('arixshell_cargar_usuario -> error');
    }
}

function arixshell_cargar_sucursal_lista(){
    var sucursal = arixshell_download_datos('arixapi/arixapi_mostrar_sucursales'), ubicacion = 'nav #sucursal-db-list';
    if (sucursal != null && sucursal != 403) {
        $(ubicacion).html('');//limias todo
        for (var i = 0; i < sucursal.length; i++) {
           $(ubicacion).append('<a class="dropdown-item" href="'+sucursal[i].sid+'">SUC. '+sucursal[i].nombre+'</a>');//agregas al final 
        }
    }else{
        console.log('arixshell_cargar_sucursal_lista-> error');
    }
}
function arixshell_probar_url(){//Ocurre un error fatal cunado se añade un / al final de la URL, esto lo soluciona
    a = window.location.href;
    b = window.location.pathname;
    a = a.replace(b, '');
    b = b.split('/',4); //********restar menos uno -> si arixmee no esta en un directorio
    if (b.length >=4) {
        b = b.join('/');
        b = b.split('/',3);
        b = b.join('/');
        window.location=a+b;
    }else{
        return;
    }
}
function arixshell_cargar_paginas(lugar, url){
    $(lugar).load(url, function(response, status, xhr) {
        if (status == "error") {
            var msg = "Arixcore encontró el siguiente error: ";//<h3>'+msg + ' - ' +xhr.status + " - " + xhr.statusText+'</h3>
            $(lugar).html('<div class="col-xl-12 col-md-12"><div class="card bg-danger text-white mb-4"><div class="card-body">'+msg + xhr.status + " - " + xhr.statusText+' en '+url+'<div class="card-footer d-flex align-items-center justify-content-between"><a class="small text-white stretched-link" href="#">Contáctese con nosotros, Es nuestra prioridad corregir este error ...</a></div></div></div></div>');
        }
    });
}
function arixshell_cargar_botones_menu(botones='btn-detalles, btn-guardar, btn-actualizar, btn-borrar'){
    botones = arixshell_upload_datos('arixapi/arixapi_cargar_botones', 'data='+botones+'&');
    if (botones != false) {
        var elocation = 'main #nav-item-input-botones';
        $(elocation).html('');//borras los registros actuales
        for (var i = 0; i < botones.length; i++) {           
            $(elocation).append('<button type="button" class="btn btn-secondary '+botones[i]['boton']+'"><i class="'+botones[i]['icono']+'"></i></button>');//agregas al final
        }
    }else{
        console.log('arixshell_cargar_botones_menu -> error');
    }
}
function arixshell_vaciar_menu(){
    var elocation1 = 'main #nav-item-input-buscar';
    var elocation = 'main #nav-item-input-botones';
    $(elocation1).html('')
    $(elocation).html('');
}
function arixshell_cargar_boton_simple(botones='btn-detalles,btn-borrar', uid='error!'){//devuelve botones en bormato html
    botones = arixshell_upload_datos('arixapi/arixapi_cargar_botones', 'data='+botones+'&');
    if (botones != false) {
        var list = '';
        for (var i = 0; i < botones.length; i++) {
            list+='<button type="button" class="btn btn-secondary '+botones[i]['boton']+'" uid="'+uid+'"><i class="'+botones[i]['icono']+'"></i></button>';
        }
        return list;
    }else{
        console.log('arixshell_cargar_botones_menu -> error');
    }
}
function arixshell_mostrar_card_users(image, titulo, msg_1, msg_2, msg_3, msg_4, fecha, btns='btn-detalles,btn-borrar', uid, estado = true){
    var list = '<div class="card" style="max-width: 21.7rem; min-width: 21.5rem; margin: 0.75rem; margin-top: 3px"> <div class="card-header">'
    +titulo.substring(0,34)+'</div><div class="card-body row"> <div class="col-md-3 text-center"> <img class="img-fluid" src="'+image+'" alt="..."> </div><div class="col-md-9" style="padding: 0px; margin-left: -2px; margin-top: -3px"> <dl class="dl-horizontal"> <dt class="col-sm-12">'
    +msg_1.substring(0,29)+'</dt> <dd class="col-sm-12">'
    +msg_2.substring(0,31)+'</dd> <dd class="col-sm-12" style="margin-top: -9px"><small>'
    +msg_3.substring(0,39)+'</small></dd> <dd class="col-sm-12" style="margin-top: -9px"><small>'
    +msg_4.substring(0,39)+'</small></dd> </dl> </div></div><div class="card-footer text-muted d-flex align-items-left justify-content-between" style="margin-top: -20px;"> <span class="text-info">'
    +fecha+'</span> <span class="text-secondary">Activo</span> <div class="btn-group btn-group-sm" style="margin: -3px">'
    +arixshell_cargar_boton_simple(btns, uid)+'</div></div></div>';
    return list;

}
function arixshell_cargar_boton_buscar(placeholder = 'Buscar ...'){
    var elocation = 'main #nav-item-input-buscar';
    $(elocation).html('')
    buscar = '<div class="input-group input-group-sm mb-1" style="padding-right: 5px;"><input type="text" class="form-control" placeholder="'+placeholder+'" aria-label="Buscar ..." aria-describedby="button-addon2"><div class="input-group-append"><button class="btn btn-outline-secondary btn-sm" type="button" id="button-addon2"><i class="fas fa-search"></i></button></div></div>';
    $(elocation).append(buscar);
}
$('nav #dropdown-item-u3').click(function(){
    dato = arixshell_download_datos('arixapi/arixapi_cerrar_sesion');
    if (dato.status == true) {
        window.location.replace('../arixmeebetagit');
    }else{
        return;
    }
});
//Camputa el clic submenu
$('#layoutSidenav_nav').on("click", ".nav-link", function() { //Clic en alguno de los elementos del munu
    $('#use-container-secondary').html('');//reestablce el primer contenedor
    var a = $(this).attr('controller'), b = $(this).text(), cant = $('#nav-idont-know .breadcrumb-item').length;
    arixshell_cargar_paginas('#use-container-primary', window.location.href+'/'+a);
    $('#sidenavAccordion').find('a').removeClass('active');
    $(this).addClass('active');
    //console.log(cant);
    arixshell_cargar_titulo(b,cant); //submenu representa el segundo subtitulo cant = 2
});

/*--------------------------MAIN----------------*/
//arixshell_probar_url();
arixshell_cargar_apps();
arixshell_cargar_menu();
arixshell_cargar_usuario();
arixshell_cargar_sucursal();
arixshell_cargar_sucursal_lista();

