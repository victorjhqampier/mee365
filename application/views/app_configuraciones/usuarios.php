<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card card-arix" style="font-size: 12px;">
    <div class="card-header">VICTOR JHAMPIER
   </div>
   <div class="row no-gutters">
      <div class="col-md-2">
         <img class="img-fluid" src="public/images/users/tu39hnri84fheg.png" alt="...">
      </div>
      <div class="col-md-10">
         <div class="card-body">
            <dl class="dl-horizontal">
            <dt class="col-sm-12">VICTOR JHAMPIER CAXI MAQUERA
            </dt>
            <dd class="col-sm-12">VICTOR JHAMPIER
            </dd>
         </dl>
            <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
         </div>
      </div>
   </div>
   <div class="card-footer text-muted d-flex align-items-left justify-content-between" style="margin-top: -20px;">
      <span class="text-info">
      fecha</span> <span class="text-secondary">Activo</span> 
      <div class="btn-group btn-group-sm" style="margin: -3px">VICTOR JHAMPIER
      </div>
   </div>
</div>

<div class="card card-arix" style="font-size: 12px;">
   <div class="card-header">VICTOR JHAMPIER
   </div>
   <div class="card-body row">
      <div class="col-md-3 text-center"> <img class="img-fluid" src="public/images/users/tu39hnri84fheg.png" alt="..."> </div>
      <div class="col-md-9">
         <dl class="dl-horizontal">
            <dt class="col-sm-12">VICTOR JHAMPIER CAXI MAQUERA
            </dt>
            <dd class="col-sm-12">VICTOR JHAMPIER
            </dd>
         </dl>
      </div>
   </div>
   <div class="card-footer text-muted d-flex align-items-left justify-content-between" style="margin-top: -20px;">
      <span class="text-info">
      fecha</span> <span class="text-secondary">Activo</span> 
      <div class="btn-group btn-group-sm" style="margin: -3px">VICTOR JHAMPIER
      </div>
   </div>
</div>
<div class="card card-arix" style="font-size: 12px;">
   <div class="card-header">VICTOR JHAMPIER
   </div>
   <div class="card-body row">
      <div class="col-md-3 text-center"> <img class="img-fluid" src="public/images/users" alt="..."> </div>
      <div class="col-md-9" style="padding: 0px; margin-left: -2px; margin-top: -3px">
         <dl class="dl-horizontal">
            <dt class="col-sm-12">VICTOR JHAMPIER CAXI MAQUERA
            </dt>
            <dd class="col-sm-12">VICTOR JHAMPIER
            </dd>
         </dl>
      </div>
   </div>
   <div class="card-footer text-muted d-flex align-items-left justify-content-between" style="margin-top: -20px;">
      <span class="text-info">
      fecha</span> <span class="text-secondary">Activo</span> 
      <div class="btn-group btn-group-sm" style="margin: -3px">VICTOR JHAMPIER
      </div>
   </div>
</div>

<script type="text/javascript">
$(document).ready(function(){    
    arixshell_cargar_botones_menu('btn-agregar,btn-listar,btn-imprimir,btn-actualizar');
    arixshell_cargar_boton_buscar('Buscar por DNI');
    //var  a = arixshell_cargar_lista_cards('usuarios','btn-detalles,btn-borrar',14);
    
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