<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
    arixshell_cargar_idsec_unicos_byc("#btn_id_usuarios_1","#con_id_usuarios_1");
    arixshell_cargar_botones_menu('btn-agregar,btn-listar,btn-imprimir,btn-actualizar');
    //arixshell_cargar_boton_buscar('Buscar por DNI');
    axconfiguraciones_mostrar_icono_usuarios('btn-detalles');//donde lo voy a cargar debe decir
    $(arixshell_descargar_idsec_unicos_byc(1)+' .card').on("click", "button", function() {//click unico en la página
        var a = $(this).closest('div').attr('id');
        alert('-> '+a);
    });
    $(arixshell_descargar_idsec_unicos_byc(0)).on("click", ".btn-agregar", function() {
    	arixshell_cargar_paginas(window.location.href+'/usuarios_nuevo');
    });
</script>