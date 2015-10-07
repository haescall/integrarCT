<?php
include_once '../config/dbconfig.php';

if(isset($_POST['btn-del']))
{
	$id = $_GET['delete_id'];
    $crud_facturacion_consultoria->delete($id);
	header("Location: delete_facturacion_consultoria.php?deleted");
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
    	La Facturación fué eliminada con éxito...
		</div>
        <?php
	}
	else
	{
		?>
        <div class="alert alert-danger">
    	<strong>Atención !</strong> Está seguro de eliminar esta Facturación ?
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
         <th>Nro Factura</th>
         <th>Fecha</th>
         <th>Valor</th>
         <th>Concepto</th>
         <th>Consultoría</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT f.id, nro_factura,fecha, valor, concepto, c.nombre consultoria FROM facturacion_consultoria f, consultoria c where c.id = f.codigo_consultoria and f.id=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['id']); ?></td>
             <td><?php print($row['nro_factura']); ?></td>
             <td><?php print($row['fecha']); ?></td>
         	 <td><?php print($row['valor']); ?></td>
             <td><?php print($row['concepto']); ?></td>
             <td><?php print($row['consultoria']); ?></td>
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
    <a href="facturacion_consultoria.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
	<?php
}
else
{
	?>
    <a href="facturacion_consultoria.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; RETORNAR A FACTURACIÓN</a>
    <?php
}
?>
</p>
</div>	
<?php include_once 'footer.php'; ?>

