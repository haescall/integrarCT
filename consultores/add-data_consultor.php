<?php
include_once '../config/dbconfig.php';
if(isset($_POST['btn-save']))
{
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
	
	if($crud_consultor->create($tipo_documento,$documento,$nombres,$apellidos,$cargo,$telefono,$direccion,$fecha_ingreso, $estado, $email_contacto))
	{
		header("Location: add-data_consultor.php?inserted");
	}
	else
	{
		header("Location: add-data_consultor.php?failure");
	}
}
?>
<?php include_once 'header.php'; ?>
<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
	?>
    <div class="container">
	<div class="alert alert-info">
    Consultor creado con éxito. <a href="consultor.php">RETORNAR A CONSULTORES</a>!
	</div>
	</div>
    <?php
}
else if(isset($_GET['failure']))
{
	?>
    <div class="container">
	<div class="alert alert-warning">
    <strong>ERROR!</strong> ERROR creando al Consultor !
	</div>
	</div>
    <?php
}
?>

<div class="clearfix"></div><br />

<div class="container">

 	
	 <form method='post'>
 
    <table class='table table-bordered'>
 
        <tr class="success">
            <td>Tipo Documento</td>
            <td>
                <select name="tipo_documento" class='form-control' required>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="CE">Cédula de Extranjería</option>
                </select>
            </td>
        </tr>
 
        <tr class="success">
            <td>Documento</td>
            <td><input type='text' name='documento' class='form-control' required></td>
        </tr>
 
        <tr class="success">
            <td>Nombres</td>
            <td><input type='text' name='nombres' class='form-control' required></td>
        </tr>
 
        <tr class="success">
            <td>Apellidos</td>
            <td><input type='text' name='apellidos' class='form-control' required></td>
        </tr>

        <tr class="success">
            <td>Cargo</td>
            <td><input type='text' name='cargo' class='form-control' required></td>
        </tr>

        <tr class="success">
            <td>Teléfono</td>
            <td><input type='text' name='telefono' class='form-control' required></td>
        </tr>

        <tr class="success">
            <td>Dirección</td>
            <td><input type='text' name='direccion' class='form-control' required></td>
        </tr>

        <tr class="success">
            <td>Fecha Ingreso</td>
            <td>
                <div class="hero-unit">
                    <input name="fecha_ingreso" type="text" placeholder="Click para ingresar la fecha"  id="fecha" class='form-control' required>
                </div>
            </td>
        </tr>

        <tr class="success">
            <td>Estado</td>
            <td>
                <select name="estado" class='form-control'>
                    <option value="A">ACTIVO</option>
                    <option value="I">INACTIVO</option>
                </select>
            </td>
        </tr>

        <tr class="success">
            <td>Email Contacto</td>
            <td><input type='text' name='email_contacto' class='form-control' required></td>
        </tr>
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Crear un nuevo Consultor
			</button>  
            <a href="consultor.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; RETORNAR A CONSULTORES</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>

