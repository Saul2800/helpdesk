<?php
    $title ="Tickets | ";
    include "head.php";
    include "sidebar.php";
?>

    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        include("modal/new_ticket.php");
                        include("modal/upd_ticket.php");
                        include("modal/cal_ticket.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Proyectos</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        
                        <!-- form seach -->
                        <form class="form-horizontal" role="form" id="gastos">
                            <div class="form-group row">
                                <label for="q" class="col-md-2 control-label">Nombre/Asunto</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="q" placeholder="Nombre del ticket" onkeyup='load(1);'>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-default" onclick='load(1);'>
                                        <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                    <span id="loader"></span>
                                </div>
                            </div>
                        </form>     
                        <!-- end form seach -->


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

<script type="text/javascript" src="js/ticket.js"></script>
<!--<script type="text/javascript" src="js/VentanaCentrada.js"></script>-->
<script>
$("#add").submit(function(event) {
$('#save_data').attr("disabled", true);
event.preventDefault();  //Dejar esto para ver los errores :D
//var parametros = $(this); Esto también es valido :p
var formData = new FormData($("#add")[0]);
//console.log(parametros);
/*Imprimo las variables de mi formData JLCI 06/03/2021*/
for (var value of formData.values()) {
   console.log(value);
}

     $.ajax({
            type: "POST",
            url: "action/addticket.php",
            data: formData,
             beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
              },
            processData: false,  // <-- le indicamos a jQuery que no procese el `data`
            contentType: false,
            success: function(datos){
            $("#result").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });
 // event.preventDefault(); //Habilitar cuando se haya terminado
 //SAR 10/03/21 INI
$.ajax({
            type: "POST",
            url: "testmailer.php",
            data: formData,
             beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
              },
            processData: false,  // <-- le indicamos a jQuery que no procese el `data`
            contentType: false,
            success: function(datos){
            $("#result").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });
 //SAR 10/03/21 INI

})


$( "#upd" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/updticket.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result2").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });
//SAR 10/03/21 INI
$.ajax({
            type: "POST",
            url: "testmailer.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result2").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });
//SAR 10/03/21 FIN
  event.preventDefault();
})

    function obtener_datos(id){
        var description = $("#description"+id).val();
        var title = $("#title"+id).val();
        var kind_id = $("#kind_id"+id).val();
        var project_id = $("#project_id"+id).val();
        var category_id = $("#category_id"+id).val();
        var priority_id = $("#priority_id"+id).val();
        var status_id = $("#status_id"+id).val();
            $("#mod_id").val(id);
            $("#mod_title").val(title);
            $("#mod_description").val(description);
            $("#mod_kind_id").val(kind_id);
            $("#mod_project_id").val(project_id);
            $("#mod_category_id").val(category_id);
            $("#mod_priority_id").val(priority_id);
            $("#mod_status_id").val(status_id);
        }
/*Se obtienen los datos para continuar con el proceso de guardado: Según el id del ticke y usuario */
function obtener_datos2(id){
        var description = $("#description"+id).val();
        var title = $("#title"+id).val();
        var kind_id = $("#kind_id"+id).val();
        var project_id = $("#project_id"+id).val();
        var category_id = $("#category_id"+id).val();
        var priority_id = $("#priority_id"+id).val();
        var status_id = $("#status_id"+id).val();
        //console.log(project_id);
        var p = $("#mod_id2").val(id);
        //console.log(p);
        $("#mod_title2").val(title);
        $("#mod_description2").val(description);
        $("#mod_kind_id2").val(kind_id);
        $("#mod_project_id2").val(project_id);
        $("#mod_category_id2").val(category_id);
        $("#mod_priority_id2").val(priority_id);
        $("#mod_status_id2").val(status_id);
}
$("#add_cal").submit(function(event) {
$('#save_cal').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_cal.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#resultados2").html(datos);
            $('#save_cal').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})
function borrarDatosComment(){
    location.reload(); //Borra los datos del modal y recarga la página JLCI 01/03/2021
}
</script>