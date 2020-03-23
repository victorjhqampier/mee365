<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xl-12 col-md-12">
    <div class="card-group">
        <div class="card">
            <div class="card-header text-center"><strong>USUARIO</strong></div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre del empleado</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Nombre del empleado" aria-label="Recipient's username" aria-describedby="basic-addon2" readonly="true">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"><i class="fa fa-ellipsis-h"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">ID del usuario</label>
                        <input type="text" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Correo del empleado">
                    </div>

                </form>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">Probar</button>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center"><strong>SUCURSALES Y PERMISOS</strong></div>
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center"><strong>APLICACIONES</strong></div>
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    arix_cargar_ultimo_titulo('Nuevo');
    arixshell_cargar_botones_menu('btn-guardar, btn-cerrar');
    
}); 
</script>