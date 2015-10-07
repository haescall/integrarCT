<?php

	session_start();
	//Definimos las variables de sesion y redirigimos a la pagina de usuario
	if ($_SESSION['nombre']){
		session_destroy();
		header("location:login.php");

	}else{
		header("location:login.php");
	}

?>