/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function borrarEjecucionXConsultoria() {
    consecutivo_id = $(this).attr("data-id-consecutivo");
    //consultoria_id = $(this).attr("data-id-consultoria");

    //alert("el consecutivo es : " + consecutivo_id);
    //alert("El codigo del consultor es : " + consultor_id);
    //alert("El codigo de la consultoria es : " + consultoria_id);


    $.confirm({
        title: 'Confirmar Acción!',
        content: '¿Esta seguro de proceder con la operación?',
        confirm: function () {
            $.getJSON("/integrarCT/consultorias_ejecutadas/borrar_ejecucion_x_consultoria_ajax.php",
                    {
                        id_consecutivo: consecutivo_id
                    },
            respuestaBorrarEjecucion);
        },
        cancel: function () {
            //alert('Canceled!')
        }
    });


    /*if (confirmarAccion()) {
     $.getJSON("/integrarCT/consultorias_ejecutadas/borrar_ejecucion_x_consultoria_ajax.php",
     {
     id_consecutivo: consecutivo_id
     },
     respuestaBorrarEjecucion);
     }*/
}

function respuestaBorrarEjecucion(data) {
    //Actualiza la lista de ejeuciones de la consultoria actual
    getEjecucionesXConsultoria();

    //Mensaje de Respuesta
    mensajeRespuesta(data.exito);

}