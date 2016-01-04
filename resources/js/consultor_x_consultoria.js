/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getConsultorXConsultoria() {
    $("#valor").empty();
    //consultoria_id = $(this).attr("cod_consul");

    consultoria_id = getConsultoriaIdPrimeFaces("cod_consul");

   // alert("El id de la consultoriua es :" + consultoria_id);

    $.getJSON("/integrarCT/consultorias_consultores/consultor_x_consultoria_ajax.php",
            {
                consultoria_id: consultoria_id
            },
            calcularValorXConsultoria);
}

function calcularValorXConsultoria(data) {
    //alert(data);
    //alert(data.valor_hora_consultoria);
    $("#valor").attr("value",data.valor_hora_consultoria * $("#horas_laboradas").val());
}

