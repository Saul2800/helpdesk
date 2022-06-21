<?php
    //$ticket_id=$_SESSION["id_ticket_TK"];//viene de ajax/tickets.php
    /*$query1 = mysqli_query($con,"SELECT * FROM ticket WHERE id = \"$ticket_id\";");
        if ($row = mysqli_fetch_array($query1)) {
                $img_ticket1 = $row['problem_imguno'];
                $img_ticket2 = $row['problem_imgdos'];
        }*/
?>
<div id="imgModal" class="modal fade mis-modales" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg modal-blue">
  <!-- Contenido del modal -->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" onclick="location.reload();" data-dismiss="modal">
        &times;
      </button>
      <h2 class="modal-title" id="exampleModalLabel">
        <font color="#a33532">Imagen del ticket</font>
      </h2>
    </div>
    <div class="modal-body">
      <div id="show_Images">             
        <input type="hidden" name="mod_id3" id="mod_id3">
      <div class="col-md-6">
      <br><br>
        <img class="thumb-image" name="mod_imguno_id" id="mod_imguno_id" style="width: 100%; display: block;" src="" alt="image1" />
      </div>

      <div class="col-md-6">
      <br><br>
        <img class="thumb-image" name="mod_imgdos_id" id="mod_imgdos_id" style="width: 100%; display: block;" src="" alt="image2" />
      </div>

      </div>

    </div>
    <div class="modal-footer ">
    </div>
  </div>
</div>
</div>
<!--Termina Modal -->