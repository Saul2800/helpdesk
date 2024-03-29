<?php

    include "../config/config.php";//Contiene funcion que conecta a la base de datos
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $id_del=intval($_GET['id']);
        $query=mysqli_query($con, "SELECT * from ticket where id='".$id_del."'");
        $count=mysqli_num_rows($query);

            if ($delete1=mysqli_query($con,"DELETE FROM ticket WHERE id='".$id_del."'")){
?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
        <?php 
            }else {
        ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
                </div>
    <?php
            } //end else
        } //end if
    ?>

<?php
    if($action == 'ajax'){
        // escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
         $aColumns = array('title');//Columnas de busqueda
         $sTable = "ticket";
         $sWhere = "";
        if ( $_GET['q'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
        $sWhere.=" order by created_at desc";
        include 'pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './expences.php';

        //neri
       session_start();
       $id_user = $_SESSION['user_id'];
       $kind=$_SESSION['user_kind'];
       if ($kind == 1)  //En caso de ser Admin permite ver todo
       {
            $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
            $query = mysqli_query($con, $sql); 
       }
       else if ($kind == 2) //En caso de ser usuario permite ver solo lo publicado por el mismo usuario
        {
            $sql = "SELECT * FROM  ticket WHERE user_id = '$id_user'  $sWhere LIMIT $offset,$per_page ";
            $query = mysqli_query($con, $sql);
        }
        else if ($kind == 3) //En caso de ser proveedor permite ver solo lo asignado a el
        {
            $sql = "SELECT * FROM  ticket WHERE asigned_id = '$id_user' $sWhere LIMIT $offset,$per_page ";
            $query = mysqli_query($con, $sql);
        }
        else if ($kind == 4) //En caso de ser monitor permite ver solo lo asignado a el
        {
            $sql = "SELECT * FROM  ticket WHERE asigned_id = '$id_user' $sWhere LIMIT $offset,$per_page ";
            $query = mysqli_query($con, $sql);
        }

      //neriend
        //main query to fetch the data
        
        //loop through fetched data
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title">Asunto </th>
                        <th class="column-title">Proceso Electoral </th>
                        <th class="column-title">Prioridad </th>
                        <th class="column-title">Estado </th>
                        <th class="column-title">Fecha</th>
                        <th class="column-title">Asignado a:</th>
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id=$r['id'];
                            //$_SESSION["id_ticket_TK"]=$r['id'];
                            $created_at=date('d/m/Y', strtotime($r['created_at']));
                            $description=$r['description'];
                            $title=$r['title'];
                            $project_id=$r['project_id'];
                            $priority_id=$r['priority_id'];
                            $status_id=$r['status_id'];
                            $kind_id=$r['kind_id'];
                            $category_id=$r['category_id'];
                            $problem_imguno=$r['problem_imguno'];
                            $problem_imgdos=$r['problem_imgdos'];
                            $asigned_id=$r['asigned_id'];

                            $sql = mysqli_query($con, "select * from project where id=$project_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_project=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from priority where id=$priority_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_priority=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from status where id=$status_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_status=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from user where id=$asigned_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_asigned=$c['name'];
                            }


                ?>
                    <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $title;?>" id="title<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $description;?>" id="description<?php echo $id;?>">

                    <!-- me obtiene los datos -->
                 <input type="hidden" value="<?php echo $kind_id;?>" id="kind_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $project_id;?>" id="project_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $category_id;?>" id="category_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $priority_id;?>" id="priority_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $status_id;?>" id="status_id<?php echo $id;?>">
                    <!-- Obtengo las imagenes añadidas de acuerdo al id 15/03/2021 -->
                    <input type="hidden" value="<?php echo $problem_imguno;?>" id="problem_imguno<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $problem_imgdos;?>" id="problem_imgdos<?php echo $id;?>">

                    <tr class="even pointer">
                        <td><?php echo $title;?></td>
                        <td><?php echo $name_project; ?></td>
                        <td><?php echo $name_priority; ?></td>
                        <td><?php echo $name_status;?></td>
                        <td><?php echo $created_at;?></td>
                        <td><?php echo $name_asigned;?></td>

                        <td ><span class="pull-right">
                        <!--modal calificacion-->    
                        <a href="#" class='btn btn-default' title='Calificar Ticket' onclick="obtener_datos2('<?php echo $id;?>');" data-toggle="modal" data-target="#miModal"><i class="glyphicon glyphicon-star"></i></a>
                        <!--modal comentarios-->    
                        <a href="#" class='btn btn-default' title='Comentarios del ticket' onclick="obtener_datos5('<?php echo $id;?>');" data-toggle="modal" data-target="#ticket_comments"><i class="glyphicon glyphicon-comment"></i></a>
                        <!--modal comentarios-->  
                        <a href="#" class='btn btn-default' title='Imagen Ticket' onclick="obtener_datos3('<?php echo $id;?>');" data-toggle="modal" data-target="#imgModal"><i class="glyphicon glyphicon-picture"></i></a>
                        <!--modal editar-->    
                        <a href="#" class='btn btn-default' title='Editar Ticket' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-udp"><i class="glyphicon glyphicon-edit"></i></a> 
                        <!--modal borrar-->    
                        <a href="#" class='btn btn-default' title='Borrar Ticket' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
                    </tr>
                <?php
                    } //en while
                ?>
                <tr>
                    <td colspan=9><span class="pull-right">
                        <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                    </span></td>
                </tr>
              </table>
            </div>
            <?php
        }else{
           ?> 
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> No hay datos para mostrar!
            </div>
        <?php    
        }
    }
?>