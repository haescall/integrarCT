<?php
include_once '../config/dbconfig.php';

if (isset($_POST['btn-pass'])) {

    $email = $_SESSION["email"];
    $passnew = $_POST['passnew'];

    if ($crud_usuario->cambiar_contrasena($email, $passnew)) {
        $msg = "<div class='alert alert-info'>
			La Contraseña fue actualizada correctamente</div>";
    } else {
        $msg = "<div class='alert alert-info'>
			Error al actualizar la Contraseña</div>";
    }
    //exit();
}
?>

<?php include_once 'header.php'; ?>

<div class="clearfix"></div><br />
<div class="container">
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
    <form method='post'>
        <table class='table table-bordered'>
            <tr class="success">
                <td>Ingrese la contraseña nueva</td>
                <td><input type='text' name='passnew' class='form-control' required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary" name="btn-pass">
                        <span class="glyphicon glyphicon-flash"></span> Cambiar contraseña
                    </button>  
                </td>
            </tr>
        </table>
    </form>
    <div class="clearfix"></div>
    <div class="container">
    </div>
</div>

<?php include_once 'footer.php'; ?>
