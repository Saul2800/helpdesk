<?php
session_start();

include "../config/config.php";//Contiene funcion que conecta a la base de datos



?>
<div id="ticket_comments" class="modal fade mis-modales" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg modal-blue">
  <!-- Contenido del modal -->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" onclick="location.reload();" data-dismiss="modal">
        &times;
      </button>
      <h2 class="modal-title" id="exampleModalLabel">
        <font color="#a33532">Comentarios del ticket</font>
      </h2>
    </div>
    <div class="modal-body">
          <form class="form-horizontal form-label-left input_mask" method="post" id="add_cal" name="add_cal">
    <div id="resultados2"></div>
    <input type="hidden"name="mod_id6" id="mod_id6">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
             <label for="score" class="col-form-label">
              <font color="#a33532">Comentario</font>
            </label>  
                <textarea class="form-control" cols="40" rows="2" maxlength="80" id="comment" name="comment">
              </textarea>
            </div>
            <label for="score" class="col-form-label">
            </label>
          </div>
          <div class="col-md-6">
             <label for="score" class="col-form-label">
              <font color="#a33532">Nivel de satisfacción en la atencion</font>
            </label>
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
          </div>
        </div>
      </div>
    
    </div>
</form>

    </div>
    <div class="modal-footer ">
    </div>
  </div>
</div>
</div>
<!--Termina Modal -->