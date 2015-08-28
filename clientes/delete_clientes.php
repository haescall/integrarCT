<?php
include_once '../config/dbconfig.php';

if(isset($_POST['btn-del']))
{
	$id = $_GET['delete_id'];
    $crud_clientes->delete($id);
	header("Location: delete_clientes.php?deleted");
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
    	El cliente fue eliminado con éxito...
		</div>
        <?php
	}
	else
	{
		?>
        <div class="alert alert-danger">
    	<strong>Atención !</strong> Está seguro de eliminar este Cliente ?
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
             <th>NIT</th>
             <th>Razón Social</th>
             <th>Objeto Social</th>
             <th>Dirección</th>
             <th>Nombre Contacto1</th>
             <th>Cargo Contacto1</th>
             <th>Email Contacto1</th>
             <th>Teléfono Contacto1</th>
             <th>Nombre Contacto2</th>
             <th>Cargo Contacto2</th>
             <th>Email Contacto2</th>
             <th>Teléfono Contacto2</th>
             <th>Estado</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare(" SELECT id, nit, razon_social, objeto_social, direccion, ".
                                  " nombre_contacto_1, cargo_contacto_1, email_contacto_1, telefono_contacto_1, ".
                                  " nombre_contacto_2, cargo_contacto_2, email_contacto_2, telefono_contacto_2, estado FROM cliente WHERE id=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['id']); ?></td>
                 <td><?php print($row['nit']); ?></td>
                 <td><?php print($row['razon_social']); ?></td>
                 <td><?php print($row['objeto_social']); ?></td>
                 <td><?php print($row['direccion']); ?></td>
                 <td><?php print($row['nombre_contacto_1']); ?></td>
                 <td><?php print($row['cargo_contacto_1']); ?></td>
                 <td><?php print($row['email_contacto_1']); ?></td>
                 <td><?php print($row['telefono_contacto_1']); ?></td>
                 <td><?php print($row['nombre_contacto_2']); ?></td>
                 <td><?php print($row['cargo_contacto_2']); ?></td>
                 <td><?php print($row['email_contacto_2']); ?></td>
                 <td><?php print($row['telefono_contacto_2']); ?></td>
                 <td><?php print($row['estado']); ?></td>
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
    <a href="clientes.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
	<?php
}
else
{
	?>
    <a href="clientes.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; RETORNAR A CLIENTES</a>
    <?php
}
?>
</p>
</div>	
<?php include_once 'footer.php'; ?>

