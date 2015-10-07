/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function borrarPresupuestoXConsultoria() {
    consecutivo_id = $(this).attr("data-id-consecutivo");
    //consultoria_id = $(this).attr("data-id-consultoria");

    //alert("el consecutivo es : " + consecutivo_id);
    //alert("El codigo del consultor es : " + consultor_id);
    //alert("El codigo de la consultoria es : " + consultoria_id);

    $.getJSON("/integrarCT/presupuesto_consultorias/borrar_presupuesto_x_consultoria_ajax.php",
            {
                id_consecutivo: consecutivo_id
            },
    mensajeExito);
}