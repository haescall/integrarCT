/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function borrarConsultorXConsultoria() {
    $("#consultores").empty();
    consultor_id = $(this).attr("data-id");

    //alert("El codigo de la consultoria es : " + consultoria_id);

    $.getJSON("/integrarCT/consultorias_consultores/borrar_consultor_x_consultoria_ajax.php",
            {
                consultor_id: consultor_id
            },
    mensajeBorrado);
}

function mensajeBorrado(data) {

    
    var filas = "";
    for (var i = 0; i < data.length; i++) {
        filas += "<tr><td>" + data[i].id + "</td><td>" + data[i].nombres + "</td>\n\
                  <td>" + data[i].cargo + " </td>";

        //alert("El ejecuto es : " + data[i].ejecuto);
        if (data[i].ejecuto === 0) {
            filas += "<td align=\"center\">\n\
                <a href=\"inactivar-consultor_en_consultoria.php?codigo_consultor=" +
                    data[i].id + "\"" + "title=\"Inactivar consultor\">\n\
                <i class=\"glyphicon glyphicon-edit\"></i></a></td></tr>";
        } else {
            filas += "<td align=\"center\">\n\
                <a href=\"delete_consultor_en_consultoria.php?codigo_consultor=" +
                    data[i].id + "\"" + "title=\"Eliminar consultor\">\n\
                <i class=\"glyphicon glyphicon-remove-circle\"></i></a></td></tr>";
        }
    }

    //$('tr:last', $("#consultores")).append(filas);
    //alert(filas);
    //$("#consultores").append(filas);
    $("#consultores").html(filas);
}

