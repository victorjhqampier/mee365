<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
$(document).ready(function(){
	//SUCURSALES cargar aqui solo las llamadas a las funciones 
	arixshell_cargar_idsec_unicos_byc("#btn_id_sucursales_1","#con_id_sucursales_1");//crea los lugares donde se cargarán los botones y el contenido _ CADAUNO DEBEN SER ÚNICOS
	arixshell_cargar_botones_menu('btn-agregar, btn-listar, btn-imprimir');
    //arixshell_cargar_boton_buscar('Buscar por DNI');
   	axconfiguraciones_mostrar_icono_sucursales('btn-detalles,btn-terminar');
   	$(arixshell_descargar_idsec_unicos_byc(1)+' .card').on("click", "button", function() {//este click solo funciona en esta página
        var a = $(this).closest('div').attr('id');
        alert(a);
    });
    $(arixshell_descargar_idsec_unicos_byc(0)).on("click", ".btn-agregar", function() {
    	alert('estor ay');
    });
});
</script>