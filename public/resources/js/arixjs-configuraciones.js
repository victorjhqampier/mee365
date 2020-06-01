function axconfiguraciones_mostrar_icono_sucursales(btns='btn-detalles,btn-borrar', tipo = true){
    lista = arixshell_upload_datos('configuraciones/axconfiguraciones_cargar_lista_sucursales','type='+tipo);
    if (lista != false) {
        $('#use-container-secondary').html('');//borras los registros actuales
        for (var i = 0; i < lista.length; i++) { 
            temp = arixshell_mostrar_targeta_imagetop_simple('public/images/config/'+lista[i].imagen, lista[i].nombre, lista[i].direccion, lista[i].fecha, btns, lista[i].uid);         
            $('#use-container-secondary').append(temp);//agregas al final
        }
    }else{
        console.log('axconfiguraciones_mostrar_lista_sucursales -> error');
    }
}