<?php
include_once '../config/dbconfig.php';
if(isset($_POST['btn-save']))
{
	$descripcion = $_POST['descripcion'];
    $created_at = $_POST['created_at'];

	if($crud_fases->create($descripcion))
	{
		header("Location: add-data_fases.php?inserted");
	}
	else
	{
		header("Location: add-data_fases.php?failure");
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
    Fase creada con éxito. <a href="fases.php">RETORNAR A FASES</a>!
	</div>
	</div>
    <?php
}
else if(isset($_GET['failure']))
{
	?>
    <div class="container">
	<div class="alert alert-warning">
    <strong>ERROR!</strong> ERROR creando la fase !
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
            <td>Descripción</td>
            <td><input type='text' name='descripcion' class='form-control' required></td>
        </tr>

        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Crear una nueva Fase
			</button>  
            <a href="fases.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; RETORNAR A FASES</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>

