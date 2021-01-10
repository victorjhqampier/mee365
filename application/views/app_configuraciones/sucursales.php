<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="table-responsive-md">
    <div class="row">
        <div class="col-xl-12 col-md-12">               
            <table class="table table-striped table-hover" id="dataTable_sucursales"><!-- table-sm  table-dark-->
              <thead class="thead-dark">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Núm</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Categoria</th>
                  <th scope="col">Sub categoria</th>
                  <th scope="col">Dirección</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	//SUCURSALES cargar aqui solo las llamadas a las funciones 
	arixshell_iniciar_llaves_locales("#btn_id_sucursales_1","#con_id_sucursales_1");//crea los lugares donde se cargarán los botones y el contenido _ CADAUNO DEBEN SER ÚNICOS
	arixshell_cargar_botones_menu('btn-buscar, btn-agregar');
    //lo siguiente muestra los detalles de una sucursal
   	//axconfiguraciones_mostrar_icono_sucursales('btn-detalles,btn-terminar');
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

    botns =  arixshell_cargar_botones_tabla('btn-detalles, btn-banear, btn-borrar');
    $('#dataTable_sucursales').DataTable({
        "ajax": {
            "url" : "configuraciones/axconfig_get_sucursales_simple",
            "dataSrc":""
        },
        "columns":[
            {"data": 'sucursal_id'},
            {"data": 'numero'},
            {"data": 'nombre'},
            {"data": 'categoria'},
            {"data": 'subcategoria'},
            {"data": null, render: function ( data, type, row ) {return row.direccion + ' - ' + row.distrito;}},
            {"data": 'estado',//aqui se pierde esta variable
                render: function(data, type){
                    if (data==false) {
                        $(this).find('tr').addClass( "table-danger" );
                        return data;
                    }else return data;
                }
            },
            {"data": null, render: function ( data, type, row ) {return botns;}}
        ],
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 6 ],
                "visible": false
            }
        ]
    });
});
//arixshell_cargar_contenido([url fuente string],[nombre string],[posicion del subtitulo int >= 4])
//arixshell_iniciar_llaves_locales([id area de botones],[]);
</script>
