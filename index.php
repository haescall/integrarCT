<?php

//Proceso de conexion a la BD
$conex = mysql_connect("localhost","root", "") or die ("No se puede realizar la conexión");

mysql_select_db("integrar",$conex) or die ("ERROR con la base de datos");

//Inicia una sesión para el usuario o la continua si ya está abierta
session_start();

//validar si está logueado actualmente
if (!$_SESSION){
    header("location:login.php");
}

?>


<!doctype html>
<html lang="es">
<head>


    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/main.css">
    <link rel="stylesheet" href="bootstrap/css/miestilo.css">
    <link rel="stylesheet" href="bootstrap/css/estilo.css">
    <link rel="stylesheet" href="bootstrap/css/carrusel.css">


    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="UTF-8">
    <title>Integrar - Inicio</title>
</head>
<body>

<?php include_once 'menu_admin.php'; ?>




</body>
</html>
