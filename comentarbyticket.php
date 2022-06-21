<?php
    $title ="Ticket | ";
    include "head.php";
    include "sidebar.php";
    //session_start();
    //include "config/config.php";
    $ratingtotal = 0;
    if (!isset($_SESSION['user_id'])&& $_SESSION['user_id']==null) {
        header("location: index.php");
    }
    $id_ticket=$_GET["id"];
    $numerodecomentarios=0;
    $query01=mysqli_query($con,"SELECT * from ticket where id=$id_ticket");
    while ($row=mysqli_fetch_array($query01)) {
     $ticketStatusComments=$row['status_id'];
    }
    $query0=mysqli_query($con,"SELECT * from comment where id_ticket=$id_ticket");
    while ($row=mysqli_fetch_array($query0)) {
     $idcommentxticket=$row['id_ticket'];
     $commentario=$row['comment'];  
    }
    if($commentario==""){
    echo '<script>  alert("No hay comentarios para mostrar"); window.location="tickets.php"; </script>
';}

    $query=mysqli_query($con,"SELECT * from comment where id_ticket=$id_ticket order by created_at desc");
?>
<div class="right_col" role="main"><!-- page content -->
<div class="col-md-6" style="width:800px; height:550px; overflow-y: scroll;">
<div class="form-group">   
<!-- Contenedor Principal -->
<div class="comments-container">
		<h1 align="center">Comentarios del ticket <?php echo $id_ticket; ?></h1>
<?php foreach ($query as $comments ) { 
        $idUserComments=$comments['id_user'];
        $ratingtotal=((int)$ratingtotal+(int)$comments['rating']);
        //var_dump($ratingtotal);
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
        $ratingpromedio = round($ratingpromedio,0,PHP_ROUND_HALF_DOWN);
        if($ratingpromedio>=5){
            $ratingFace="face5.PNG";
        }if($ratingpromedio>=4 && $ratingpromedio < 5){
            $ratingFace="face4.PNG";
        }if ($ratingpromedio>=3 && $ratingpromedio < 4){
            $ratingFace="face3.PNG";
        }if ($ratingpromedio>=2 && $ratingpromedio < 3){
            $ratingFace="face2.PNG";
        }if ($ratingpromedio>=0 && $ratingpromedio < 2){
            $ratingFace="face1.PNG";
        }

        if($ticketStatusComments==1){
            $ticketStatus="Pendiente";
        }

        if($ticketStatusComments==2){
            $ticketStatus="En Desarrollo";
        }

        if($ticketStatusComments==3){
            $ticketStatus="Terminado";
        }

        if($ticketStatusComments==4){
            $ticketStatus="Cancelado";
        }
 ?>
	</div>
</div>
</div>
<div class="row-md-8" >
    <img align="right" width="19.5%" src="images/<?php echo $ratingFace; ?>" alt="ratingface">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <h3 align="center">Calificación general de satisfacción</h3>
    <h3 align="center"><?php echo $ratingpromedio ?></h3>
    <br><br>
    <h3 align="center">Estatus del ticket: <?php echo $ticketStatus ?> </h3>

</div>
</div><!-- /page content -->
<?php include "footer.php" ?>