<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--<div class="card card-arix border-warning" style="font-size: 12px;">
   <div class="card-header">VICTOR JHAMPIER CAXI MAQUERA
   </div>
   <div class="row no-gutters">
      <div class="col-md-2">
         <img class="img-fluid" style="margin-top: 1px" src="public/images/users/tu39hnri84fheg.png" alt="...">
      </div>
      <div class="col-md-10">
         <div class="card-body">
            <ul class="list-unstyled" style="margin: 0px">
              <dt>This line rendered as bold text</dt>
              <li>Consectetur adipiscing elit</li>
              <li>Integer molestie lorem at massa</li>
            </ul>            
         </div>
      </div>
   </div>
   <div class="card-footer text-muted d-flex align-items-left justify-content-between">
      <span class="text-info">Alctualizado: </span>
      <div class="btn-group btn-group-sm" style="margin: -3px">VICTOR JHAMPIER
      </div>
   </div>
</div>-->

<script type="text/javascript">
$(document).ready(function(){    
    arixshell_cargar_botones_menu('btn-agregar,btn-listar,btn-imprimir,btn-actualizar');
    arixshell_cargar_boton_buscar('Buscar por DNI');
    axconfiguraciones_mostrar_icono_usuarios();
    
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