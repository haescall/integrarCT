/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function buscarConsultoresConsultoria() {
    $("#consultores").empty();
    
    //alert("el valor inicio es la consultoria es : " + consultoria_id);
    
    if (consultoria_id === undefined || consultoria_id === "") {
        //alert("Asigno el valor");
        consultoria_id = $(this).attr("data-id-consultoria");
    }

    //alert("El codigo de la consultoria es : " + consultoria_id);

    $.getJSON("/integrarCT/consultorias_consultores/consultores_x_consultoria_ajax.php",
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
                  <td>" + data[i].cargo + " </td>";

        if (data[i].ejecuto === 0) {
            filas += "<td align=\"center\"><a href=\"#\" data-id=\"" +
                    data[i].id + "\" data-id-consultoria=\"" +
                    consultoria_id + "\" class=\"dlg_inactivar_consultor\" " +
                    "title=\"Inactivar consultor\">" +
                    "<i class=\"glyphicon glyphicon-edit\"></i></a></td></tr>";
        } else {
            filas += "<td align=\"center\"><a href=\"#\" data-id=\"" +
                    data[i].id + "\" data-id-consultoria=\"" +
                    consultoria_id + "\"class=\"dlg_borrar_consultor\" " +
                    "title=\"Borrar consultor\">" +
                    "<i class=\"glyphicon glyphicon-remove-circle\"></i></a></td></tr>";
        }
        // $("dlg_borrar_consultor").trigger("click");


        /*//alert("El ejecuto es : " + data[i].ejecuto);
         if (data[i].ejecuto === 0) {
         filas += "<td align=\"center\">\n\
         <a href=\"inactivar-consultor_en_consultoria.php?codigo_consultor=" +
         data[i].id + "\"" + "title=\"Inactivar consultor\">\n\
         <i class=\"glyphicon glyphicon-edit\"></i></a></td></tr>";
         } else {
         filas += "<td align=\"center\">\n\
         <a href=\"delete_consultor_en_consultoria.php?codigo_consultor=" +
         data[i].id + "\"" + "title=\"Borrar consultor\">\n\
         <i class=\"glyphicon glyphicon-remove-circle\"></i></a></td></tr>";
         }*/
    }

    //$('tr:last', $("#consultores")).append(filas);
    //alert(filas);
    //$("#consultores").append(filas);
    $("#consultores").html(filas);
    $(".dlg_borrar_consultor").click(borrarConsultorXConsultoria);
}

