<?php

include_once '../config/dbconfig.php';
include_once '../librerias/PHPMailer/class.phpmailer.php';
include_once '../librerias/PHPMailer/class.smtp.php';
include_once '../librerias/PHPMailer/PHPMailerAutoload.php';


//echo json_encode($crud_usuario->getPass($_GET['email']));
//echo json_encode($crud_usuario->getPass($_GET['email'])['password']);
//exit();

$mensaje = array(
    'mensaje' => 'Se envio un correo electronico a su cuenta registrada en el sistema.'
);

$pass = $crud_usuario->getPass($_GET['email'])['password'];
$msjCorreo = 'Su contraseña de ingreso a la plataforma de registro de tiempo es: ' . $pass;
$para = $_GET['email'];
$titulo = 'Recuperación de Contraseña plataforma registro de tiempos';
$header = 'From: Integrar Consultoría SAS - Plataforma de Ingreso de Tiempos';

echo enviarPassword();
//echo enviarMail();
exit();

function enviarMail() {
    global $mensaje;
    global $para;
    global $titulo;
    global $msjCorreo;
    try {
        $mail = new PHPMailer();  // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        //$mail->Host = 'smtp.gmail.com';
        //$mail->Port = 587;
        //$mail->Username = 'correos.integrar@gmail.com';
        //$mail->Password = "aeiou2016";
        //$mail->Host = 'mail.integrarconsultoria.com.co';
        //$mail->Port = 26;
        $mail->Host = 'rsb19.rhostbh.com';
        $mail->Port = 465;
        $mail->Username = 'integtm1';
        $mail->Password = 'A$*59Efu5xP?';
        $mail->SetFrom("integtm1@integrarconsultoria.com.co", "IntegrarCT");
        $mail->Subject = $titulo;
        $mail->Body = $msjCorreo;
        $mail->AddAddress($para);
        if ($mail->Send()) {
            return json_encode($mensaje);
        } else {
            $mensaje['mensaje'] = 'Se presento un problema enviado el mensaje de correo electronico';
            return json_encode($mensaje);
        }
    } catch (Exception $exc) {
        echo json_encode($exc->getTraceAsString());
    }
}

$email_from = "integtm1@integrarconsultoria.com.co";
$headers = 'From: ' . $email_from . "\r\n" .
        'Reply-To: ' . $email_from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

function enviarPassword() {
    global $mensaje;
    global $para;
    global $titulo;
    global $msjCorreo;
    global $headers;
    try {
        if (mail($para, $titulo, $msjCorreo, $headers)) {
            return json_encode($mensaje);
        } else {
            $mensaje['mensaje'] = 'Se presento un problema enviado el mensaje de correo electronico';
            //echo $mensaje;
            return json_encode($mensaje);
        }
    } catch (Exception $exc) {
        echo json_encode($exc->getTraceAsString());
    }
    return json_encode($mensaje);
}
