<?php

	/*Datos de conexion a la base de datos*/
	define('DB_HOST', 'localhost');//DB_HOST:  generalmente suele ser "127.0.0.1"
	define('DB_USER', 'root');//Usuario de tu base de datos
<<<<<<< HEAD
	define('DB_PASS', 'SAKAI');//Contraseña del usuario de la base de datos
=======
	define('DB_PASS', '');//Contraseña del usuario de la base de datos
>>>>>>> df47c411da30ac82090ab893589310ab55a8c9bf
	define('DB_NAME', 'ticketly');//Nombre de la base de datos

	$con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        @die("<h2 style='text-align:center'>Imposible conectarse a la base de datos! </h2>".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        @die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
?>