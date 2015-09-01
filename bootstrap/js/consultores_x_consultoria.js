/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var consultoria_id = "";
var consultor_id = "";
var nombreConsultoria = "";

function buscarConsultoresConsultoria() {
    $("#consultores").empty();
    $("#nom_consultoria").empty();
    $("#msg").empty();

    //alert("el valor inicio es la consultoria es : " + consultoria_id);
    if ((consultoria_id === undefined && consultoria_id === "")
            || ($(this).attr("data-id-consultoria") !== undefined &&
                    consultoria_id !== $(this).attr("data-id-consultoria"))) {
        //alert("Se metio a asignar el valor de la consultoria");
        consultoria_id = $(this).attr("data-id-consultoria");
        nombreConsultoria = $(this).attr("data-nombre");
    }

    $("#titulo_asig").html("Lista y Asignación de Consultores (" + nombreConsultoria + ")");
    //alert("El valor final codigo de la consultoria es : " + consultoria_id);

    //$("#nom_consultoria").html("Nombre consultoria : " + $(this).attr("data-nombre"));

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
        filas += "<tr><td>" + data[i].id + "</td><td>" + data[i].nombres + "</td>" +
                "<td>" + data[i].cargo + " </td><td>" + data[i].valor_hora_consultoria + " </td>" +
                "<td>" + data[i].estado_consultor + " </td>";

        //alert("El valor de si tiene ejecuciones es : " + data[i].ejecuto);
        if (data[i].ejecuto > 0) {
            filas += "<td align=\"center\"><a href=\"#\" data-id-consultor=\"" +
                    data[i].id + "\" data-id-consultoria=\"" +
                    consultoria_id + "\" class=\"dlg_inactivar_consultor\" " +
                    "title=\"Inactivar consultor\">" +
                    "<i class=\"glyphicon glyphicon-edit\"></i></a></td></tr>";
        } else {
            filas += "<td align=\"center\"><a href=\"#\" data-id-consultor=\"" +
                    data[i].id + "\" data-id-consultoria=\"" +
                    consultoria_id + "\"class=\"dlg_borrar_consultor\" " +
                    "title=\"Borrar consultor\">" +
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


function limpiarCssMsg() {
    $("#msg").removeClass("alert");
    $("#msg").removeClass("alert-success");
}

function addCssMsg() {
    $("#msg").addClass("alert");
    $("#msg").addClass("alert-success");
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
            'id="valor_hora" placeholder="Valor hora del consultor en la consultoria" />' +
            '&nbsp;&nbsp;<button id="add_consultor" class="btn btn-large btn-info">' +
            '<i class="glyphicon glyphicon-plus"></i> Adicionar Consultor</button>';

    $("#cosultores_disp").html(formAddConsultor);
    $("#add_consultor").click(adicionarConsultorAConsultoria);
}

