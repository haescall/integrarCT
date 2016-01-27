/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function editValorHoraConsultorXConsultoria() {
    consecutivo_id = $(this).attr("data-id-consecutivo");
    valor_hora_consultoria = $("#valor_hora_consultoria").val();

    //alert("El codigo del consultor es : " + consultor_id);
    //alert("El codigo de la consultoria es : " + consultoria_id);

    $.getJSON("/integrarCT/consultorias_consultores/editar_valor_hora_consultor_consultoria_ajax.php",
            {
                id_consecutivo: consecutivo_id,
                valor_hora_consultoria: valor_hora_consultoria
            },
    mensajeExito);
}