<?php
include_once '../config/dbconfig.php';
if(isset($_POST['btn-update']))
{
	$id = $_GET['edit_id'];
    $nro_factura = $_POST['nro_factura'];
    $fecha = $_POST['fecha'];
    $valor = $_POST['valor'];
    $concepto = $_POST['concepto'];
    $codigo_consultoria = $_POST['codigo_consultoria'];

    if($crud_facturacion_consultoria->update($id,$nro_factura,$fecha,$valor,$concepto,$codigo_consultoria))
	{
		$msg = "<div class='alert alert-info'>
				La facturación fue actualizada correctamente <a href='facturacion_consultoria.php'>RETORNAR A FACTURACIÓN</a>!
				</div>";
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				ERROR actualizando la facturación !
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($crud_facturacion_consultoria->getID($id));
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
            <td>Nro Factura</td>
            <td><input type='text' name='nro_factura' class='form-control' value="<?php echo $nro_factura; ?>" required></td>
        </tr>
        <tr class="success">
            <td>Fecha</td>
            <td>
                <div class="hero-unit">
                    <input name="fecha" type="text" placeholder="Click para ingresar la fecha"  id="fecha" class='form-control' value="<?php echo $fecha; ?>" required>
                </div>
            </td>
        </tr>
        <tr class="success">
            <td>Valor</td>
            <td><input type='text' name='valor' class='form-control' value="<?php echo $valor; ?>" required></td>
        </tr>
        <tr class="success">
            <td>Concepto</td>
            <td><input type='text' name='concepto' class='form-control' value="<?php echo $concepto; ?>" required></td>
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

                            <?php if ($row['id'] == $codigo_consultoria) { ?>
                                <option value="<?php echo $codigo_consultoria; ?>" selected><?php print($row['nombre']); ?></option>
                            <?php  }
                                  if ($row['id'] != $codigo_consultoria) { ?>
                                     <option value="<?php print($row['id']); ?>"> <?php print($row['nombre']); ?> </option>
                        <?php }   }
                    }
                    ?>

                </select>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Actualizar facturación
				</button>
                <a href="facturacion_consultoria.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCELAR</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>

