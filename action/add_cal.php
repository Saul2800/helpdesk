<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id2'])) {
        $errors[] = "ID vacío";
        }else if(empty($_POST['comment'])) {
           $errors[] = "Tienes que enviar un comentario";
        }else if(empty($_POST['estrellas'])) {
			$errors[] = "Tienes que enviar una calificación";
		 }else if (
			!empty($_POST['comment']) 
		){


		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$comentario = $_POST["comment"];
		$calificacion = $_POST["estrellas"];
		/*$category_id = $_POST["category_id"];
		
		$priority_id = $_POST["priority_id"];
		$status_id = $_POST["status_id"];
		$kind_id = $_POST["kind_id"];*/
        $project_id = $_POST["mod_project_id2"];
        $id=$_POST['mod_id2'];
        $user_id = $_SESSION["user_id"];
        $kind_id = $_POST["mod_kind_id2"];
		$created_at="NOW()";
        
        $sql="insert into comment (id_user,comment,rating,id_project,id_ticket,kind_user,created_at) value (\"$user_id\",\"$comentario\",\"$calificacion\",\"$project_id\",\"$id\",\"$kind_id\",$created_at)";
        
        $query_new_insert = mysqli_query($con,$sql);
		if ($query_new_insert){
				$messages[] = "Tu calificación ha sido ingresado satisfactoriamente.";
                //$sql="insert into comment (id_user,comment,rating,id_project,id_ticket,created_at) value (\"$user_id\",\"$comentario\",\"$calificacion\",\"$project_id\",\"$id\",$created_at)";
                $sql_upd="update ticket set rating_ticket=\"$calificacion\",updated_at=NOW() where id=$id";
                $query_new_upd = mysqli_query($con,$sql_upd);
                if ($query_new_upd){
                    $messages[] = "Tu calificación ha sido promediada satisfactoriamente.";
                }else{
                        $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
                        $errors[]=$sql;
                }
		}else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
                $errors[]=$sql;
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