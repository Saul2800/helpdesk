<?php	
	session_start();
	include "../config/config.php";//Contiene funcion que conecta a la base de datos
	/*Valida que el usuario y el username no se repita: Caamal Ic José Luis*/
	function validarEmailRep($varEmail,$con){
		//include "../config/config.php";
		$sql="SELECT count(*) as email_ex FROM user where email = '".$varEmail."'"; 
		//echo $sql;
		$resultado = mysqli_query($con,$sql);
		while($row = $resultado->fetch_assoc()){
			$query_exist_email = $row['email_ex'];
		}
		//echo $query_exist_email;
		if ($query_exist_email>0){
					return false;
		} else{
					return true;
		}
	}
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['name'])) {
           $errors[] = "Nombre vacío";
        } else if (empty($_POST['lastname'])){
			$errors[] = "Apellidos vacío";
		}else if (empty($_POST['email'])){
			$errors[] = "Campo de correo vacio";
		}else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ //Valida el formato Caamal Ic Jose Luis
			$errors[] = "El correo no coincide con el formato solicitado.";
		}else if(!validarEmailRep($_POST['email'],$con)){
			$errors[] = "El correo y usuario ya existe, favor de validar con el administrador o ingresa otro correo.";
		}else if ($_POST['kinduser']==""){
			$errors[] = "Selecciona el tipo de usuario";
		}else if ($_POST['status']==""){
			$errors[] = "Selecciona el estado";
		} else if (empty($_POST['password'])){
			$errors[] = "Contraseña vacía";
		}
//SAR 3/03/21
		else if ($_POST['kindProvedor']=="" && $_POST['kinduser']=="3"){
			$errors[] = "Selecciona el tipo de proveedor";
		}else if ($_POST["TELEFONO"]===""){
			$errors[] = "Digite su Teléfono";
		}else if ($_POST["DNI"]===""){
			$errors[] = "Digite su DNI";
		}
//SAR 3/03/21
		else if (
			!empty($_POST['name']) &&
			!empty($_POST['lastname']) &&
			$_POST['status']!="" &&
			$_POST['kinduser']!="" &&
			!empty($_POST['password'])
		){

		

		// escaping, additionally removing everything that could be (html/javascript-) code
		$name=mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
		$lastname=mysqli_real_escape_string($con,(strip_tags($_POST["lastname"],ENT_QUOTES)));
		$email=$_POST["email"];
		$password=mysqli_real_escape_string($con,(strip_tags(sha1(md5($_POST["password"])),ENT_QUOTES)));
		$status=intval($_POST['status']);
		$end_name=$name." ".$lastname;
		$created_at=date("Y-m-d H:i:s");
		$user_id=$_SESSION['user_id'];
		$username = $_POST['username'];
		$telefono = $_POST['TELEFONO'];
		$DNI  = $_POST['DNI'];
		$KIND =	$_POST['kinduser'];
		$KINDPROVEDOR=$_POST['kindProvedor'];
		if ($_POST['kinduser']!="3"){$KINDPROVEDOR = "";}
		$profile_pic="default.png";
		/*Inicio: Se recupera la información del tipo JLCI 20/02/2021*/
		$kinduser=intval($_POST['kinduser']);
		/*Termina: Se recupera la información del tipo JLCI 20/02/2021*/
		if($KIND==1){
			$_SESSION["kindNU_name"]="Administrador";
		}if($KIND==2){
			$_SESSION["kindNU_name"]="Usuario";
		}if($KIND==3){
			$_SESSION["kindNU_name"]="Proveedor";
		}if($KIND==4){
			$_SESSION["kindNU_name"]="MonitorTI";
		}



		$is_admin=0;
		if(isset($_POST["is_admin"])){$is_admin=1;}

			$sql="INSERT INTO user ( username, name, password, email, profile_pic, is_active, kind, created_at , dni, phone, kind_proveedor) VALUES ('$username','$end_name','$password','$email','$profile_pic',$status,$kinduser,'$created_at' ,'$DNI', '$telefono', '$KINDPROVEDOR')";
			$query_new_insert = mysqli_query($con,$sql);
				if ($query_new_insert){
					$messages[] = "El usuario ha sido ingresado satisfactoriamente.";
				} else{
					$errors []= "Lo siento algo ha salido mal en la bd intenta nuevamente.".mysqli_error($con);
				}
			
		}else{
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>