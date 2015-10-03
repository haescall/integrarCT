/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var consultoria_id = "";

function getEjecucionesXConsultoria() {

    nombreConsultoria = $(".pui-dropdown-label").html();

    $("#con_eje option").each(function () {
        if ($(this).text() === nombreConsultoria) {
            consultoria_id = $(this).attr('value');
        }
        //alert('opcion ' + $(this).text() + ' valor ' + $(this).attr('value'));
    });

    //consultoria_id = $(this).val();
    //alert("El id de la consultoria es : " + consultoria_id);

    $.getJSON("/integrarCT/consultorias_ejecutadas/ejecuciones_x_consultoria_ajax.php",
            {
                consultoria_id: consultoria_id
            },
    mostrarEjecucionesXConsultoria);
}

function mostrarEjecucionesXConsultoria(data) {
    //alert(data);

    if (data.length > 0) {
        var filas = "";
        for (var i = 0; i < data.length; i++) {
            filas += "<tr><td>" + data[i].id + "</td><td>" + data[i].fecha + "</td>" +
                    "<td>" + data[i].fase + " </td><td>" + data[i].horas_laboradas + " </td>" +
                    "<td>" + data[i].valor + " </td><td>" + data[i].actividades + " </td>";

            //alert("El valor de si tiene ejecuciones es : " + data[i].ejecuto);
            filas += "<td align=\"center\"><a href=\"edit-data_consultorias_ejecutadas.php?edit_id="+
                    data[i].id + "&data-id-consultoria="+ consultoria_id + " \"" +
                    " title=\"Editar Registro\">" +
                    "<i class=\"glyphicon glyphicon-edit\"></i></a></td>";

            filas += "<td align=\"center\"><a href=\"#\" data-id-consecutivo=\"" +
                    data[i].id + "\" data-id-consultoria=\"" + consultoria_id + "\" " +
                    "class=\"dlg_borrar_ejecucion\" title=\"Borrar ejecución\">" +
                    "<i class=\"glyphicon glyphicon-remove-circle\"></i></a></td></tr>";
        }
        $("#data").html(filas);
        $(".dlg_borrar_ejecucion").click(borrarEjecucionXConsultoria);
    } else {
        $("#data").html("");
        alert("No se encontraron datos para la consultoría");

    }
}

function setCodigoConsultoria() {

    nombreConsultoria = $(".pui-dropdown-label").html();

    $("#cod_consul option").each(function () {
        if ($(this).text() === nombreConsultoria) {
            consultoria_id = $(this).attr('value');
        }
        //alert('opcion ' + $(this).text() + ' valor ' + $(this).attr('value'));
    });

    $("select#cod_consul").val(consultoria_id);

    //$("#cod_consul > option[value='" + consultoria_id + "']").attr('selected', 'selected');
    //consultoria_id = $(this).val();
    //alert("El id de la consultoria es : " + consultoria_id);

}


/*function onloadPrimeUI() {
 $("#con_eje").puidropdown({
 filter: true
 });
 //$("#con_eje").change(getEjecucionesXConsultoria);
 }
 
 function hasEventListener(element, eventName, namespace) {
 var returnValue = false;
 var events = $(element).data("events");
 if (events) {
 $.each(events, function (index, value) {
 if (index == eventName) {
 if (namespace) {
 $.each(value, function (index, value) {
 if (value.namespace == namespace) {
 returnValue = true;
 return false;
 }
 });
 }
 else {
 returnValue = true;
 return false;
 }
 }
 });
 }
 return returnValue;
 }*/