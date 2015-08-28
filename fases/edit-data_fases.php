<?php
include_once '../config/dbconfig.php';
if(isset($_POST['btn-update']))
{
	$id = $_GET['edit_id'];
	$descripcion = $_POST['descripcion'];

	if($crud_fases->update($id,$descripcion))
	{
		$msg = "<div class='alert alert-info'>
				La fase fue actualizada correctamente <a href='fases.php'>RETORNAR A FASES</a>!
				</div>";
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				ERROR actualizando la fase !
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($crud_fases->getID($id));
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
            <td>Descripción</td>
            <td><input type='text' name='descripcion' class='form-control' value="<?php echo $descripcion; ?>" required></td>
        </tr>
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Actualizar Fase
				</button>
                <a href="fases.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCELAR</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>

