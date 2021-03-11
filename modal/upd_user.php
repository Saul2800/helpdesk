<script type="text/javascript">
function PasarValorUpd()
{
        //document.getElementById("username").value = document.getElementById("email").value;
        document.getElementById("mod_email").required = true;
		var str = document.getElementById("mod_email").value;
  		var res = str.split("@");
        document.getElementById("mod_username").value = res[0];
}
function validarKindUser(){
    var valorDeKind = document.getElementById("mod_kinduser").value;
    //alert(valorKind);
    console.log(valorDeKind);
    if(valorDeKind==3){
        
        document.getElementById("mod_proveedor").style.display = "block";
    }
    else{
        document.getElementById("mod_proveedor").style.display = "none";
    }
}
</script>

    <div class="modal fade bs-example-modal-lg-upd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
                </div>
                <div class="modal-body">
                    <form action="testmailer.php" class="form-horizontal form-label-left input_mask" id="upd_user" name="upd_user">
                        <div id="result_user2"></div>
                        <input type="hidden" id="mod_id" name="mod_id">
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input name="mod_name" id="mod_name" type="text" class="form-control" required>
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input onkeyup="PasarValorUpd();" name="mod_email" id="mod_email" type="text" class="form-control has-feedback-left" required>
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <!-- SAR 3/03/2021-->
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input pattern="[0-9]{8,8}" maxlength="8" name="mod_DNI" id="mod_DNI" required type="text" class="form-control" placeholder="DNI">
                            <span aria-hidden="true">Digite 8 numeros</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input name="mod_TELEFONO" id="mod_TELEFONO" pattern="[0-9]{10,10}" maxlength="10" required type="text" class="form-control" placeholder="Telefono">
                            <span aria-hidden="true">Digite 10 numeros</span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select class="form-control" required name="mod_status" id="mod_status">
                                    <option value="" selected>-- Selecciona estado --</option>
                                    <option value="1" >Activo</option>
                                    <option value="0" >Inactivo</option>  
                            </select>
                        </div>
                        <!-- Inicia: Se añade nuevo campo para guardar el tipo de usuario JLCI 20/02/2021-->
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select onchange="validarKindUser();" class="form-control" required name="mod_kinduser" id="mod_kinduser">
                                    <option value="" selected>--Tipo Usuario--</option>
                                    <option value="1" >Administrador</option>
                                    <option value="2" >Usuario</option>
                                    <option value="3" >Proveedor</option>  
                                    <option value="4" >MonitorTI</option>  
                            </select>
                        </div>
                        <!-- Termina: Se añade nuevo campo para guardar el tipo de usuario JLCI 20/02/2021-->
                        <div class="form-group">
                            <!--<label class="control-label col-md-6 col-sm-3 col-xs-12" for="password"><br>Contraseña<span class="required">*</span>
                            </label>-->
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input name="mod_username" id="mod_username" type="text" class="form-control" readonly placeholder="Nombre Usuario">
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            <div  style="display:none" id="mod_proveedor" class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select id="mod_kindProvedor"  class="form-control" name="mod_kindProvedor">
                                    <option value="" selected>--Tipo proveedor-</option>
                                    <option value="1" >Computo</option>
                                    <option value="2" >Impresoras</option>
                                    <option value="3" >Red de Datos e Internet</option>  
                            </select>
                        </div>
                        </div>
                        <div class="form-group">
                           <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Contraseña<span class="required">*</span>
                            </label> -->
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input placeholder="Contraseña" type="password" id="password" name="password" class="form-control col-md-7 col-xs-12">
                                <p class="text-muted">La contraseña solo se modificara si escribes algo, en caso contrario no se modifica.</p>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <input type="hidden"value="5" name="EM">  
                              <button id="upd_data" type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->