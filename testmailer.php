<?php
/*Clase que inicia el phpMailer para el envío de correos; Jose Luis Caamal Ic 08/03/2021
Actualización, ya configurado para el servidor :D*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
/*Inician los requires*/
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require_once "vendor/autoload.php";

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
//Enable SMTP debugging.
$mail->SMTPDebug = 3;   //Esto se comenta para no mostrar el debug en producción                            
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
//$mail->Host = "smtp.gmail.com"; Host Google
$mail->Host = "smtp.hostinger.mx"; //Servidor Hostinger
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "info@helpdesk.kaabcode.com";                 
$mail->Password = "Kaabcode2021$"; //Aquí va la constraseña del que enviará                         
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to
$mail->Port = 587;     //El puerto   SMTP                           

$mail->From = "info@helpdesk.kaabcode.com";//Correo del usuario que envia
$mail->FromName = "Información HelpDesk"; //Nombre del usuario que envia

$mail->addAddress("jose.caamal@alumnos.udg.mx", "Recepient Name");  //Correo del que recibe
$mail->isHTML(true);

$mail->Subject = "Notificación Portal HelpDesk"; //Aquí va el titulo del correo
$mail->Body = "<i>Esto es una prueba.</i>"; //Cuerpo del correo
$mail->AltBody = "Esto es una prueba.";

/*Se imprime en caso de tener errores*/
try {
    $mail->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
