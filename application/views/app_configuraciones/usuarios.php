<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
$(document).ready(function(){    
    arixshell_cargar_botones_menu('btn-agregar,btn-listar,btn-imprimir,btn-actualizar');
    arixshell_cargar_boton_buscar('Buscar por DNI');
    var  a = arixshell_mostrar_card_users('public/img', 'victor jhapier caxi', '48207109', 'tu papi', 'tu mami', 'tu papi', '1994,346','btn-detalles,btn-borrar', 'uruddjshfoe846rgoughief9w75y9');
    $('#use-container-secondary').append(a);
    $('#use-container-secondary').on("click", "button", function() {
        var a = $(this).attr('uid');
        alert(a);
    });
}); 
</script>