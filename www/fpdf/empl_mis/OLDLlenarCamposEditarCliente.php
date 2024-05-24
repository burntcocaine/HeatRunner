<?php 
/* Desarrollado por: PROGRAMANDO BROTHERS 	
	Suscribete a : https://www.youtube.com/ProgramandoBrothers y comparte los v�deos.
	Recuerda: "EL CONOCIMIENTO SE COMPARTE, POR M�S POCO QUE SEA".
	*/
    include_once('conexion.php');
    $ide = $_POST['ide'];
    $sql_edit = "SELECT id, usuario, contra, estado, NombreCompleto, dni from usuario where id=$ide;";
    $res_edit = mysqli_query($conexion, $sql_edit);
    $edit_clientes = mysqli_fetch_array($res_edit);
    echo "

<!-- Modal para Editar-->

  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title' id='myModalLabel'>Editar Usuario</h4>
      </div>
      <div class='modal-body'>
                  <!-- statistics chart built with jQuery Flot -->           
        
        <form class='form-horizontal well' data-async data-target='#rating-modal'>
        <div class='form-group'>
                    <label for='ideditar' class='col-lg-2 control-label'>Id</label>
                    <div class='col-lg-10'>
                        <input type='number' class='form-control' name='ideditar' id='ideditar' value=".$edit_clientes[0].">
                    </div>
                </div>
            <div class='form-group'>
                    <label for='nom_edit' class='col-lg-2 control-label'>Nombre</label>
                    <div class='col-lg-10'>
                        <input type='text' class='form-control' name='nom_edit' id='nom_edit' value=".$edit_clientes[1].">
                    </div>
                </div>
                <div class='form-group'>
                    <label for='contra' class='col-lg-2 control-label'>Contraseña</label>
                    <div class='col-lg-10'>
                        <input type='text' class='form-control' name='contra' id='contra' value=".$edit_clientes[2].">
                    </div>
                </div>
                <div class='form-group'>
                    <label for='estado' class='col-lg-2 control-label'>Estado</label>
                    <div class='col-lg-10'>
                        <input type='number' class='form-control' name='estado' id='estado' value=".$edit_clientes[3].">
                    </div>
                </div>
                <div class='form-group'>
                    <label for='NombreCompleto' class='col-lg-2 control-label'>Nombre Completo</label>
                    <div class='col-lg-10'>
                        <input type='text' class='form-control' name='NombreCompleto' id='NombreCompleto' value=".$edit_clientes[4].">
                    </div>
                </div>
                <div class='form-group'>
                    <label for='dni_edit' class='col-lg-2 control-label'>Dni</label>
                    <div class='col-lg-10'>
                        <input type='text' class='form-control' name='dni_edit' id='dni_edit' value=".$edit_clientes[5].">
                    </div>
                </div>                
        </form>                
                          
      </div>
      <div class='modal-footer'>
        <button onclick='MD();' type='button' class='btn-flat'>Guardar</button>
        <button type='button' class='btn-flat white' data-dismiss='modal'>Cerrar</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->";

?>
