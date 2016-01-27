/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function recordarPassword() {
    email = $("#email").val();

    alert("el email es : " + email);

    $.getJSON("/integrarCT/usuarios/recordar_password_ajax.php",
            {
                email: email
            },
            getPasswordUsuario);
}


function getPasswordUsuario(data) {
    //alert(data);
    alert(data.password);
    //$("#valor").attr("value",data.valor_hora_consultoria * $("#horas_laboradas").val());
}
