/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function limpiarCssMsg() {
    $("#msg").removeClass("alert");
    $("#msg").removeClass("alert-success");
}

function addCssMsg() {
    $("#msg").addClass("alert");
    $("#msg").addClass("alert-success");
}


function mensajeRespuesta(estado) {
    if (estado === "true") {
        $("#msg").html("La operación se proceso exitósamente!");
    } else {
        $("#msg").html("Se presento un problema desconocido ejecutando la operación!");
    }
}

function confirmarAccion() {
    /*$.confirm({
     title: 'Confirmación de Acción!',
     content: '¿Esta seguro de proceder con la operación?',
     confirm: function () {
     return true;
     },
     cancel: function () {
     //alert('Canceled!')
     }
     });
     return false;*/
    confirmar = confirm("¿Esta seguro de proceder con la operación?");
    return confirmar;
}