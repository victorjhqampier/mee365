function axconfiguraciones_mostrar_icono_sucursales(btns='btn-detalles,btn-borrar', tipo = true){
    lista = arixshell_upload_datos('configuraciones/axconfiguraciones_cargar_lista_sucursales','type='+tipo);
    if (lista != false) {
        $('#use-container-secondary').html('');//borras los registros actuales
        for (var i = 0; i < lista.length; i++) { 
            temp = arixshell_mostrar_targeta_imagetop_simple('public/images/config/'+lista[i].imagen, lista[i].nombre, lista[i].direccion, lista[i].fregistro, btns, lista[i].uid);         
            $('#use-container-secondary').append(temp);//agregas al final
        }
    }else{
        console.log('axconfiguraciones_mostrar_lista_sucursales -> error');
    }
}
function axconfiguraciones_mostrar_icono_usuarios(btns='btn-detalles,btn-borrar', tipo = true){
    lista = arixshell_upload_datos('configuraciones/axconfiguraciones_cargar_lista_usuarios','type='+tipo);
    if (lista != false) {
        $('#use-container-secondary').html('');//borras los registros actuales
        for (var i = 0; i < lista.length; i++) { 
            temp = arixshell_mostrar_targeta_imageleft_simple(lista[i].fotografia, lista[i].nombres+' '+lista[i].paterno+' '+lista[i].materno, lista[i].documento+' - '+lista[i].codigo, 'INgeniero de sistemas', lista[i].correo, 'Actualizado el '+lista[i].fmodificacion, lista[i].estado, btns, lista[i].uid);         
            $('#use-container-secondary').append(temp);//agregas al final
        }
    }else{
        console.log('axconfiguraciones_mostrar_lista_sucursales -> error');
    }
}