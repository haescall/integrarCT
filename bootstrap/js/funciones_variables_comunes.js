/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var consultoria_id = "";
var consultor_id = "";
var nombreConsultoria = "";
var id_control = "";

/*$(document).ready(function () {
 
 $(".dlg_consultores_consultorias").click(buscarConsultoresConsultoria);
 //$(".dlg_borrar_consultor").click(borrarConsultorXConsultoria);
 //$(".dlg_inactivar_consultor").click(inactivarConsultorXConsultoria);
 //$("#add_consultor").click(adicionarConsultorAConsultoria);
 $("#close").click(limpiarCssMsg);
 $(".dlg_presupuesto_consultorias").click(buscarPresupuestoConsultoria);
 
 
 
 $('#fechaInicio').datepicker({
 format: "yyyy/mm/dd"
 });
 
 });*/

function inicializar() {
    $(".dlg_consultores_consultorias").click(buscarConsultoresConsultoria);
    $("#close").click(limpiarCssMsg);
    $(".dlg_presupuesto_consultorias").click(buscarPresupuestoConsultoria);

    $('#fechaInicio').datepicker({
        format: "yyyy/mm/dd"
    });
}

function limpiarCssMsg() {
    $("#msg").removeClass("alert");
    $("#msg").removeClass("alert-success");
}

function addCssMsg() {
    $("#msg").addClass("alert");
    $("#msg").addClass("alert-success");
}

function mensajeExito(data) {
    addCssMsg();
    if (data.exito === "true") {
        alert("El id del control es : " + id_control);
        alert("El proceso es : " + codigoProceso);
        if (codigoProceso === "1") {
            consultoresXConsultoria(id_control);
        } else if (codigoProceso === "2") {
            presupuestoXConsultoria(id_control);
        }
        $("#msg").html("La operación se proceso exitósamente!");
        //$("#" + id_control_trigger).trigger("click");
    } else {
        $("#msg").html("Se presento un problema desconocido ejecutando la operación!");
        //alert("Se presento un problema desconocido ejecutando la operacion");
    }
}