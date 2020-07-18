<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#glassAnimalsSong" data-song="Agnes">
            <i class="fa fa-times"></i>
          </button> 
<script type="text/javascript">
$(document).ready(function(){
	//SUCURSALES cargar aqui solo las llamadas a las funciones 
	arixshell_iniciar_llaves_locales("#btn_id_sucursales_1","#con_id_sucursales_1");//crea los lugares donde se cargarán los botones y el contenido _ CADAUNO DEBEN SER ÚNICOS
	arixshell_cargar_botones_menu('btn-agregar, btn-listar, btn-descargar');
    //arixshell_cargar_boton_buscar('Buscar por DNI');

    //lo siguiente muestra los detalles de una sucursal
   	axconfiguraciones_mostrar_icono_sucursales('btn-detalles,btn-terminar');
   	$(arixshell_cargar_llave_local(1)+' .card').on("click", "button", function() {//este click solo funciona en esta página
        var a = $(this).closest('div').attr('id');
        arixshell_write_cache_serial(a);
        arixshell_cargar_paginas(window.location.href+'/sucursales_detail');
    });
    
    $(arixshell_cargar_llave_local(0)).on("click", ".btn-agregar", function() {
    	alert('estoy aqui;');
    });

    $('#glassAnimalsSong').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var song = button.data('song') 
    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    $('#song').text(song);
  })
});
</script>