<?php
    $title ="Usuarios | ";
    include "head.php";
    include "sidebar.php";

//security options
//admin
$kind=$_SESSION['user_kind'];
if($kind==1){
$allow_admin = true;        
}
//user//monitorTI//Proveedor
else{
$allow_admin = false; 
}

?>  
    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        include("modal/new_user.php");
                        include("modal/upd_user.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Usuarios</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <!-- form search -->
                        <form class="form-horizontal" role="form" id="datos_cotizacion">
                            <div class="form-group row">
                                <label for="q" class="col-md-2 control-label">Nombre o E-mail</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="q" placeholder="Nombre o Correo Electrónico" onkeyup='load(1);'>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-default" onclick='load(1);'>
                                        <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                    <!-- <span id="loader"></span> -->
<?php if($allow_admin): ?>
                                    <a class="botonDescargar2" href="reportusers.php?t=pdf" target="_blank">Descargar</a>
<?php endif; ?>
                                </div>
                            </div>
                        </form>   
                        <!-- end form search -->

                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                    <div id="resultados"></div><!-- Carga los datos ajax -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->

<?php include "footer.php" ?>

<script type="text/javascript" src="js/users.js"></script>

<script>
$( "#add_user" ).submit(function( event ) {
    $('#save_data').attr("disabled", true);
  
    var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_user.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_user").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_user").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });
//SAR 11/03/21 INI
    $.ajax({
            type: "POST",
            url: "testmailer.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_user").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_user").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });  
 //SAR 11/03/21 FIN
  event.preventDefault();
})

// success

$( "#upd_user" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/upd_user.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_user2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_user2").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });

 //SAR 11/03/21
 $.ajax({
            type: "POST",
            url: "testmailer.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_user2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_user2").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });    
  event.preventDefault();
})
/*Función que obtiene los datos desde la tabla de consulta
Siempre hay que agregar el campo aquí. */
    function obtener_datos(id){
            var name = $("#name"+id).val();
            var email = $("#email"+id).val();
            var status = $("#status"+id).val();
            var kind = $("#kinduser"+id).val(); //JLCI 20/02/2021
            var username = $("#username"+id).val(); //JLCI 20/02/2021
            $("#mod_id").val(id);
            $("#mod_name").val(name);
            $("#mod_email").val(email);
            $("#mod_status").val(status);
            $("#mod_kinduser").val(kind); //JLCI 20/02/2021
            $("#mod_username").val(username); //JLCI 20/02/2021
        }
</script>