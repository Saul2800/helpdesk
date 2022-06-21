<?php
//insertar aqui el correo
$nombre = $correo = "";
$nombre_err = $correo_err = "";
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
         <link rel="stylesheet" href="css/our.css">
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
<form action="testmailer.php" method="post">
            <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                <input required placeholder="Nombre"type="text" name="nombre" class="fadeIn second" value="<?php echo $nombre; ?>"><br>  
                <span class="help-block"><?php echo $nombre_err; ?></span><br>
            </div>
            <div class="form-group <?php echo (!empty($correo_err)) ? 'has-error' : ''; ?>">
                <input required value="<?php echo $correo; ?>" id="correo" placeholder="correo@algo.com" type="email" name="correo" class="fadeIn third"><br>
                <span class="help-block"><?php echo $correo_err; ?></span><br>
            </div>
            <input type="hidden"value="1" name="EM">
            <div class="form-group">
            <input onclick="forgpssw()" type="submit" class="fadeIn fourth" value="ENVIAR">
            </div>
    </form>
<!--Remind Passowrd -->
  </div>
</div>
    </body>
</html>

<script language="JavaScript">
function forgpssw(){
    if (alert('Sus datos seran enviados revise su correo con regularidad para recibir la respuesta')){
    }
}
</script> 