/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function buscarPresupuestoConsultoria() {
    $("#presupuesto").empty();
    $("#nom_consultoria").empty();
    $("#msg").empty();

    id_control = $(this).attr("id");
    presupuestoXConsultoria(id_control);

    //alert("El id del control es : " + id_control);
}

function presupuestoXConsultoria(id_control) {
    consultoria_id = $("#" + id_control).attr("data-id-consultoria");
    nombreConsultoria = $("#" + id_control).attr("data-nombre");
    codigoProceso = $("#" + id_control).attr("data-proceso");
    $("#titulo_presu").html("Lista y Asignación de Presupuesto (" + nombreConsultoria + ")");
    $.getJSON("/integrarCT/presupuesto_consultorias/presupuesto_x_consultoria_ajax.php",
            {
                consultoria_id: consultoria_id
            },
    mostrarPresupuesto);
}

function mostrarPresupuesto(data) {
    //alert(data);
    var filas = "";
    for (var i = 0; i < data.length; i++) {
        filas += "<tr><td>" + data[i].id_fase + "</td><td>" + data[i].descripcion + "</td>" +
                "<td>" + data[i].numero_horas_presupuestadas + " </td>" +
                "<td align=\"center\"><a href=\"#\" data-id-consecutivo=\"" +
                data[i].id_consecutivo + "\" data-id-consultoria=\"" + consultoria_id +
                "\"class=\"dlg_borrar_presu\" data-id-control=\"" + id_control + 
                "\" title=\"Borrar presupuesto\">" +
                "<i class=\"glyphicon glyphicon-remove-circle\"></i></a></td></tr>";
    }

    $("#presupuesto").html(filas);
    $(".dlg_borrar_presu").click(borrarPresupuestoXConsultoria);
    listaFasesDispPorConsultoria();
}

function listaFasesDispPorConsultoria() {
    $.getJSON("/integrarCT/presupuesto_consultorias/fases_disp_x_consultoria_ajax.php",
            {
                consultoria_id: consultoria_id
            },
    getFaesDispPorConsultoria);
}

function getFaesDispPorConsultoria(data) {
    //alert(data);
    var formAddFase = '<select id="fase" required="true"><option value="">Fases Disponibles...</option>';
    for (var i = 0; i < data.length; i++) {
        formAddFase += '<option value="' + data[i].id + '">' + data[i].descripcion + '</option>';
    }
    formAddFase += "</select>";
    formAddFase += '&nbsp;&nbsp;<input type="number" size="100" required="true" maxlength="11"' +
            'id="horas_presupuestadas" placeholder="Número horas presupuestadas" />' +
            '&nbsp;&nbsp;<button id="add_presu" class="btn btn-large btn-info">' +
            '<i class="glyphicon glyphicon-plus"></i> Adicionar Presupuesto</button>';

    $("#presu_disp").html(formAddFase);
    $("#add_presu").click(adicionarPresupuestoAConsultoria);
}

