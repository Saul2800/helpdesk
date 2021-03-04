<script type="text/javascript">
function PasarValor()
{
        //document.getElementById("username").value = document.getElementById("email").value;
        document.getElementById("email").required = true;
		var str = document.getElementById("email").value;
  		var res = str.split("@");
        document.getElementById("username").value = res[0];
}  
</script>

<script type="text/javascript">

    function ShowNewTipoo(){
        $("#division_proveedor").show();
    }
    function hideNewTipo(){
        $("#division_proveedor").hide();
    }
</script>

    <div> <!-- Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Usuario</button>
    </div>
    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" id="add_user" name="add_user">
                        <div id="result_user"></div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input name="name" required type="text" class="form-control" placeholder="Nombres">
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input name="lastname" type="text" class="form-control" placeholder="Apellidos" required>
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input onkeyup="PasarValor();" id="email" name="email" type="text" class="form-control" placeholder="Correo Electronico" required>
                            <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <!-- SAR 3/03/2021-->
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input pattern="[0-9]{8,8}" name="DNI" required type="text" class="form-control" placeholder="DNI">
                            <span aria-hidden="true">Digite 8 numeros</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input name="TELEFONO" pattern="[0-9]{10,10}" required type="text" class="form-control" placeholder="Telefono">
                            <span aria-hidden="true">Digite 10 numeros</span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select class="form-control" required name="status">
                                    <option value="" selected>-- Selecciona estado --</option>
                                    <option value="1" >Activo</option>
                                    <option value="0" >Inactivo</option>  
                            </select>
                        </div>
                        <!-- Inicia: Se añade nuevo campo para guardar el tipo de usuario JLCI 20/02/2021-->
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select id="user_kind" class="form-control" required name="kinduser">
                                    <option onclick="hideNewTipo()"value="" selected>--Tipo Usuario--</option>
                                    <option onclick="hideNewTipo()"value="1" >Administrador</option>
                                    <option onclick="hideNewTipo()" value="2" >Usuario</option>
                                    <option onclick="ShowNewTipoo()" value="3" >Proveedor</option>  
                                    <option onclick="hideNewTipo()"value="4" >MonitorTI</option>  
                            </select>
                        </div>
                        <!-- Termina: Se añade nuevo campo para guardar el tipo de usuario JLCI 20/02/2021-->
                        <!-- Inicia: Se añade nuevo campo que guarda el tipo de administrador SAR 3/03/2021-->
                         <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input readonly name="username" id="username" type="text" class="form-control" placeholder="Nombre Usuario" >
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        <div id="division_proveedor" class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select id="kind_proveedor" class="form-control" name="kindProvedor">
                                    <option value="" selected>--Tipo proveedor-</option>
                                    <option value="1" >Computo</option>
                                    <option value="2" >Impresoras</option>
                                    <option value="3" >Red de Datos e Internet</option>  
                            </select>
                        </div>
                        <!-- Termina: Se añade nuevo campo que guarda el tipo de administrador SAR 3/03/2021-->
                        <div class="form-group">
                            <!--<label class="control-label col-md-6 col-sm-3 col-xs-12" for="password"><br>Contraseña<span class="required">*</span>
                            </label>-->

                        </div>
                        <div class="form-group">
                            <!--<label class="control-label col-md-6 col-sm-3 col-xs-12" for="password"><br>Contraseña<span class="required">*</span>
                            </label>-->
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" id="password" name="password" placeholder="Contraseña" required class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button id="save_data" type="submit" class="btn btn-success">Guardar</button>
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