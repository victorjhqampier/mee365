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
//FUNCION OBSOLETA
function arixshell_localdata_restarting(){
    sessionStorage.setItem("last_page", false);
    sessionStorage.setItem("current_page", false);
    sessionStorage.setItem("last_serial", null);
}
//FUNCION OBSOLETA
function arixshell_add_cache_page(location, url){
    var current_page = sessionStorage.getItem('current_page');
    current_page = JSON.parse(current_page);
    if (url !=  current_page[1]) {
        var last_page = [current_page[0],current_page[1]];
        current_page = [location, url];
        sessionStorage.setItem('current_page', JSON.stringify(current_page));
        sessionStorage.setItem('last_page', JSON.stringify(last_page));
    }
    else{
        return;
    }
}
//FUNCION OBSOLETA
function arixshell_write_cache_serial(serial){
    sessionStorage.setItem('last_serial', serial);
}
//FUNCION OBSOLETA
function arixshell_read_cache_serial(){
    var temp = sessionStorage.getItem("last_serial");
    sessionStorage.setItem('last_serial', null);
    return temp;
}
function arixshell_cargar_auto_subtitulos(){
    number = $('#sucursal-db-list').first().text();number = number.split(',');
    $('#user-title-breadcrumb').html('<li class="breadcrumb-item active" aria-current="page">'+number[0]+'</li>');
    $('#user-title-breadcrumb').append('<li class="breadcrumb-item active">'+$("#navbarNav li.active" ).text()+'</li>');
}
//AGREHAR FUNCION DE REINICIAR CACHÉ
function arixshell_cargar_third_subtitulo(title){
    if (2 == $('#nav-idont-know .breadcrumb-item').length) {
        $('#user-title-breadcrumb').append('<li class="breadcrumb-item active">'+title+'</li>');
        //CACHÉ
    }else{
        $( "#user-title-breadcrumb li:eq( 1 )" ).nextAll().remove();
        $('#user-title-breadcrumb').append('<li class="breadcrumb-item active">'+title+'</li>');
    }
}
//FUNCION OBSOLETA
function arixshell_agregar_subtitulo(title,position = 4){
    a = $('#nav-idont-know .breadcrumb-item').length;
    if (a >= position - 1 && position > 3){
        if (a== position-1) {
            $('#user-title-breadcrumb').append('<li class="breadcrumb-item active">'+title+'</li>');
        }else{
            $( "#user-title-breadcrumb li:eq("+(position - 2)+")" ).nextAll().remove();
            $('#user-title-breadcrumb').append('<li class="breadcrumb-item active">'+title+'</li>');
        }
    }
    else{
        return;
    }
}
//FUNCION OBSOLETA
function arixshell_cargar_ultimo_titulo(titulo='Nuevo'){
    cant = $('#nav-idont-know .breadcrumb-item').length;
    arixshell_cargar_titulo(titulo,cant-1);
}
function arixshell_cargar_titulo_page(){
    title = $("#navbarNav li.active" ).text();
    //$('#layoutSidenav_content #user-title-breadcrumb').html('<li class="breadcrumb-item" aria-current="page">'+title+'</li>');
    $('title').text(title+" - Arix Shell v1.0");
    //console.log(data);
}
function arixshell_activeshadow_app(a,b){return b==a?"active":""}//dessaroolando su mejora
function arixshell_desactivehref_app(r,a){return r==a?("javascript:;"):r}//para desactivar url
function arixshell_cargar_apps() {//esta funcion es estatica -> siempre cargará en el mismo lugar
	var apps = arixshell_download_datos('arixapi/arixapi_mostrar_apps_usuario');
    if (apps!= false) {
        control=window.location.pathname;
        control= control.split("/"); ////********b[2] restar menos uno -> si arixmee no esta en un directorio
        control = arixshell_limpiar_string(control[2]);
        var list = '', elocation = '#navbarNav .navbar-nav';        
        $(elocation).html(list);//borras los registros actuales
        for (var i = 0; i < apps.length; i++) {
            list ='<li class="nav-item '+arixshell_activeshadow_app(apps[i].controller,control)+'"><a class="nav-link" href="'+arixshell_desactivehref_app(apps[i].controller,control,apps[i].app)+'">'+apps[i].app+'</a></li>';
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
    if (sucursal != null && !$.isNumeric(sucursal.nombre)) {
        $("nav").find('#sucursal-db small').text(sucursal.nombre.substring(0,20)+"...");
        $('nav #sucursal-db-list').html('<a class="dropdown-item active" href="javascript:;" id="0xFF">N'+sucursal.numero+', '+sucursal.nombre+'</a>');
    }else{
        console.log('arixshell_cargar_usuario -> error');
    }
}

function arixshell_cargar_sucursal_lista(){
    var sucursal = arixshell_download_datos('arixapi/arixapi_mostrar_sucursales'), ubicacion = 'nav #sucursal-db-list';
    if (sucursal != null && sucursal != 403) {
        //$(ubicacion).html('');//limias todo
        for (var i = 0; i < sucursal.length; i++) {
           $(ubicacion).append('<a class="dropdown-item" href="javascript:;" id="'+sucursal[i].serial+'">N'+sucursal[i].numero+', '+sucursal[i].nombre+'</a>');//agregas al final 
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
function arixshell_vaciar_botones_menu(){
    $('main #nav-item-input-buscar').html('')
    $('main #nav-item-input-botones').html('');
}
function arixshell_vaciar_paginas(){
    $('main #use-container-secondary').html('')
    $('main #use-container-primary').html('');
}
function arixshell_cargar_paginas(url,lugar = '#use-container-primary'){//borra todo y carga una pagina
    arixshell_vaciar_paginas();
    arixshell_vaciar_botones_menu();
    //arixshell_add_cache_page(lugar,url);    
    $(lugar).load(url, function(response, status, xhr) {
        if (status == "error") {
            var msg = "Arixcore encontró el siguiente error: ";//<h3>'+msg + ' - ' +xhr.status + " - " + xhr.statusText+'</h3>
            $(lugar).html('<div class="row"><div class="col-xl-12 col-md-12"><div class="card bg-danger text-white mb-4"><div class="card-body">'+msg + xhr.status + " - " + xhr.statusText+' en '+url+'<div class="card-footer d-flex align-items-center justify-content-between"><a class="small text-white stretched-link" href="javascript:;"><strong>¡Lo siento! </strong>El servidor a denegado el acceso a la página ...</a></div></div></div></div></div>');
        }
    });
}
function arixshell_cargar_subpaginas(url,lugar){//carga paginas en un modal
    $(lugar).load(url, function(response, status, xhr) {
        if (status == "error") {
            var msg = "Arixcore encontró el siguiente error: ";
            $(lugar).html('<div class="col-xl-12 col-md-12"><div class="card bg-danger text-white mb-4"><div class="card-body">'+msg + xhr.status + " - " + xhr.statusText+' en '+url+'<div class="card-footer d-flex align-items-center justify-content-between"><a class="small text-white stretched-link" href="javascript:;"><strong>¡Lo siento! </strong>El servidor a denegado su petición ...</a></div></div></div></div>');
        }
    });
}

//aqui trabajo, falta agregar funcionalidad de caché
function arixshell_cargar_contenido(url,titulo = false, position = 4){//esta es una funcion muy especifica para llenar subtitulos y paginas(caches)
    a = $('#nav-idont-know .breadcrumb-item').length;
    console.log(a +' '+position+' '+titulo);
    if (a >= position - 1 && position > 3){
        arixshell_cargar_paginas(url,'#use-container-primary');
        if (a== position-1) {
            $('#user-title-breadcrumb').append('<li class="breadcrumb-item active">'+titulo+'</li>');
            //CACHÉ
        }else{
            $( "#user-title-breadcrumb li:eq("+(position - 2)+")" ).nextAll().remove();
            $('#user-title-breadcrumb').append('<li class="breadcrumb-item active">'+titulo+'</li>');
        }
    }
    else{
        return;
    }
}
function arixshell_iniciar_llaves_locales(id1="#btn_error", id2="#con_error"){
    var id1 = id1.replace(" ", "");
        id1 = id1.replace("#", "");
    var id2 = id2.replace(" ", "");
        id2 = id2.replace("#", "");
    //$('#nav-idont-know ul:last').attr('id', id1);
    $('#nav-item-input-botones').html('<div class="btn-group btn-group-sm" id="'+id1+'"></div>');
    $('#use-container-secondary').html('<div class="row" id="'+id2+'"></div>');
}
function arixshell_cargar_llave_local(one = 0){
    li = ['#'+$('#nav-item-input-botones div:first').attr('id'), '#'+$('#use-container-secondary div:first').attr('id')];
    if (one >= 0 && one < 2) {
        return li[one]
    }else{
        return li;
    }
}
function arixshell_cargar_botones_menu(botones='btn-actualizar'){
    botones = arixshell_upload_datos('arixapi/arixapi_cargar_botones', 'data='+botones+'&');
    if (botones != false) {
        for (var i = 0; i < botones.length; i++) {           
            $(arixshell_cargar_llave_local(0)).append('<button type="button" class="btn btn-secondary '+botones[i]['boton']+'" data-toggle="tooltip" data-placement="bottom" title="'+botones[i]['titulo']+'"><i class="'+botones[i]['icono']+'"></i></button>');//agregas al final
        }
    }else{
        console.log('arixshell_cargar_botones_menu -> error');
    }
}
function arixshell_cargar_boton_simple(botones='btn-detalles,btn-borrar'){//devuelve botones en bormato html
    botones = arixshell_upload_datos('arixapi/arixapi_cargar_botones', 'data='+botones+'&');
    if (botones != false) {
        var list = '';
        for (var i = 0; i < botones.length; i++) {
            list+='<button type="button" class="btn btn-secondary '+botones[i]['boton']+'"><i class="'+botones[i]['icono']+'" data-toggle="tooltip" data-placement="bottom" title="'+botones[i]['titulo']+'"></i></button>';
        }
        return list;
    }else{
        console.log('arixshell_cargar_boton_simple -> error');
    }
}
function arixshell_cargar_idcontenedor_en_secondary(id){
    var id = id.replace(" ", "");
        id = id.replace("#", "");
    $('#nav-idont-know ul:last').attr('id', 'btn'+id);
    $('#use-container-secondary').html('<div class="row" id="'+id+'"></div>');
}
function arixshell_mostrar_targeta_borde_color(estado = true){
    return estado==true?"border-success":"border-danger";
}
function arixshell_mostrar_targeta_imagetop_simple(image, titulo, subtitulo, fecha, btns='btn-detalles,btn-borrar', uid = '_error_de_cifrado_'){
    return '<div class="card card-arix" style="font-size: 12px;"><img loading="lazy" src="'+image+'" class="card-img-top img-fluid" alt="..."> <div class="card-body"><dl class="dl-horizontal"><dt>'+
    titulo.substring(0,34)+'</dt><dd>'+subtitulo.substring(0,34)+'</dd></dl></div><div class="card-footer text-muted d-flex align-items-left justify-content-between" style="margin-top: -20px;"><span class="text-info" style="margin-top: 4px">'+
    fecha+'</span><div class="btn-group btn-group-sm" style="margin: -3px" id="'+uid+'">'+arixshell_cargar_boton_simple(btns)+'</div></div></div>';
}
function arixshell_mostrar_targeta_imageleft_simple(image, titulo, subtitulo, subtitulo2, subtitulo3, fecha, estado = true, btns='btn-detalles,btn-borrar', uid = '_error_de_cifrado_'){
    return '<div class="card card-arix '+arixshell_mostrar_targeta_borde_color(estado)+'" style="font-size: 12px;"> <div class="card-header">'+titulo+'</div><div class="row no-gutters"> <div class="col-md-2"> <img loading="lazy" class="img-fluid" style="margin: 1px" src="'+
    image+'" alt="..."> </div><div class="col-md-10"> <div class="card-body"> <ul class="list-unstyled" style="margin: 0px"><dt>'+subtitulo+'</dt><li>'+subtitulo2+'</li><li>'+subtitulo3+'</li></ul></div></div></div><div class="card-footer text-muted d-flex align-items-left justify-content-between"> <span class="text-info" style="margin-top: 4px">'+
    fecha+'</span> <div class="btn-group btn-group-sm" style="margin: -3px" id="'+uid+'">'+arixshell_cargar_boton_simple(btns)+'</div></div></div>';    
}
//solucion
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
//Cuando haces click en algundo de los menus 
$('#layoutSidenav_nav').on("click", ".nav-link", function() { //Clic en alguno de los elementos del munu
    $('#use-container-secondary').html('');//reestablce el primer contenedor
    var a = $(this).attr('controller'), b = $(this).text();//titulo
    arixshell_cargar_paginas(window.location.href+'/'+a);
    $('#sidenavAccordion').find('a').removeClass('active');
    $(this).addClass('active');
    arixshell_cargar_third_subtitulo(b);//esto debe ser generalizado (titulo,url,position)
});
//AQUI AFECTA
//no usa pila, registra las ultimas paginas visitadas
//FUNCION OBSOLETA
function arixshell_hacer_pagina_rollback(){
    var last_page = sessionStorage.getItem('last_page'), titulo = new Array(); 
    last_page = JSON.parse(last_page);
    $("#user-title-breadcrumb li").each(function(){titulo.push($(this).text());});
    //arixshell_cargar_titulo(titulo[titulo.length-2],titulo.length);
    arixshell_cargar_paginas(last_page[1],last_page[0]);
    console.log(last_page);
}
// EN DESARROLLO
function arixshell_crear_cache(){
    sessionStorage.setItem("pages", false);

    //para leer
    leer = sessionStorage.getItem('pages');
    leer = JSON.parse(leer); //esto es un array
    //para escribir
    escribir = ["Manzana", "Banana"];
    sessionStorage.setItem('pages', JSON.stringify(escribir));


}
//usa pila, ultimo en entrar ultimo en salir 
function arixshell_hacer_pagina_atras(){

}
function arixshell_hacer_pagina_reiniciar(){
    $('#layoutSidenav_nav .active').click();
}
function arixshell_actualizar_sucursal(a){
    if (!$.isNumeric(a)) {
        return arixshell_upload_datos('arixapi/arixapi_change_sucursal','data='+a);
    }else{
        return '_error_de_cifrado';
    }
}
$('#sucursal-db-list').on("click", ".dropdown-item", function() { //Clic en alguno de los elementos del munu
    var a = $(this).attr('id');
    a = arixshell_actualizar_sucursal(a);
    if(typeof(a)==='boolean') {
        arixshell_cargar_sucursal();
        arixshell_cargar_sucursal_lista();        
        arixshell_hacer_pagina_reiniciar();
        number = $('#sucursal-db-list').first().text();number = number.split(',');
        $('#user-title-breadcrumb li').first().text(number[0]);//actualiza el numero de la sucursal
    }else{
        //location.reload();
        //puede que haya cambiado los permisos
        return;
    }    
});
function arixshell_cargar_lista_cards(tabla,btns='btn-detalles,btn-borrar',cant){
    lista = arixshell_upload_datos('arixapi/arixapi_cargar_lista_card','data='+tabla+'&cant='+cant);
    if (lista != false) {
        var elocation = '#use-container-secondary';
        $(elocation).html('');//borras los registros actuales
        for (var i = 0; i < lista.length; i++) { 
            temp = arixshell_mostrar_card_users(lista[i].fotografia,lista[i].nombres+', '+lista[i].paterno+' '+lista[i].materno, lista[i].documento+' - '+lista[i].codigo, lista[i].codigo, lista[i].fregistro,lista[i].fregistro, lista[i].fregistro, btns, lista[i].uid);         
            $(elocation).append(temp);//agregas al final
        }
    }else{
        console.log('arixshell_cargar_lista_cards -> error');
    }
}
/*----------------REDESARROLLAR MODULO DE TITULOS---------*/

/*--------------------------MAIN----------------*/
//arixshell_probar_url();
//arixshell_localdata_restarting();
arixshell_cargar_apps();
arixshell_cargar_titulo_page();
arixshell_cargar_sucursal();
arixshell_cargar_auto_subtitulos();
arixshell_cargar_menu();
arixshell_cargar_usuario();
arixshell_cargar_sucursal_lista();