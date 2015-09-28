/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function buscarConsultoresConsultoria() {
    $("#consultores").empty();
    $("#nom_consultoria").empty();
    $("#msg").empty();

    id_control = $(this).attr("id");
    consultoresXConsultoria(id_control);

    //alert("El id del control es : " + id_control);
}

function consultoresXConsultoria(id_control) {
    consultoria_id = $("#" + id_control).attr("data-id-consultoria");
    nombreConsultoria = $("#" + id_control).attr("data-nombre");
    codigoProceso = $("#" + id_control).attr("data-proceso");
    $("#titulo_asig").html("Lista y Asignación de Consultores (" + nombreConsultoria + ")");
    
    $.getJSON("/integrarCT/consultorias_consultores/consultores_x_consultoria_ajax.php",
            {
                consultoria_id: consultoria_id
            },
    mostrarConsultoresXConsultoria);
}

function mostrarConsultoresXConsultoria(data) {
    //alert(data);
    var filas = "";
    for (var i = 0; i < data.length; i++) {
        filas += "<tr><td>" + data[i].id_consultor + "</td><td>" + data[i].nombres + "</td>" +
                "<td>" + data[i].cargo + " </td><td>" + data[i].valor_hora_consultoria + " </td>" +
                "<td>" + data[i].estado_consultor + " </td>";

        //alert("El valor de si tiene ejecuciones es : " + data[i].ejecuto);
        if (data[i].ejecuto > 0) {
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
        }
    }

    //$('tr:last', $("#consultores")).append(filas);
    //alert(filas);
    //$("#consultores").append(filas);
    $("#consultores").html(filas);
    $(".dlg_borrar_consultor").click(borrarConsultorXConsultoria);
    $(".dlg_inactivar_consultor").click(inactivarConsultorXConsultoria);
    listaConsultoresDispPorConsultoria();
}

function listaConsultoresDispPorConsultoria() {

    $.getJSON("/integrarCT/consultorias_consultores/consultores_disp_x_consultoria_ajax.php",
            {
                consultoria_id: consultoria_id
            },
    getConsultoresDispPorConsultoria);
}

function getConsultoresDispPorConsultoria(data) {
    //alert(data);
    var formAddConsultor = '<select id="consultor" required="true"><option value="">Consultores disponibles...</option>';
    for (var i = 0; i < data.length; i++) {
        formAddConsultor += '<option value="' + data[i].id + '">' + data[i].nombres + '</option>';
    }
    formAddConsultor += "</select>";
    formAddConsultor += '&nbsp;&nbsp;<input type="number" size="100" required="true" maxlength="11"' +
            'id="valor_hora" placeholder="Valor hora del consultor en la consultoría" />' +
            '&nbsp;&nbsp;<button id="add_consultor" class="btn btn-large btn-info">' +
            '<i class="glyphicon glyphicon-plus"></i> Adicionar Consultor</button>';

    $("#cosultores_disp").html(formAddConsultor);
    $("#add_consultor").click(adicionarConsultorAConsultoria);
}