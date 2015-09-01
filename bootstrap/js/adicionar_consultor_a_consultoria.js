/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function adicionarConsultorAConsultoria() {
    consultor_id = $("#consultor").val();
    valor_hora = $("#valor_hora").val();

    /*alert("El codigo del consultor es : " + consultor_id);
     alert("El codigo de la consultoria es : " + consultoria_id);
     alert("El valor de la es : " + valor_hora);*/

    $.getJSON("/integrarCT/consultorias_consultores/adicionar_consultor_a_consultoria_ajax.php",
            {
                id_consultor: consultor_id,
                id_consultoria: consultoria_id,
                valor_hora: valor_hora
            },
    mensajeAdicion);
}

function mensajeAdicion(data) {
    //alert("el estado del borrado es :" + data.borrado);
    addCssMsg();
    if (data.adicionado === "true") {
        buscarConsultoresConsultoria();
        $("#msg").html("El cosultor fue adicionado a la consultoria exitosamente!");
    } else {
        $("#msg").html("Se presento un problema desconocido ejecutando la operacion!");
        //alert("Se presento un problema desconocido ejecutando la operacion");
    }
}

