<?php
    $projects =mysqli_query($con, "select * from project");
    $priorities =mysqli_query($con, "select * from priority");
    $statuses =mysqli_query($con, "select * from status");
    $kinds =mysqli_query($con, "select * from kind");
    $categories =mysqli_query($con, "select * from category");
?>

<div
id="miModal"
class="modal fade mis-modales"
tabindex="-1" role="dialog" aria-hidden="true"
>
<div class="modal-dialog modal-lg modal-blue">
  <!-- Contenido del modal -->
  <div class="modal-content">
    <div class="modal-header">
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        onclick="borrarDatosComment();"
      >
        &times;
      </button>
      <h2 class="modal-title" id="exampleModalLabel">
        <font color="#a33532">Califica la atención y deja un comentario</font>
      </h2>
      
    </div>
    <div class="modal-body">
    <form class="form-horizontal form-label-left input_mask" method="post" id="add_cal" name="add_cal">
    <div id="resultados2"></div>
    <input type="hidden" name="mod_id2" id="mod_id2">
    <input type="hidden" name="mod_project_id2" id="mod_project_id2">
    <input type="hidden" name="mod_kind_id2" id="mod_kind_id2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <!--<label for="message-text" class="col-form-label">Message:</label>-->
              <textarea
                class="form-control"
                cols="40"
                rows="5"
                placeholder="Escribe un comentario"
                maxlength="1000"
                id="comment"
                name="comment"
              ></textarea>
            </div>
            <label for="score" class="col-form-label">
              <font
                >Puedes ver todos tus comentarios en la sección "Contacto".</font>
            </label>
          </div>
          <div class="col-md-6">
            <label for="score" class="col-form-label"
              ><font color="#a33532"
                >¿Cuál es tu nivel de satisfacción en la atención del ticket?</font
              ></label
            >
            <p align="left" class="clasificacion">
              <input class="form-control" id="radio1" type="radio" name="estrellas" value="5"><!--
            --><label for="radio1">★</label><!--
            --><input class="form-control" id="radio2" type="radio" name="estrellas" value="4"><!--
            --><label for="radio2">★</label><!--
            --><input class="form-control" id="radio3" type="radio" name="estrellas" value="3"><!--
            --><label for="radio3">★</label><!--
            --><input class="form-control" id="radio4" type="radio" name="estrellas" value="2"><!--
            --><label for="radio4">★</label><!--
            --><input class="form-control" id="radio5" type="radio" name="estrellas" value="1"><!--
            --><label for="radio5">★</label>
            </p>
            <!-- <span>Eligió: {{ editComment.score }}</span>-->
            <label for="score" class="col-form-label">
              <font
                >Toma en cuenta que una estrella significa poco
                satisfecho y 5 estrellas significa muy
                satisfecho.</font>
            </label>
          </div>
        </div>
      </div>
    
    </div>

    <div class="modal-footer ">
      <button
        id="save_cal"
        type="submit" class="btn btn-success"
      >
        Enviar
      </button>
    </div>
    </form>
  </div>
</div>
</div>
<!--Termina Modal -->