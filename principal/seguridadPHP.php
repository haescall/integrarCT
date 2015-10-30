<?php

//session_start();
// If existe la variable de sesión "id_usuario" entonces es que un usuario ha iniciado sesión
/* if (!isset($_SESSION['id_usuario'])) {
  header("location:../login.php");
  } */


if (!isset($_SESSION['id_usuario'])) {
    header("location:../login.php");
}

//echo $_SESSION['vida_session'];

if ($_SESSION['vida_session']< time()) {
    session_destroy();
    header("location:../login.php");
    //header("Location: login.php");
}


