<?php
include_once '../config/dbconfig.php';

if (isset($_POST['btn-del'])) {
    $id = $_GET['delete_id'];
    $crud_usuarios->delete($id);
    header("Location: delete_usuarios.php?deleted");
}
?>

<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">

    <?php
    if (isset($_GET['deleted'])) {
        ?>
        <div class="alert alert-success">
            El usuario fue eliminado con éxito...
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-danger">
            <strong>Atención !</strong> Está seguro de eliminar este Usuario ?
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
                <th>Nombre Usuario</th>
                <th>E-Mail</th>
                <th>Password</th>
            </tr>
            <?php
            $stmt = $DB_con->prepare(" SELECT * FROM cliente WHERE id=:id");
            $stmt->execute(array(":id" => $_GET['delete_id']));
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['name']); ?></td>
                    <td><?php print($row['email']); ?></td>
                    <td><?php print($row['password']); ?></td>
                    <td><?php print($row['remember_token']); ?></td>
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
            <a href="usuarios.php" class="btn btn-large btn-success">
                <i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
        </form>  
        <?php
    } else {
        ?>
        <a href="usuarios.php" class="btn btn-large btn-success">
            <i class="glyphicon glyphicon-backward"></i> &nbsp; RETORNAR A CLIENTES</a>
            <?php
        }
        ?>
</p>
</div>	
<?php include_once 'footer.php'; ?>

