<?php
/*Clase que inicia el phpMailer para el envío de correos; Jose Luis Caamal Ic 08/03/2021*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
/*Inician los requires*/
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require_once "vendor/autoload.php";

$mail = new PHPMailer(true);

//Enable SMTP debugging.
$mail->SMTPDebug = 3;   //Esto se comenta para no mostrar el debug en producción                            
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "joseluisitmerida93@gmail.com";                 
$mail->Password = "*****"; //Aquí va la constraseña                          
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to
$mail->Port = 587;     //El puerto                              

$mail->From = "joseluisitmerida93@gmail.com";//Correo del usuario que recibe
$mail->FromName = "Full Name"; //Nombre del usuario que recibe

$mail->addAddress("jose.caamal@alumnos.udg.mx", "Recepient Name"); 

$mail->isHTML(true);

$mail->Subject = "Subject Text"; //Aquí va el titulo del correo
$mail->Body = "<i>Esto es una prueba.</i>"; //Cuerpo del correo
$mail->AltBody = "Esto es una prueba.";
/*Se imprime en caso de tener errores*/
try {
    $mail->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
