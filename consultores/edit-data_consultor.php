<?php
include_once '../config/dbconfig.php';
if(isset($_POST['btn-update']))
{
	$id = $_GET['edit_id'];
    $tipo_documento = $_POST['tipo_documento'];
    $documento = $_POST['documento'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $cargo = $_POST['cargo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $estado = $_POST['estado'];
    $email_contacto = $_POST['email_contacto'];
	
	if($crud_consultor->update($id,$tipo_documento,$documento,$nombres,$apellidos,$cargo,$telefono,$direccion,$fecha_ingreso, $estado, $email_contacto))
	{
		$msg = "<div class='alert alert-info'>
				El Consultor fue actualizado correctamente <a href='consultor.php'>RETORNAR A CONSULTORES</a>!
				</div>";
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				ERROR actualizando el Consultor !
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($crud_consultor->getID($id));
}

?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
	echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 
     <form method='post'>

    <table class='table table-bordered'>
 
        <tr class="success">
            <td>Tipo Documento</td>
            <td>
                <select name="tipo_documento" class='form-control' required>
                    <option select value="<?php echo $tipo_documento; ?>"><?php if ($tipo_documento=='CC'){echo "Cédula de Ciudadanía";}elseif($tipo_documento=='CE'){echo "Cédula de Extranjería";} ?></option>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="CE">Cédula de Extranjería</option>
                </select>
            </td>

        </tr>
 
        <tr class="success">
            <td>Documento</td>
            <td><input type='text' name='documento' class='form-control' value="<?php echo $documento; ?>" required></td>
        </tr>
 
        <tr class="success">
            <td>Nombres</td>
            <td><input type='text' name='nombres' class='form-control' value="<?php echo $nombres; ?>" required></td>
        </tr>
 
        <tr class="success">
            <td>Apellidos</td>
            <td><input type='text' name='apellidos' class='form-control' value="<?php echo $apellidos; ?>" required></td>
        </tr>

        <tr class="success">
            <td>Cargo</td>
            <td><input type='text' name='cargo' class='form-control' value="<?php echo $cargo; ?>" required></td>
        </tr>

        <tr class="success">
            <td>Teléfono</td>
            <td><input type='text' name='telefono' class='form-control' value="<?php echo $telefono; ?>" required></td>
        </tr>

        <tr class="success">
            <td>Dirección</td>
            <td><input type='text' name='direccion' class='form-control' value="<?php echo $direccion; ?>" required></td>
        </tr>

        <tr class="success">
            <td>Fecha Ingreso</td>
            <td>
                <div class="hero-unit">
                    <input name="fecha_ingreso" type="text" placeholder="Click para ingresar la fecha"  id="fecha" class='form-control' value="<?php echo $fecha_ingreso; ?>" required>
                </div>
            </td>
        </tr>
        <tr class="success">
            <td>Estado</td>
            <td>
                <select name="estado" class='form-control'>
                    <option select value="<?php echo $estado; ?>"><?php if ($estado=='A'){echo "ACTIVO";}else{echo "INACTIVO";} ?></option>
                    <option value="A">ACTIVO</option>
                    <option value="I">INACTIVO</option>
                </select>
            </td>
        <tr class="success">
            <td>Email Contacto</td>
            <td><input type='text' name='email_contacto' class='form-control' value="<?php echo $email_contacto; ?>" required></td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Actualizar Consultor
				</button>
                <a href="consultor.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCELAR</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>

