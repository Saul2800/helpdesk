<?php	
	session_start();
	$id_user = $_SESSION['user_id'];
	include "../config/config.php"; //Abrimos conexión :D
	$imageExist = 0;
	$name1 = "";
	$name2 = "";
	$folder = "../images/helpTicket/";
	if (isset($_FILES["file"]))
	{
		$imageExist = 1;

		$file = $_FILES["file"];
		$name1 = $file["name"];
		$type = $file["type"];
		$tmp_n = $file["tmp_name"];
		$size = $file["size"];
		
		
		if ($type != 'image/jpg' && $type != 'image/jpeg' && $type != 'image/png' && $type != 'image/gif')
		{
			$errors[] = "Error, el primer archivo no es una imagen";
		  $imageExist = 0;
		}
		else if ($size > 1024*1024)
		{
			$errors[] = "Error, el primer archivo tiene el tamaño máximo permitido es un 1MB";
		  $imageExist = 0;
		}
		else
		{
			if (isset($_FILES["file1"]))
			{
				
				$file = $_FILES["file1"];
				$name2 = $file["name"];
				$type = $file["type"];
				$tmp_n2 = $file["tmp_name"];
				$size = $file["size"];

				//$folder = "../images/helpTicket/";
				if ($type != 'image/jpg' && $type != 'image/jpeg' && $type != 'image/png' && $type != 'image/gif')
				{
					$errors[] = "Error, el segundo archivo no es una imagen o está vacio, se insertará solo la primera imagen ";
					//$imageExist = 0;
				}
				else if ($size > 1024*1024)
				{
					$errors[] = "Error, el segundo archivo tiene el tamaño máximo permitido es un 1MB se insertará solo la primera imagen ";
					//$imageExist = 0;
				}else{
					$src2 = $folder.$name2;
					@move_uploaded_file($tmp_n2, $src2);
				}
				
			}
			
	
		   $src = $folder.$name1;
		   @move_uploaded_file($tmp_n, $src);
		   

		}
	}
	
	/*Inicia validacion del lado del servidor*/
	//SAR 4/03/21
	if (empty($_POST['title'])) {
           $errors[] = "Titulo vacío";
        } else if (empty($_POST['description'])){
			$errors[] = "Description vacío";
		}else if (empty($_POST['category_id'])){
			$errors[] = "categoria vacía";
		}else if (empty($_POST['project_id'])){
			$errors[] = "Proyecto vacío";
		}else if (empty($_POST['priority_id'])){
			$errors[] = "Prioridad vacía";
		}else if (empty($_POST['status_id'])){
			$errors[] = "Estatus vacío";
		}else if (empty($_POST['kind_id'])){
			$errors[] = "Tipo vacío";
		}else if($imageExist == 0){
			$errors[] = "Necesitas añadir una imagen para continuar";
		} else if (
			!empty($_POST['title']) &&
			!empty($_POST['description']) &&
			!empty($_POST['category_id']) &&
			!empty($_POST['project_id'])  &&
			!empty($_POST['priority_id']) &&
			!empty($_POST['status_id'])   &&
			!empty($_POST['kind_id'])
		){


		//include "../config/config.php";//Contiene funcion que conecta a la base de datos// Secambia de posicion :D jlci 060032021

		$title = $_POST["title"];
		$description = $_POST["description"];
		$category_id = $_POST["category_id"];
		$project_id = $_POST["project_id"];
		$priority_id = $_POST["priority_id"];
		$user_id = $_SESSION["user_id"];
		$status_id = $_POST["status_id"];
		$kind_id = $_POST["kind_id"];
		$created_at="NOW()";
		$asignedTicket = $_POST["asignedTicket"];
		if(empty($_POST["asignedTicket"])){$asignedTicket="";}
		

		// $user_id=$_SESSION['user_id'];

		//user 
		$idUser=$_SESSION['user_id'];
	    $query1=mysqli_query($con,"SELECT * from user where id=$idUser");
	    while ($row=mysqli_fetch_array($query1)) {
	        $name = $row['name'];
	        $email = $row['email'];
	    }
	    //projet 
	    $query2=mysqli_query($con,"SELECT name from project where id=$project_id");
	    while ($row=mysqli_fetch_array($query2)) {
	        $nameProject = $row['name'];
	    }
		/*if($imageExist == 2){
		$query=mysqli_query($con, "UPDATE ticket set problem_imguno=\"$name\",problem_imgdos=\"$name\" WHERE id = \"$id_user\"");
		//$query=mysqli_query($con, "UPDATE ticket set problem_imguno=\"$name\"WHERE id = \"$id_user\"");
		var_dump($query);
		}
		else{
		$query=mysqli_query($con, "UPDATE ticket set problem_imguno=\"$name\" WHERE id = \"$id_user\"");
		var_dump($query);
		}*/
		/*name1 y name 2 son los nombres de las imagnes*/
	    $conten="HelpDeskJEE"."\nSe creo el ticket ". $title ." del proyecto ".$nameProject."\nRealizado por: ".$name;
		$sql="insert into ticket (title,description,category_id,problem_imguno,problem_imgdos,project_id,priority_id,user_id,status_id,kind_id,created_at,asigned_id) value (\"$title\",\"$description\",\"$category_id\",\"$name1\",\"$name2\",\"$project_id\",$priority_id,$user_id,$status_id,$kind_id,$created_at,\"$asignedTicket\")";

		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Tu ticket ha sido ingresado satisfactoriamente.";
				//mail($email,"Nuevo ticket",$conten);

			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
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