<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
	<h1>pagina sub-3</h1>
</div>
<script type="text/javascript">
	arixshell_iniciar_llaves_locales("#btn_id_sucursales_sub3","#con_id_sucursales_sub3");
	arixshell_cargar_botones_menu('btn-atras');
    $(arixshell_cargar_llave_local(0)).on("click", ".btn-atras", function() {
        arixshell_hacer_pagina_rollback();
    });
</script>