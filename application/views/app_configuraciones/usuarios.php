<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
$(document).ready(function(){    
    arixshell_cargar_botones_menu('btn-agregar,btn-listar,btn-imprimir,btn-actualizar');
    arixshell_cargar_boton_buscar('Buscar por DNI');
    var  a = arixshell_cargar_lista_cards('usuarios','btn-detalles,btn-borrar',14);
    $('#use-container-secondary').on("click", "button", function() {
        var a = $(this).attr('uid');
        alert(a);
    });
    //cuando haces click en el boton + -- AGREGAR
    $('main #nav-item-input-botones').on("click", ".btn-agregar", function() {
    	arixshell_cargar_paginas(window.location.href+'/usuarios_nuevo');
    });
}); 
</script>