<?php
require_once '../principal/seguridadPHP.php';
?>

<!doctype html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Consultorías Ejecutadas</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap-datepicker.css">
        <!--<link rel="stylesheet" href="../resources/primeui-2.1/themes/bluesky/theme.css">-->
        <link rel="stylesheet" href="../resources/jqueryui/css/jquery-ui.min.css">
        <link rel="stylesheet" href="../resources/font-awesome-4.4.0/css/font-awesome.min.css">
        <!--<link rel="stylesheet" href="../resources/primeui-2.1/production/primeui-2.1-min.css">-->
        <link rel="stylesheet" href="../resources/primeui-2.2/production/primeui-2.2-min.css">
        <link rel="stylesheet" href="../resources/jquery-confirm/jquery-confirm.min.css">
        <link rel="stylesheet" href="../resources/css/integrarct.css">

        <!-- Load jQuery and bootstrap datepicker scripts -->
        <script src="../bootstrap/js/jquery.min.js"></script>
        <!--<script type="text/javascript" src="../resources/js/jquery-1.5.min.js"></script>-->
        <script type="text/javascript" src="../resources/jqueryui/js/jquery-ui.min.js"></script>
        <!--<script type="text/javascript" src="../resources/primeui-2.1/production/primeui-2.1-min.js"></script>-->
        <script type="text/javascript" src="../resources/primeui-2.2/production/primeui-2.2-min.js"></script>
        <!--<script type="text/javascript" src="../resources/jqueryui/js/jquery.ui.draggable.js"></script>-->
        <script src="../bootstrap/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../resources/jquery-confirm/jquery-confirm.min.js"></script>
        <script type="text/javascript" src="../resources/js/funciones_comunes.js"></script>
        <script type="text/javascript" src="../resources/js/ejecuciones_x_consultoria.js"></script>
        <script type="text/javascript" src="../resources/js/borrar_ejecucion_x_consultoria.js"></script>
        <script type="text/javascript" src="../resources/js/consultor_x_consultoria.js"></script>
        <script type="text/javascript" src="../resources/js/comun_consultoria.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                //$("#con_eje").change(getEjecucionesXConsultoria);
                $("#find-ejec").click(getEjecucionesXConsultoria);
                //$("#cod_consul").change(getConsultorXConsultoria);
                //$(".ui-widget").click(getConsultorXConsultoria);
                $("#horas_laboradas").focusout(getConsultorXConsultoria);
                /*$("#fecha").click(function () {
                    alert("Hola mundo");
                });*/
                //$("#href_edit_cons_eje").click(setCodigoConsultoriaDesdeEdit);
                $('#fecha').datepicker({
                    format: "yyyy/mm/dd"
                });
            });

            //alert(hasEventListener($(document), "change"));

            $(function () {
                $("#con_eje").puidropdown({
                    filter: true
                });
                $("#cod_consul").puidropdown({
                    filter: true
                });
            });


        </script>

    </head>

    <body onload="getEjecucionesXConsultoria();">

        <div class="container">
            <div class="alert alert-info">
                <strong>Administración Consultorías Ejecutadas</strong>
            </div>
        </div>
