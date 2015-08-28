<?php
include_once '../config/dbconfig.php';

if(isset($_POST['btn-del']))
{
	$id = $_GET['delete_id'];
    $crud_fases->delete($id);
	header("Location: delete_fases.php?deleted");
}

?>

<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">

	<?php
	if(isset($_GET['deleted']))
	{
		?>
        <div class="alert alert-success">
    	La Fase fué eliminada con éxito...
		</div>
        <?php
	}
	else
	{
		?>
        <div class="alert alert-danger">
    	<strong>Atención !</strong> Está seguro de eliminar esta Fase ?
		</div>
        <?php
	}
	?>	
</div>

<div class="clearfix"></div>

<div class="container">
 	
	 <?php
	 if(isset($_GET['delete_id']))
	 {
		 ?>
         <table class='table table-bordered'>
         <tr class="success">
         <th>#</th>
         <th>Descripción</th>
         <th>Fecha Creación</th>
         <th>Última Modificación</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT id, descripcion, created_at, updated_at FROM fases WHERE id=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['id']); ?></td>
             <td><?php print($row['descripcion']); ?></td>
             <td><?php print($row['created_at']); ?></td>
         	 <td><?php print($row['updated_at']); ?></td>
             </tr>
             <?php
         }
         ?>
         </table>
         <?php
	 }
	 ?>
</div>

<div class="container">
<p>
<?php
if(isset($_GET['delete_id']))
{
	?>
  	<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; SI</button>
    <a href="fases.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
	<?php
}
else
{
	?>
    <a href="fases.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; RETORNAR A FASES</a>
    <?php
}
?>
</p>
</div>	
<?php include_once 'footer.php'; ?>

