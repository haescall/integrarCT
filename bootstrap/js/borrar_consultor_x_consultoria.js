/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var consultoria_id = "";

function borrarConsultorXConsultoria() {
    id = $(this).attr("data-id");
    consultoria_id = $(this).attr("data-id-consultoria");

    /*alert("El codigo del consultor es : " + consultor_id);
     alert("El codigo de la consultoria es : " + consultoria_id);*/

    $.getJSON("/integrarCT/consultorias_consultores/borrar_consultor_x_consultoria_ajax.php",
            {
                id: id
            },
    mensajeBorrado);
}

function mensajeBorrado(data) {
    alert("el estado del borrado es :" + data.borrado);
    if (data.borrado === "true") {
        buscarConsultoresConsultoria();
    } else {
        alert("Se presento un problema desconocido ejecutando la operacion");
    }


}

