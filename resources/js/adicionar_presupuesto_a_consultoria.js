/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function adicionarPresupuestoAConsultoria() {
    fase_id = $("#fase").val();
    horas_presupuestadas = $("#horas_presupuestadas").val();

    /*alert("El codigo del consultor es : " + consultor_id);
     alert("El codigo de la consultoria es : " + consultoria_id);
     alert("El valor de la es : " + valor_hora);*/

    $.getJSON("/integrarCT/presupuesto_consultorias/adicionar_presupuesto_a_consultoria_ajax.php",
            {
                id_fase: fase_id,
                id_consultoria: consultoria_id,
                horas_presupuestadas: horas_presupuestadas
            },
    mensajeExito);
}


