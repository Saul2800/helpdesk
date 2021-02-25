<?php
//mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'lib/mailer/Exception.php';
require 'lib/mailer/PHPMailer.php';
require 'lib/mailer/SMTP.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->IsSMTP();
$nombre = $correo = "";
$nombre_err = $correo_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

// Check if nombre is empty
    if(empty(trim($_POST["nombre"]))){
        $nombre_err = "Por favor ingrese su nombre ";
    }

    // Check if correo is empty
    if(empty(trim($_POST["correo"]))){
        $correo_err = "Por favor ingrese su correo.";
    } 

    // Validate credentials
if(empty($nombre_err) && empty($correo_err)){
$mail->From = $_POST['correo']; //remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //seguridad
$mail->Host = "smtp.gmail.com"; // servidor smtp
$mail->Port = 587; //puerto
$mail->Username ='algo@gmail.com'; //nombre usuario
$mail->Password = ''; //contraseña
 
//Agregar destinatario
$mail->AddAddress($_POST['correo']);
$mail->Subject = "Password";
$nombre=$_POST['nombre'];
$mail->Body = "HelpDeskJEE"."\nSoy: ".$nombre . "\nY olvide mi Password" . "\nQuiciera recuperarlo" . "\nAl correo: " . $correo;
 
//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
    echo'<script type="text/javascript">
           alert("Enviado Correctamente");
        </script>';
        $send=true;
} else {
    $send=false;
    echo'<script type="text/javascript">
           alert("NO ENVIADO, intentar de nuevo");
        </script>';
}
    }
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">  
        <title>Recuperar password</title>                                       <!--Titulo a pestañaa-->
        <link rel ="icon" type="icon/png" href="recursos/gasvalid_logo.jpeg">           <!--Icono a pestaña-->
        <link rel="stylesheet" type="text/css" href="css/login.css">        <!--estilo del login css-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="libraries/bootstrap4/bootstrap.min.css"> <!--libreria Para el cel-->
         <link rel="stylesheet" href="css/micss.css">
    </head>
    <body>
  <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Icon -->
    <div class="fadeIn first">
      <h1>Recuperar Password</h1> <!--Titulo-->
      <h4>Envie sus datos al administrador</h4>
    </div>
    <!-- Creamos el Formulario-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                <input placeholder="Nombre"type="text" name="nombre" class="fadeIn second" value="<?php echo $nombre; ?>"><br>  
                <span class="help-block"><?php echo $nombre_err; ?></span><br>
            </div>
            <div class="form-group <?php echo (!empty($correo_err)) ? 'has-error' : ''; ?>">
                <input id="correo" placeholder="correo@algo.com" type="text" name="correo" class="fadeIn third"><br>
                <span class="help-block"><?php echo $correo_err; ?></span><br>
            </div>


            <?php if($send!=true): ?>
            <div class="form-group">
            <input type="submit" class="fadeIn fourth" value="ENVIAR">
                <?php endif; ?>
                <?php if($send): ?>
                <h3>Revise su correo el administrador<br> te contactará para resolver el problema,<br> disculpe las molestias.</h3>
                <?php endif; ?>
            </div>

    </form>
<!--Remind Passowrd -->
  </div>
</div>
    </body>
</html>