/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function buscarConsultoresConsultoria() {
    $("#consultores").empty();
    consultoria_id = $(this).attr("data-id");

    //alert("El codigo de la consultoria es : " + consultoria_id);

    $.getJSON("/integrarCT/consultorias_consultores/consultores_x_consultoria.php",
            {
                consultoria_id: consultoria_id
            },
    mostrarConsultores);
}

function mostrarConsultores(data) {
    //alert(data);
    var filas = "";
    for (var i = 0; i < data.length; i++) {
        filas += "<tr><td>" + data[i].id + "</td><td>" + data[i].nombres + "</td>\n\
                  <td>" + data[i].cargo + " </td><td></td></tr>";
    }

    //$('tr:last', $("#consultores")).append(filas);
    //alert(filas);
    //$("#consultores").append(filas);
    $("#consultores").html(filas);
}

