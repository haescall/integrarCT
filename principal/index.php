<?php
//Proceso de conexion a la BD
//$conex = mysql_connect("localhost", "root", "") or die("No se puede realizar la conexión");
//mysql_select_db("integrarct", $conex) or die("ERROR con la base de datos");
//Inicia una sesión para el usuario o la continua si ya está abierta
//session_start();

include_once '../config/dbconfig.php';

//validar si está logueado actualmente
if (!$_SESSION) {
    header("location:../login.php");
}
?>


<!doctype html>
<html lang="es">
    <head>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../resources/css/integrarct.css">
        <!-- <link rel="stylesheet" href="../bootstrap/css/main.css">
         <link rel="stylesheet" href="../bootstrap/css/miestilo.css">
         <link rel="stylesheet" href="../bootstrap/css/estilo.css">
         <link rel="stylesheet" href="../bootstrap/css/carrusel.css">-->

        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Integrar - Inicio</title>
    </head>
    <body>

        <?php
        if ($_SESSION['codigo_rol'] == 1) {
            include_once '../principal/menu_admin.php';
        } else {
            include_once '../principal/menu_consultor.php';
        }
        ?>
        <iframe name="content" id="content" height="90%" width="100%">
        </iframe>
    </body>
</html>
