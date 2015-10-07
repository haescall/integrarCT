<?php
include_once '../config/dbconfig.php';

if(isset($_POST['btn-del']))
{
    $id = $_GET['delete_id'];
    $crud_consultorias_ejecutadas->delete($id);
    header("Location: delete_consultorias_ejecutadas.php?deleted");
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
    	El registro de la consultoría fué eliminado con éxito...
		</div>
        <?php
	}
	else
	{
		?>
        <div class="alert alert-danger">
    	<strong>Atención !</strong> Está seguro de eliminar esta Consultoría ejecutada ?
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
         <th>Fecha</th>
         <th>Fase</th>
         <th>Horas</th>
         <th>Valor</th>
         <th>Labor Realizada</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT ce.id, ce.fecha, f.descripcion fase, ce.horas_laboradas, ce.valor, ce.actividades "
                               . " FROM consultorias_ejecutadas ce, fases f where ce.codigo_fase = f.id and ce.id=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['id']); ?></td>
             <td><?php print($row['fecha']); ?></td>
             <td><?php print($row['fase']); ?></td>
             <td><?php print($row['horas_laboradas']); ?></td>
             <td><?php print($row['valor']); ?></td>
             <td><?php print($row['actividades']); ?></td>
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
        <a href="consultorias_ejecutadas.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
        </form>  
	<?php
}
else
{
	?>
        <a href="consultorias_ejecutadas.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; RETORNAR A CONSULTORÍAS EJECUTADAS</a>
    <?php
}
?>
</p>
</div>	
<?php include_once 'footer.php'; ?>

