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
session_start();
//SAR asignaciones: 7/03/21
$origen=$_REQUEST["EM"];
include "../config/config.php";//Contiene funcion que conecta a la base de datos
$CCmailB=false;
//recuperar correo;
if($origen=="1"){
	$nombre=$_POST["nombre"];
	$correo=$_POST["correo"];
	$contenido= "< HelpDeskJEE >\n"."\nSoy: ".$nombre . "\n olvide mi Password" . "\nquisiera recuperarlo" . "\nal correo: " . $correo;
	$destino="info@helpdeskjeee.com";	//insertar correo al cual se envia para recuperar el password
	$CCmailB=false;
	header("location: index.php");
}if($origen=="2"){					//Para mandar notificacion de que se agrego un ticket
	$titulo=$_POST["title"];
	$proyecto=$_SESSION["project_ticket_nameA"];
	$emailUasigned=$_SESSION["asignedmailNU"];//viende de addticket
	$contenido= "< HelpDeskJEE >\n"."\nSe agrego un ticket de titulo: ".$titulo .".". "\n Del Proceso Electoral: " . $proyecto;
	$destino=$_SESSION["user_email"];
	if(empty($emailUasigned)){$CCmailB=false;}
	else{
	$CCmailB=true;
	$CCmail=$emailUasigned;}
}if($origen=="3"){							//Para mandar notificacion de que se edito un ticket
	$emailAC=$_SESSION["user_email"];					
	$titulo=$_POST["title"];
	$proyecto=$_SESSION["project_ticket_name"];
	$NuevoEstatus=$_SESSION['tickets_estatus'];//viene de action/updticket.php
	$contenido= "< HelpDeskJEE >\n"."\nSe edito un ticket de titulo: ".$titulo .".". "\n Del Proceso Electoral: " . $proyecto. "."."\n Su estado es: " . $NuevoEstatus;
	$destino=$_SESSION['ticket_email'];//viene de action/updticket.php
	$emailUT=$_SESSION['asignedmailUT'];//viene de action/updticket.php
	if(empty($emailUT)){$CCmailB=false;}
	else{
	$CCmailB=true;
	$CCmail=$emailUT;}
}if($origen=="4"){					//Para mandar notificacion de que se agrego un usuario
	$emailNU=$_POST["email"];
	$nombreNU=$_POST["name"];
	$passwordNU=$_POST["password"];
	$KIND =	$_SESSION["kindNU_name"];//viene de action/adduser.php
	$contenido= "< HelpDeskJEE >\n"."\nSe agrego un miembro: ".$nombreNU .".". "\n Con el correo: " . $emailNU. "."."\n De tipo: " . $KIND."."."\n Su constraseña es: " . $passwordNU;
	$destino=$_SESSION['user_email'];
	$CCmailB=true;
	$CCmail=$emailNU;
}if($origen=="5"){					//Para mandar notificacion de que se agrego un usuario
	$emailNU=$_POST["mod_email"];
	$nombreNU=$_POST["mod_name"];
	$passwordNU=$_POST["password"];
	$KIND =	$_SESSION["kindEU_name"];//viene de action/upd_user.php
	$contenido= "< HelpDeskJEE >\n"."\nSe edito un miembro: ".$nombreNU .".". "\n Con el correo: " . $emailNU. "."."\n De tipo: " . $KIND."."."\n ->" . $passwordNU;
	$destino=$_SESSION['user_email'];
	$CCmailB=true;
	$CCmail=$emailNU;
}

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
//Enable SMTP debugging.
//$mail->SMTPDebug = 3;   //Esto se comenta para no mostrar el debug en producción                            
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
//$mail->Host = "smtp.gmail.com"; Host Google
$mail->Host = "smtp.hostinger.mx"; //Servidor Hostinger
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "info@helpdeskjeee.com";                 
$mail->Password = "HelpDesk2021$"; //Aquí va la constraseña del que enviará                         
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to
$mail->Port = 587;     //El puerto   SMTP                           

$mail->From = "info@helpdeskjeee.com";//Correo del usuario que envia
$mail->FromName = "Información HelpDesk"; //Nombre del usuario que envia

$mail->addAddress($destino, "Recepient Name");  //Correo del que recibe
if($CCmailB==true){$mail->addCC($CCmail);}
$mail->isHTML(true);

$mail->Subject = "Notificación Portal HelpDesk"; //Aquí va el titulo del correo
$mail->Body = $contenido; //Cuerpo del correo
$mail->AltBody = "HelpDesk.";

/*Se imprime en caso de tener errores*/
try {
    $mail->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
