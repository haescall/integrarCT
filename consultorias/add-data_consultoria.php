<?php
include_once '../config/dbconfig.php';
if(isset($_POST['btn-save']))
{
	$nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $codigo_cliente = $_POST['codigo_cliente'];
    $valor_contrato = $_POST['valor_contrato'];
    $entregables = $_POST['entregables'];
	$estado = $_POST['estado'];

	if($crud_consultoria->create($nombre,$descripcion,$fecha_inicio,$codigo_cliente,$valor_contrato,$entregables,$estado))
	{
		header("Location: add-data_consultoria.php?inserted");
	}
	else
	{
		header("Location: add-data_consultoria.php?failure");
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
    Consultoría creada con éxito. <a href="consultoria.php">RETORNAR A CONSULTORÍAS</a>!
	</div>
	</div>
    <?php
}
else if(isset($_GET['failure']))
{
	?>
    <div class="container">
	<div class="alert alert-warning">
    <strong>ERROR!</strong> ERROR creando la Consultoría !
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
            <td>Nombre</td>
            <td><input type='text' name='nombre' class='form-control' required></td>
        </tr>

        <tr class="success">
            <td>Descripción</td>
            <td><input type='text' name='descripcion' class='form-control' required></td>
        </tr>
 
        <tr class="success">
            <td>Fecha Inicio</td>
            <td>
                <div class="hero-unit">
                    <input name="fecha_inicio" type="text" placeholder="Click para ingresar la fecha"  id="fechaInicio" class='form-control' required>
                </div>
            </td>
        </tr>

        <?php
            $stmt = $DB_con->prepare("SELECT id, razon_social FROM cliente");
            $stmt->execute();
        ?>

        <tr class="success">
            <td>Cliente</td>
            <td>
                <select name="codigo_cliente" class="form-control" required>
                    <option value="" disabled selected>Seleccione un cliente...</option>
                    <?php
                        if($stmt->rowCount()>0)
                        {
                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){ ?>
                                <option value="<?php print($row['id']); ?>">
                                    <?php print($row['razon_social']); ?>
                                </option>
                            <?php    }
                        }
                    ?>

                </select>
            </td>


        </tr>

        <tr class="success">
            <td>Valor Contrato</td>
            <td><input type='text' name='valor_contrato' class='form-control' required></td>
        </tr>

        <tr class="success">
            <td>Entregables</td>
            <td><textarea name="entregables" class="form-control" rows="3" required></textarea></td>
        </tr>

        <tr class="success">
            <td>Estado</td>
            <td>
                <select name="estado" class='form-control' required>
                    <option value="A">ACTIVO</option>
                    <option value="I">INACTIVO</option>
                </select>
            </td>
        </tr>

        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Crear una nueva Consultoría
			</button>  
            <a href="consultoria.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; RETORNAR A CONSULTORÍAS</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>

