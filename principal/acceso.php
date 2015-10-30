<?php

include '../config/dbconfig.php';

$email = $_POST['email'];
$pass = $_POST['password'];


//if (isset($email)) {
//conexion con la base de datos
//$conex = mysql_connect("localhost","root", "") or die ("No se puede realizar la conexión");
//mysql_select_db("integrar",$conex) or die ("ERROR con la base de datos");
//Inicia una sesión para el usuario o la continua si ya está abierta
//session_start();
// Consultar en la BD los datos que envió el usuario
//$consulta = "SELECT * FROM users WHERE email = '$email' AND password = '$pass' ";
//	$resultado = mysql_query($consulta, $conex) or die (mysql_error());
//$fila = mysql_fetch_array($resultado);
//Si el usuario no existe en la BD
//print 'el email : ' . $email .' y el pass es : ' . $pass;
//print 'la fila es: ' . $crud_usuario->validarUsuario($email, $pass);

$usuario = $crud_usuario->validarUsuario($email, $pass);

//print 'el usuario es  : ' . $usuario['email'];
if ($usuario['email'] == "") {
    //print 'el email es : ' . $usuario['email'];
    header("location:../login.php");
}
//Si el usuario si existe en la BD
else {
    //Definimos las variables de sesion y redirigimos a la pagina de usuario
    $_SESSION['id_usuario'] = $usuario['id'];
    $_SESSION['email'] = $usuario['email'];
    $_SESSION['codigo_rol'] = $usuario['codigo_rol'];
    $_SESSION['codigo_consultor'] = $usuario['codigo_consultor'];
    //$_SESSION['tiempo'] = time();
    header("location:index.php");
}

/* }else{
  header("location:login.php");
  } */
?>