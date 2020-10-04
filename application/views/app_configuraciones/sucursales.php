<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
$(document).ready(function(){
	//SUCURSALES cargar aqui solo las llamadas a las funciones 
	arixshell_iniciar_llaves_locales("#btn_id_sucursales_1","#con_id_sucursales_1");//crea los lugares donde se cargarán los botones y el contenido _ CADAUNO DEBEN SER ÚNICOS
	arixshell_cargar_botones_menu('btn-agregar, btn-listar, btn-descargar');
    //lo siguiente muestra los detalles de una sucursal
   	axconfiguraciones_mostrar_icono_sucursales('btn-detalles,btn-terminar');
   	$(arixshell_cargar_llave_local(1)+' .card').on("click", ".btn-detalles", function() {//este click solo funciona en esta página
        var a = $(this).closest('div').attr('id');
        //arixshell_write_cache_serial(a);
        var int = confirm('eres un nepe');
        console.log(int);
        arixshell_cargar_contenido(window.location.href+'/sucursales_detail','Tienda N100');
    });
    
    $(arixshell_cargar_llave_local(0)).on("click", ".btn-agregar", function() {
    	//alert('estoy aqui;');
        arixshell_cargar_contenido(window.location.href+'/sucursales_sub1');
    });
});
//arixshell_cargar_contenido([url fuente string],[nombre string],[posicion del subtitulo int >= 4])
//arixshell_iniciar_llaves_locales([id area de botones],[]);
</script>
