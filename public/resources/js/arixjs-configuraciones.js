/*----------------------------------------
arixshell_descargar_idsec_unicos_byc(0-1-3)
----------------------------------------
> 0 = cargar el id de los botones
> 1 = cargar el id del contenido
> 2 = los dos
-------------------------------------------*/
function axconfiguraciones_mostrar_icono_sucursales(btns='btn-detalles,btn-borrar', tipo = true){
    lista = arixshell_upload_datos('configuraciones/axconfiguraciones_cargar_lista_sucursales','type='+tipo);
    if (lista != false) {
        for (var i = 0; i < lista.length; i++) { 
            temp = arixshell_mostrar_targeta_imagetop_simple('public/images/config/'+lista[i].imagen, lista[i].nombre, lista[i].direccion, lista[i].fregistro, btns, lista[i].uid);         
            $(arixshell_descargar_idsec_unicos_byc(1)).append(temp);//agregas al final : 1 = para el contenido 0 = para los botones
        }
    }else{
        console.log('axconfiguraciones_mostrar_lista_sucursales -> error');
    }
}
function axconfiguraciones_mostrar_icono_usuarios(btns='btn-detalles,btn-borrar', tipo = true){
    lista = arixshell_upload_datos('configuraciones/axconfiguraciones_cargar_lista_usuarios','type='+tipo);
    if (lista != false) {
        for (var i = 0; i < lista.length; i++) { 
            temp = arixshell_mostrar_targeta_imageleft_simple(lista[i].fotografia, lista[i].nombres+' '+lista[i].paterno+' '+lista[i].materno, lista[i].documento+' - '+lista[i].codigo, 'INgeniero de sistemas', lista[i].correo, 'Actualizado el '+lista[i].fmodificacion, lista[i].estado, btns, lista[i].uid);         
            $(arixshell_descargar_idsec_unicos_byc(1)).append(temp);
        }
    }else{
        console.log('axconfiguraciones_mostrar_lista_sucursales -> error');
    }
}

//sucursales