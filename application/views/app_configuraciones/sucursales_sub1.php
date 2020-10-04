<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
	<h1>pagina sub-1</h1>
</div>
<script type="text/javascript">
	arixshell_iniciar_llaves_locales("#btn_id_sucursales_sub1","#con_id_sucursales_sub1");
	arixshell_cargar_botones_menu('btn-atras,btn-agregar');
	$(arixshell_cargar_llave_local(0)).on("click", ".btn-atras", function() {
        arixshell_hacer_pagina_atras();
    });
    $(arixshell_cargar_llave_local(0)).on("click", ".btn-agregar", function() {
    	arixshell_cargar_contenido(window.location.href+'/sucursales_sub2','sub 2',4);
    });
</script>
