<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once '../config/dbconfig.php';

        $pass = $crud_usuario->getPass($_POST['emailPass']);
        $msjCorreo = 'Su contraseña de ingreso a la plataforma de registro de tiempo es: ' . $pass;
        $para = $_POST['emailPass'];
        $titulo = 'Recuperación de Contraseña plataforma registro de tiempos';
        $header = 'From: integtm1@integrarconsultoria.com';

        try {
            if (mail($para, $titulo, $msjCorreo, $header)) {
                echo "<script type='text/javascript' charset='UTF-8'>
            alert('Se envió un correo electrónico a su cuenta registrada en el sistema.');
            window.location.href = 'http://www.integrarconsultoria.com.co/integrarCT/login.php';
            </script>";
            } else {
                echo "<script type='text/javascript' charset='UTF-8'>
            alert('Se presento un problema enviado el mensaje de correo electrónico.');
            window.location.href = 'http://www.integrarconsultoria.com.co/integrarCT/login.php';
            </script>";
            }
        } catch (Exception $exc) {
            echo "<script type='text/javascript' charset='UTF-8'>
            alert('Se presento un problema enviado el mensaje de correo electrónico.');
            window.location.href = 'http://www.integrarconsultoria.com.co/integrarCT/login.php';
            </script>";
        }
        ?>
    </body>
</html>