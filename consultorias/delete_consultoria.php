<?php
include_once '../config/dbconfig.php';

if (isset($_POST['btn-del'])) {
    $id = $_GET['delete_id'];
    $crud_consultoria->delete($id);
    header("Location: delete_consultoria.php?deleted");
}
?>

<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">

    <?php
    if (isset($_GET['deleted'])) {
        ?>
        <div class="alert alert-success">
            La Consultoría fue eliminada con éxito...
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-danger">
            <strong>Atención !</strong> Está seguro de eliminar esta Consultoría ?
        </div>
        <?php
    }
    ?>	
</div>

<div class="clearfix"></div>

<div class="container">

    <?php
    if (isset($_GET['delete_id'])) {
        ?>
        <table class='table table-bordered'>
            <tr class="success">
                <th>#</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha Inicio</th>
                <th>Cliente</th>
                <th>Valor Contrato</th>
                <th>Entregables</th>
                <th>Forma de pago</th>
                <th>Estado</th>
                <th>Fecha Creación</th>
                <th>Última Modificación</th>
            </tr>
            <?php
            $stmt = $DB_con->prepare("SELECT c.id, c.nombre, c.descripcion, c.fecha_inicio, cl.razon_social, c.valor_contrato, c.entregables, " .
                    " c.forma_pago, c.estado, c.created_at, c.updated_at " .
                    " FROM consultoria c, cliente cl " .
                    " WHERE c.codigo_cliente = cl.id AND c.id=:id");
            $stmt->execute(array(":id" => $_GET['delete_id']));
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['nombre']); ?></td>
                    <td><?php print($row['descripcion']); ?></td>
                    <td><?php print($row['fecha_inicio']); ?></td>
                    <td><?php print($row['razon_social']); ?></td>
                    <td><?php print($row['valor_contrato']); ?></td>
                    <td><?php print($row['entregables']); ?></td>
                    <td><?php print($row['forma_pago']); ?></td>
                    <td><?php print($row['estado']); ?></td>
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
        if (isset($_GET['delete_id'])) {
            ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
            <button class="btn btn-large btn-primary" type="submit" name="btn-del">
                <i class="glyphicon glyphicon-trash"></i> &nbsp; SI</button>
            <a href="consultoria.php" class="btn btn-large btn-success">
                <i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
        </form>  
        <?php
    } else {
        ?>
        <a href="consultoria.php" class="btn btn-large btn-success">
            <i class="glyphicon glyphicon-backward"></i> &nbsp; RETORNAR A CONSULTORÍAS</a>
            <?php
        }
        ?>
</p>
</div>	
<?php include_once 'footer.php'; ?>

