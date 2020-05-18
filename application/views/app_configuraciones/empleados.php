<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xl-4 col-md-6">
    <div class="card bg-primary text-white mb-4">
        
        <div class="card-body row" style="padding: 7px">
            <div class="col-md-3">
                <img src="https://images.unsplash.com/photo-1497316730643-415fac54a2af?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80" class="card-img" alt="...">
            </div>
            <div class="col-md-9">
                <strong>Vitor Jhampier Caxi Maquera - 48207109 </strong>
                <strong> | </strong>
                <small>BIBLIOTECA MUNICIPAL GAMALIEL CHURATA</small>
                <strong> / </strong>
                <small>DEPARTAMENTO DE CIRCULACIÓN</small>
            </div>
        </div>
        <div class="card-footer d-flex align-items-left justify-content-between">
            <div class="small text-white"><button class="btn btn-primary btn-sm">Ver detalles</button></div>
            <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-trash"></i></button>  
        </div>
     </div>
</div><div class="col-xl-4 col-md-6">
    <div class="card bg-primary text-white mb-4">
        
        <div class="card-body row" style="padding: 7px">
            <div class="col-md-3">
                <img src="https://images.unsplash.com/photo-1497316730643-415fac54a2af?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80" class="card-img" alt="...">
            </div>
            <div class="col-md-9">
                <strong>Vitor Jhampier Caxi Maquera - 48207109 </strong>
                <strong> | </strong>
                <small>BIBLIOTECA MUNICIPAL GAMALIEL CHURATA</small>
                <strong> / </strong>
                <small>DEPARTAMENTO DE CIRCULACIÓN</small>
            </div>
        </div>
        <div class="card-footer d-flex align-items-left justify-content-between">
            <div class="small text-white"><button class="btn btn-primary btn-sm">Ver detalles</button></div>
            <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-power-off"></i></button>  
        </div>
     </div>
</div>
<div class="col-xl-4 col-md-6">
    <div class="card bg-primary text-white mb-4">
        
        <div class="card-body row" style="padding: 7px">
            <div class="col-md-3">
                <img src="https://images.unsplash.com/photo-1497316730643-415fac54a2af?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80" class="card-img" alt="...">
            </div>
            <div class="col-md-9">
                <strong>Vitor Jhampier Caxi Maquera - 48207109 </strong>
                <strong> | </strong>
                <small>BIBLIOTECA MUNICIPAL GAMALIEL CHURATA</small>
                <strong> / </strong>
                <small>DEPARTAMENTO DE CIRCULACIÓN</small>
            </div>
        </div>
        <div class="card-footer d-flex align-items-left justify-content-between">
            <div class="small text-white"><button class="btn btn-primary btn-sm">Ver detalles</button></div>
            <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-power-off"></i></button>  
        </div>
     </div>
</div>

<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" id="monalexmm">
Open modal
</button>
<!-- The Modal -->
<div class="modal fade" id="monal-for-newperson">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header py-2">
            <h6 class="modal-title">Agregar Nueva Persona</h6>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    arixshell_cargar_botones_menu();
    $('#monalexmm').click(function(){         
        arixshell_cargar_subpaginas(window.location.href+'/reportes', $('#monal-for-newperson .modal-body'));
        $('#monal-for-newperson').modal('show');
        //$('#monal-for-newperson').modal('handleUpdate');
    })

    $('.modal-footer').click(function(){
        $('#monal-for-newperson').modal('hide');
    })
    //arixshell_cargar_paginas('configuraciones/usuario_nuevo',$('#monal-for-newperson').find('.row'));
    //arixshell_cargar_boton_buscar('Buscar por DNI');
}); 
</script>