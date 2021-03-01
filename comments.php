<?php
    $title ="Comentarios | ";
    include "head.php";
    include "sidebar.php";
    session_start();
    $id_usuario = $_SESSION["user_id"];
    $projects = mysqli_query($con, "select * from project");
    $priorities = mysqli_query($con,  "select * from priority");
    $statuses = mysqli_query($con, "select * from status");
    $kinds = mysqli_query($con, "select * from kind");
    $comment = mysqli_query($con, "select * from comment");
?>  


    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Estos son tus comentarios en tickets</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <!-- form search -->
                        <form class="form-horizontal" role="form">
                            <input type="hidden" name="view" value="reports">
                            <div class="form-group">
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-male"></i></span>
                                    <select name="project_id" class="form-control">
                                    <option value="">PROJECTO</option>
                                      <?php foreach($projects as $p):?>
                                        <option value="<?php echo $p['id']; ?>" <?php if(isset($_GET["project_id"]) && $_GET["project_id"]==$p['id']){ echo "selected"; } ?>><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-support"></i></span>
                                    <select name="priority_id" class="form-control">
                                    <option value="">PRIORIDAD</option>
                                      <?php foreach($priorities as $p):?>
                                        <option value="<?php echo $p['id']; ?>" <?php if(isset($_GET["priority_id"]) && $_GET["priority_id"]==$p['id']){ echo "selected"; } ?>><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                  <span class="input-group-addon">INICIO</span>
                                  <input type="date" name="start_at" value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="form-control" placeholder="Palabra clave">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                  <span class="input-group-addon">FIN</span>
                                  <input type="date" name="finish_at" value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="form-control" placeholder="Palabra clave">
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">ESTADO</span>
                                        <select name="status_id" class="form-control">
                                          <?php foreach($statuses as $p):?>
                                            <option value="<?php echo $p['id']; ?>" <?php if(isset($_GET["status_id"]) && $_GET["status_id"]==$p['id']){ echo "selected"; } ?>><?php echo $p['name']; ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">TIPO</span>
                                        <select name="kind_id" class="form-control">
                                          <?php foreach($kinds as $p):?>
                                            <option value="<?php echo $p['id']; ?>" <?php if(isset($_GET["kind_id"]) && $_GET["kind_id"]==$p['id']){ echo "selected"; } ?>><?php echo $p['name']; ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <button class="btn btn-primary btn-lg" data-toggle="tooltip" data-placement="top" title="Buscar información en tickets">&nbsp;&nbsp;Buscar&nbsp;&nbsp;</button>
                                    <a class="botonDescargar" href="reportcomments.php?t=pdf" target="_blank">Descargar</a>
                                </div>

                            </div>
                        </form>
                        <!-- end form search -->

                         <?php
                                        $users= array();
                                        if((isset($_GET["status_id"]) && isset($_GET["kind_id"]) && isset($_GET["project_id"]) && isset($_GET["priority_id"]) && isset($_GET["start_at"]) && isset($_GET["finish_at"]) ) && ($_GET["status_id"]!="" ||$_GET["kind_id"]!="" || $_GET["project_id"]!="" || $_GET["priority_id"]!="" || ($_GET["start_at"]!="" && $_GET["finish_at"]!="") ) ) {
                                        $sql = "select * from ticket where ";
                                        if($_GET["status_id"]!=""){
                                            $sql .= " status_id = ".$_GET["status_id"];
                                        }

                                        if($_GET["kind_id"]!=""){
                                        if($_GET["status_id"]!=""){
                                            $sql .= " and ";
                                        }
                                            $sql .= " kind_id = ".$_GET["kind_id"];
                                        }


                                        if($_GET["project_id"]!=""){
                                        if($_GET["status_id"]!=""||$_GET["kind_id"]!=""){
                                            $sql .= " and ";
                                        }
                                            $sql .= " project_id = ".$_GET["project_id"];
                                        }

                                        if($_GET["priority_id"]!=""){
                                        if($_GET["status_id"]!=""||$_GET["project_id"]!=""||$_GET["kind_id"]!=""){
                                            $sql .= " and ";
                                        }

                                            $sql .= " priority_id = ".$_GET["priority_id"];
                                        }



                                        if($_GET["start_at"]!="" && $_GET["finish_at"]){
                                        if($_GET["status_id"]!=""||$_GET["project_id"]!="" ||$_GET["priority_id"]!="" ||$_GET["kind_id"]!="" ){
                                            $sql .= " and ";
                                        }

                                            $sql .= " ( date_at >= \"".$_GET["start_at"]."\" and date_at <= \"".$_GET["finish_at"]."\" ) ";
                                        }

                                                $users = mysqli_query($con, $sql);

                                        }else{
                                                $users = mysqli_query($con, "select * from ticket order by created_at desc");

                                        }

                            if(@mysqli_num_rows($users)>0){
                                // si hay reportes
                                $_SESSION["report_data"] = $users;
                            ?>
        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="headings">
                        <th class="column-title">ID Comentario</th>
                        <th class="column-title">ID Usuario</th>
                        <th class="column-title">Comentario</th>
                        <th class="column-title">Calificación</th>
                        <th class="column-title">Proceso Electoral</th>
                        <th class="column-title">ID Ticket</th>
                        <th class="column-title">Tipo de Ticket</th>
                        <th class="column-title">Fecha Creación</th>
                    </thead>
                    <!--
                        id int AI PK 
                        id_user int 
                        comment varchar(250) 
                        rating varchar(45) 
                        id_project int 
                        id_ticket int 
                        kind_user int 
                        created_at datetime
                     -->
            <?php
            $total = 0;
            foreach($users as $user){
                $project_id=$user['project_id'];
                $priority_id=$user['priority_id'];
                $kind_id=$user['kind_id'];
                $category_id=$user['category_id'];
                $status_id=$user['status_id'];
                $id_user=$user['id'];

                $status=mysqli_query($con, "select * from status where id=$status_id");
                $category=mysqli_query($con, "select * from category where id=$category_id");
                $kinds = mysqli_query($con,"select * from kind where id=$kind_id");
                $project  = mysqli_query($con, "select * from project where id=$project_id");
                $medic = mysqli_query($con,"select * from priority where id=$priority_id");
               
                ?>
                
                
             <?php  
                
                }

              ?>
              <?php
            $total = 0;
            $commentarios = array();
            $commentarios = mysqli_query($con,"select * from comment where id_user=$id_usuario");   
            foreach($commentarios as $comments){
                $project_id=$user['project_id'];
                $priority_id=$user['priority_id'];
                $kind_id=$user['kind_id'];
                $category_id=$user['category_id'];
                $status_id=$user['status_id'];
                $id_user=$user['id'];
                $status=mysqli_query($con, "select * from status where id=$status_id");
                $category=mysqli_query($con, "select * from category where id=$category_id");
                $kinds = mysqli_query($con,"select * from kind where id=$kind_id");
                $project  = mysqli_query($con, "select * from project where id=$project_id");
                $medic = mysqli_query($con,"select * from priority where id=$priority_id");
                
                ?>
                <tr>
                <td><?php echo $comments['id']; ?></td>
                <td><?php echo $comments['id_user']; ?></td>
                <td><?php echo $comments['comment']; ?></td>
                <td><?php echo $comments['rating']; ?></td>
                <?php foreach($project as $pro){?>
                <td><?php echo $pro['name'] ?></td>
                <?php } ?>
                <td><?php echo $comments['id_ticket']; ?></td>
                <?php foreach($kinds as $kind){?>
                <td><?php echo $kind['name'] ?></td>
                <?php } ?>
                <td><?php echo $comments['created_at']; ?></td>
                </tr>
             <?php  
                
                }

              ?> 
       <?php

        }else{
            echo "<p class='alert alert-danger'>No hay tickets</p>";
        }


        ?>
     </table>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->

<?php include "footer.php" ?>
