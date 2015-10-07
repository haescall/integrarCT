<?php
include_once '../config/dbconfig.php';
if(isset($_POST['btn-save']))
{
	$nro_factura = $_POST['nro_factura'];
    $fecha = $_POST['fecha'];
    $valor = $_POST['valor'];
    $concepto = $_POST['concepto'];
    $codigo_consultoria = $_POST['codigo_consultoria'];

	if($crud_facturacion_consultoria->create($nro_factura,$fecha,$valor,$concepto,$codigo_consultoria))
	{
		header("Location: add-data_facturacion_consultoria.php?inserted");
	}
	else
	{
		header("Location: add-data_facturacion_consultoria.php?failure");
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
    Facturación registrada con éxito. <a href="facturacion_consultoria.php">RETORNAR A FACTURACION</a>!
	</div>
	</div>
    <?php
}
else if(isset($_GET['failure']))
{
	?>
    <div class="container">
	<div class="alert alert-warning">
    <strong>ERROR!</strong> ERROR creando la Facturación !
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
            <td>Nro Factura</td>
            <td><input type='text' name='nro_factura' class='form-control' required></td>
        </tr>
        <tr class="success">
            <td>Fecha</td>
            <td>
                <div class="hero-unit">
                    <input name="fecha" type="text" placeholder="Click para ingresar la fecha"  id="fecha" class='form-control' required>
                </div>
            </td>
        </tr>
        <tr class="success">
            <td>Valor</td>
            <td><input type='text' name='valor' class='form-control' required></td>
        </tr>
        <tr class="success">
            <td>Concepto</td>
            <td><input type='text' name='concepto' class='form-control' required></td>
        </tr>
            <?php
            $stmt = $DB_con->prepare("SELECT id, nombre FROM consultoria where estado = 'A'");
            $stmt->execute();
            ?>

            <tr class="success">
                <td>Consultoria</td>
                <td>
                    <select name="codigo_consultoria" class="form-control" required>
                        <option value="" selected>Seleccione una consultoría...</option>
                        <?php
                        if($stmt->rowCount()>0)
                        {
                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){ ?>
                                <option value="<?php print($row['id']); ?>">
                                    <?php print($row['nombre']); ?>
                                </option>
                            <?php    }
                        }
                        ?>

                    </select>
                </td>
            </tr>

        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Registrar una nueva facturación
			</button>  
            <a href="facturacion_consultoria.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; RETORNAR A FACTURACIÓN</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>

