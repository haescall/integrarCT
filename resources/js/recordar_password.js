/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function recordarPassword() {
    email = $("#email").val();
    //alert("el email es : " + email);

    $.ajax({
        url: '/integrarCT/usuarios/recordar_password_ajax.php',
        type: 'POST',
        async: true,
        data: 'email=' + email,
        complete: function (jqXHR, textStatus) {
            alert("Exito");
        }
        /*,
         success: procesaRespuesta,
         error: muestraError*/
    });
    /*$.getJSON("/integrarCT/usuarios/recordar_password_ajax.php",
     {
     email: email
     },
     procesaRespuesta);*/
}

function procesaRespuesta(data) {
    //alert(data);
    //alert(data.password);
    alert(data.mensaje);
    //$("#valor").attr("value",data.valor_hora_consultoria * $("#horas_laboradas").val());
}


function muestraError() {

}