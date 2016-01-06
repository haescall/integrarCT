<?php
include_once '../config/dbconfig.php';

if (isset($_POST['btn-del'])) {
    $id = $_GET['delete_id'];
    $id_usuario = $_GET['id_usuario'];
    $email = $_GET['email'];
    $crud_consultor->delete($id);
    $crud_usuario->deleteUsuario($id_usuario, $email);
    header("Location: delete_consultor.php?deleted");
}
?>

<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">

<?php
if (isset($_GET['deleted'])) {
    ?>
        <div class="alert alert-success">
            El Consultor fue eliminado con éxito...
        </div>
    <?php
} else {
    ?>
        <div class="alert alert-danger">
            <strong>Atención !</strong> Está seguro de eliminar este Consultor ?
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
                <th>Tipo Documento</th>
                <th>Documento</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cargo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Fecha Ingreso</th>
                <th>Estado</th>
                <th>Email Contacto</th>
            </tr>
    <?php
    $stmt = $DB_con->prepare("SELECT id, tipo_documento, documento, "
            . "nombres, apellidos, cargo, telefono, direccion, "
            . "fecha_ingreso, estado, email_contacto "
            . "FROM consultor WHERE id=:id");
    $stmt->execute(array(":id" => $_GET['delete_id']));
    while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
        ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['tipo_documento']); ?></td>
                    <td><?php print($row['documento']); ?></td>
                    <td><?php print($row['nombres']); ?></td>
                    <td><?php print($row['apellidos']); ?></td>
                    <td><?php print($row['cargo']); ?></td>
                    <td><?php print($row['telefono']); ?></td>
                    <td><?php print($row['direccion']); ?></td>
                    <td><?php print($row['fecha_ingreso']); ?></td>
                    <td><?php print($row['estado']); ?></td>
                    <td><?php print($row['email_contacto']); ?></td>
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
            <input type="hidden" name="id_usuario" value="<?php echo $_GET['id_usuario']; ?>" />
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" />
            <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; SI</button>
            <a href="consultor.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
        </form>  
            <?php
        } else {
            ?>
        <a href="consultor.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; RETORNAR A CONSULTORES</a>
    <?php
}
?>
</p>
</div>	
    <?php include_once 'footer.php'; ?>

