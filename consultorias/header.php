<?php
require_once '../principal/seguridadPHP.php';
?>

<!doctype html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />̣
        <title>Consultorías</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap-datepicker.css">

        <script src="../resources/js/comun_consultoria.js"></script>
        <script src="../resources/js/consultores_x_consultoria.js"></script>
        <script src="../resources/js/borrar_consultor_x_consultoria.js"></script>
        <script src="../resources/js/inactivar_consultor_x_consultoria.js"></script>
        <script src="../resources/js/adicionar_consultor_a_consultoria.js"></script>

        <script src="../resources/js/presupuestar_x_consultoria.js"></script>
        <script src="../resources/js/borrar_presupuesto_x_consultoria.js"></script>
        <script src="../resources/js/adicionar_presupuesto_a_consultoria.js"></script>
        <script src="../resources/js/editar_valor_hora_consultor_consultoria.js"></script>

        <!-- Load jQuery and bootstrap datepicker scripts -->
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap-datepicker.js"></script>
    </head>
    <body onload="inicializar();">

        <div class="container">
            <div class="alert alert-info">
                <strong>Administración de Consultorías</strong>
            </div>
        </div>
