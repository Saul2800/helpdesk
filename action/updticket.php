<?php
	session_start();
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        } else if (empty($_POST['title'])){
			$errors[] = "Titulo vacío";
		} else if (empty($_POST['description'])){
			$errors[] = "Description vacío";
		}  else if (
			!empty($_POST['title']) &&
			!empty($_POST['description'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos



		$title = $_POST["title"];
		$description = $_POST["description"];
		$category_id = $_POST["category_id"];
		$project_id = $_POST["project_id"];
		$priority_id = $_POST["priority_id"];
		$user_id = $_SESSION["user_id"];
		$status_id = $_POST["status_id"];
		$kind_id = $_POST["kind_id"];
		$ticket_id=$_POST['mod_id'];

 	$query1 = mysqli_query($con,"SELECT * FROM ticket WHERE id = \"$ticket_id\";");
		if ($row = mysqli_fetch_array($query1)) {
				$user_ticket_id = $row['user_id'];
				$id_project=	$row['project_id'];
				$user_id_asigned=$row['asigned_id'];
		}
	$query2 = mysqli_query($con,"SELECT * FROM user WHERE id = \"$user_ticket_id\";");
		if ($row = mysqli_fetch_array($query2)) {
				$_SESSION['ticket_email'] = $row['email'];
		}
	$query3 = mysqli_query($con,"SELECT * FROM status WHERE id = \"$status_id\";");
		if ($row = mysqli_fetch_array($query3)) {
				$_SESSION['tickets_estatus'] = $row['name'];
		}	
	$query4 = mysqli_query($con,"SELECT * FROM project WHERE id = \"$id_project\";");
		if ($row = mysqli_fetch_array($query4)) {
				$_SESSION["project_ticket_name"] = $row['name'];
		}
	$query5=mysqli_query($con,"SELECT * from user WHERE id=$user_id_asigned");
	    while ($row=mysqli_fetch_array($query5)) {
	        $_SESSION['asignedmailUT'] = $row['email'];
	    }	

		$sql = "update ticket set title=\"$title\",category_id=\"$category_id\",project_id=\"$project_id\",priority_id=\"$priority_id\",description=\"$description\",status_id=\"$status_id\",kind_id=\"$kind_id\",updated_at=NOW() where id=$ticket_id";

		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "El ticket ha sido actualizado satisfactoriamente.";

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