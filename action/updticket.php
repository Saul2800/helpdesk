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

		//user on use
		$idUser=$_SESSION['user_id'];
	    $query1=mysqli_query($con,"SELECT * from user where id=$idUser");
	    while ($row=mysqli_fetch_array($query1)) {
	        $name = $row['name'];
	        $email = $row['email'];
	    }

	    //user ticket 
	    $query2=mysqli_query($con,"SELECT user_id from ticket where id =$ticket_id");
	    while ($row=mysqli_fetch_array($query2)) {
	        $userID = $row['user_id'];
	    }

	    //email user ticket
	    $query3=mysqli_query($con,"SELECT email from user where id =$userID");
	    while ($row=mysqli_fetch_array($query3)) {
	        $emailUser = $row['email'];
	    }

	    //projet 
	    $query4=mysqli_query($con,"SELECT name from project where id=$project_id");
	    while ($row=mysqli_fetch_array($query4)) {
	        $nameProject = $row['name'];
	    }

	    $conten="HelpDeskJEE"."\nSe modifico el ticket ". $title ." del proyecto ".$nameProject."\nRealizado por: ".$name;

		$sql = "update ticket set title=\"$title\",category_id=\"$category_id\",project_id=\"$project_id\",priority_id=\"$priority_id\",description=\"$description\",status_id=\"$status_id\",kind_id=\"$kind_id\",updated_at=NOW() where id=$ticket_id";

		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "El ticket ha sido actualizado satisfactoriamente.";
				mail($emailUser,"Edicion ticket",$conten);

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