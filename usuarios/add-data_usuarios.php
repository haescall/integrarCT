<?php
include_once '../config/dbconfig.php';
if (isset($_POST['btn-save'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember_token = $_POST['email'];

    if ($crud_usuarios->create($name, $email, $password, $remember_token)) {
        header("Location: add-data_usuarios.php?inserted");
    } else {
        header("Location: add-data_usuarios.php?failure");
    }
}
?>
<?php include_once 'header.php'; ?>
<div class="clearfix"></div>

<?php
if (isset($_GET['inserted'])) {
    ?>
    <div class="container">
        <div class="alert alert-info">
            Cliente creado con éxito. <a href="usuarios.php">RETORNAR A USUARIOS</a>!
        </div>
    </div>
    <?php
} else if (isset($_GET['failure'])) {
    ?>
    <div class="container">
        <div class="alert alert-warning">
            <strong>ERROR!</strong> ERROR creando al Usuario!
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
                <td>Nombre Usuario</td>
                <td><input type='text' name='name' class='form-control' required></td>
            </tr>

            <tr class="success">
                <td>E-Mail</td>
                <td><input type='text' name='email' class='form-control' required></td>
            </tr>

            <tr class="success">
                <td>Password</td>
                <td><input type='text' name='password' class='form-control' required></td>
            </tr>

            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary" name="btn-save">
                        <span class="glyphicon glyphicon-plus"></span> Crear un nuevo Usuario
                    </button>  
                    <a href="clientes.php" class="btn btn-large btn-success">
                        <i class="glyphicon glyphicon-backward"></i> &nbsp; RETORNAR A USUARIOS</a>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include_once 'footer.php'; ?>

