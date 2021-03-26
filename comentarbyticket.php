<?php
    $title ="Ticket | ";
    //include "head.php";
    //include "sidebar.php";
    session_start();
    include "config/config.php";
    if (!isset($_SESSION['user_id'])&& $_SESSION['user_id']==null) {
        header("location: index.php");
    }
    $id_ticket=$_GET["id"];
    $numerodecomentarios=0;
    $query0=mysqli_query($con,"SELECT * from comment where id_ticket=$id_ticket");
    while ($row=mysqli_fetch_array($query0)) {
     $idcommentxticket=$row['id_ticket'];  
    }
    $query=mysqli_query($con,"SELECT * from comment where id_ticket=$id_ticket order by created_at desc");
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <link rel ="icon" type="icon/png" href="images/iconoPestaña.png" > <!--Icono de pestaña-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; echo $idcommentxticket; ?> </title>

        <!-- Bootstrap -->
        <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="css/nprogress/nprogress.css" rel="stylesheet">
          <!-- iCheck -->
       <link href="css/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="css/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="css/custom.min.css" rel="stylesheet">

        <!-- MICSS button[type="file"] -->
        <link rel="stylesheet" href="css/micss.css">
        <!-- Se importan los css personalizados -->
        <link href="css/estilosnuevos.css" rel="stylesheet">

    </head>
<body>
<div class="col-md-6" style="width:900px; height:700px; overflow-y: scroll;">
<div class="form-group">   
<!-- Contenedor Principal -->
<div class="comments-container">
		<h1>Comentarios del ticket <?php echo $idcommentxticket; ?></h1>
<?php foreach ($query as $comments ) { 
        $idUserComments=$comments['id_user'];
        $ratingtotal=($ratingtotal+$comments['rating']);
        $numerodecomentarios++;

    $query2=mysqli_query($con,"SELECT * from user where id=$idUserComments");
    foreach ($query2 as $users ) { ?>

		<ul id="comments-list" class="comments-list">
			<li>
				<div class="comment-main-level">
					<!-- Avatar -->					
					<div class="comment-avatar"><img src="images/profiles/<?php echo $users["profile_pic"]; ?>" alt="perfil"></div>
					<!-- Contenedor del Comentario -->
					<div class="comment-box">
						<div class="comment-head">
							<h6 class="comment-name by-author"><a><?php echo $users['name'];?></a></h6>
							<span><?php echo $comments['created_at'];?></span>
						</div>
						<div class="comment-content">
							<?php echo $comments['comment'];?>
						</div>
					</div>
				</div>
			</li>
		</ul>
        <?php } }

        $ratingpromedio=$ratingtotal/$numerodecomentarios;
        if($ratingpromedio>=5){
            $ratingFace="face5.jpeg";
        }if($ratingpromedio>=4 && $ratingpromedio < 5){
            $ratingFace="face4.jpeg";
        }if ($ratingpromedio>=3 && $ratingpromedio < 4){
            $ratingFace="face3.jpeg";
        }if ($ratingpromedio>=2 && $ratingpromedio < 3){
            $ratingFace="face2.jpeg";
        }if ($ratingpromedio>=0 && $ratingpromedio < 2){
            $ratingFace="face1.jpeg";
        }
 ?>
	</div>
</div>
</div>
<div class="form-group">
    <img align="center" width="28.5%" src="images/<?php echo $ratingFace; ?>" alt="ratingface">
    <h1 align="center">Calificacion promedio del ticket</h1>
    <h1 align="center">|<?php echo $ratingpromedio ?>|</h1>
</div>
</body>
</html>