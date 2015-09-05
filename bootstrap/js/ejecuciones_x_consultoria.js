/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var consultoria_id = "";

function getEjecucionesXConsultoria() {

    consultoria_id = $(this).val();
    //alert("El id de la consultoria es : " + consultoria_id);

    $.getJSON("/integrarCT/consultorias_ejecutadas/ejecuciones_x_consultoria_ajax.php",
            {
                consultoria_id: consultoria_id
            },
    mostrarEjecucionesXConsultoria);
}

function mostrarEjecucionesXConsultoria(data) {
    alert(data);
    var filas = "";
    for (var i = 0; i < data.length; i++) {
        filas += "<tr><td>" + data[i].id + "</td><td>" + data[i].fecha + "</td>" +
                "<td>" + data[i].fase + " </td><td>" + data[i].horas_laboradas + " </td>" +
                "<td>" + data[i].valor + " </td><td>" + data[i].actividades + " </td></tr>";

        //alert("El valor de si tiene ejecuciones es : " + data[i].ejecuto);
        /*if (data[i].ejecuto > 0) {
            filas += "<td align=\"center\"><a href=\"#\" data-id-consecutivo=\"" +
                    data[i].id_consecutivo + "\" data-id-consultoria=\"" +
                    consultoria_id + "\" class=\"dlg_inactivar_consultor\" " +
                    "data-id-control=\"" + id_control + "\" title=\"Inactivar consultor\">" +
                    "<i class=\"glyphicon glyphicon-edit\"></i></a></td></tr>";
        } else {
            filas += "<td align=\"center\"><a href=\"#\" data-id-consecutivo=\"" +
                    data[i].id_consecutivo + "\" data-id-consultoria=\"" +
                    consultoria_id + "\"class=\"dlg_borrar_consultor\" " +
                    "data-id-control=\"" + id_control + "\" title=\"Borrar consultor\">" +
                    "<i class=\"glyphicon glyphicon-remove-circle\"></i></a></td></tr>";
        }*/
    }
    $("#data").html(filas);
}
