/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function inactivarConsultorXConsultoria() {
    consultor_id = $(this).attr("data-id-consultor");
    consultoria_id = $(this).attr("data-id-consultoria");

    /*alert("El codigo del consultor es : " + consultor_id);
     alert("El codigo de la consultoria es : " + consultoria_id);*/

    $.getJSON("/integrarCT/consultorias_consultores/inactivar_consultor_x_consultoria_ajax.php",
            {
                id_consultor: consultor_id
            },
    mensajeInactivo);
}

function mensajeInactivo(data) {
    //alert("el estado del borrado es :" + data.borrado);
    addCssMsg();
    if (data.inactivo === "true") {
        buscarConsultoresConsultoria();
        $("#msg").html("El cosultor fue inactivado exitosamente!");
    } else {
        $("#msg").html("Se presento un problema desconocido ejecutando la operacion!");
        //alert("Se presento un problema desconocido ejecutando la operacion");
    }


}

