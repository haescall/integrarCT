<?php
include_once '../config/dbconfig.php';
if(isset($_POST['btn-update']))
{
	$id = $_GET['edit_id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $codigo_cliente = $_POST['codigo_cliente'];
    $valor_contrato = $_POST['valor_contrato'];
    $entregables = $_POST['entregables'];
    $estado = $_POST['estado'];
	
	if($crud_consultoria->update($id,$nombre,$descripcion,$fecha_inicio,$codigo_cliente,$valor_contrato,$entregables,$estado))
	{
		$msg = "<div class='alert alert-info'>
				La Consultoría fue actualizada correctamente <a href='consultoria.php'>RETORNAR A CONSULTORÍAS</a>!
				</div>";
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				ERROR actualizando la Consultoría !
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($crud_consultoria->getID($id));
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
            <td>Nombre</td>
            <td><input type='text' name='nombre' class='form-control' value="<?php echo $nombre; ?>" required></td>
        </tr>

        <tr class="success">
            <td>Descripción</td>
            <td><input type='text' name='descripcion' class='form-control' value="<?php echo $descripcion; ?>" required></td>
        </tr>

        <tr class="success">
            <td>Fecha Inicio</td>
            <td>
                <div class="hero-unit">
                    <input name="fecha_inicio" type="text" placeholder="Click para ingresar la fecha"  id="fechaInicio" class='form-control' value="<?php echo $fecha_inicio; ?>" required>
                </div>
            </td>
        </tr>
 
        <tr class="success">
            <td>Cliente</td>
            <td><input type='text' name='codigo_cliente' class='form-control' value="<?php echo $codigo_cliente; ?>" required></td>
        </tr>

        <tr class="success">
            <td>Valor Contrato</td>
            <td><input type='text' name='valor_contrato' class='form-control' value="<?php echo $valor_contrato; ?>" required></td>
        </tr>

        <tr class="success">
            <td>Entregables</td>
            <td><textarea name="entregables" class="form-control" rows="3" required><?php echo $entregables; ?></textarea></td>
        </tr>

        <tr class="success">
            <td>Estado</td>
            <td>
                <select name="estado" class='form-control'>
                    <option select value="<?php echo $estado; ?>"><?php if ($estado=="A"){echo "ACTIVO";}else{echo "INACTIVO";} ?></option>
                    <option value="A">ACTIVO</option>
                    <option value="I">INACTIVO</option>
                </select>
            </td>
        </tr>


        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Actualizar Consultoría
				</button>
                <a href="consultoria.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCELAR</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>

