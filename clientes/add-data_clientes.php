<?php
include_once '../config/dbconfig.php';
if (isset($_POST['btn-save'])) {

    $nit = $_POST['nit'];
    $razon_social = $_POST['razon_social'];
    $objeto_social = $_POST['objeto_social'];
    $direccion = $_POST['direccion'];
    $nombre_contacto_1 = $_POST['nombre_contacto_1'];
    $cargo_contacto_1 = $_POST['cargo_contacto_1'];
    $email_contacto_1 = $_POST['email_contacto_1'];
    $telefono_contacto_1 = $_POST['telefono_contacto_1'];
    $nombre_contacto_2 = $_POST['nombre_contacto_2'];
    $cargo_contacto_2 = $_POST['cargo_contacto_2'];
    $email_contacto_2 = $_POST['email_contacto_2'];
    $telefono_contacto_2 = $_POST['telefono_contacto_2'];
    $estado = $_POST['estado'];

    if ($crud_clientes->create($nit, $razon_social, $objeto_social, $direccion, $nombre_contacto_1, $cargo_contacto_1, $email_contacto_1, $telefono_contacto_1, $nombre_contacto_2, $cargo_contacto_2, $email_contacto_2, $telefono_contacto_2, $estado)) {
        header("Location: add-data_clientes.php?inserted");
    } else {
        header("Location: add-data_clientes.php?failure");
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
            Cliente creado con éxito. <a href="clientes.php">RETORNAR A CLIENTES</a>!
        </div>
    </div>
    <?php
} else if (isset($_GET['failure'])) {
    ?>
    <div class="container">
        <div class="alert alert-warning">
            <strong>ERROR!</strong> ERROR creando al Cliente !
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
                <td>NIT</td>
                <td><input type='text' name='nit' class='form-control' required></td>
            </tr>

            <tr class="success">
                <td>Razón Social</td>
                <td><input type='text' name='razon_social' class='form-control' required></td>
            </tr>

            <tr class="success">
                <td>Objeto Social</td>
                <td><input type='text' name='objeto_social' class='form-control' required></td>
            </tr>

            <tr class="success">
                <td>Dirección</td>
                <td><input type='text' name='direccion' class='form-control' required></td>
            </tr>

            <tr class="success">
                <td>Nombres Contacto 1</td>
                <td><input type='text' name='nombre_contacto_1' class='form-control' required></td>
            </tr>

            <tr class="success">
                <td>Cargo Contacto 1</td>
                <td><input type='text' name='cargo_contacto_1' class='form-control' required></td>
            </tr>

            <tr class="success">
                <td>Email Contacto 1</td>
                <td><input type='text' name='email_contacto_1' class='form-control' required></td>
            </tr>

            <tr class="success">
                <td>Teléfono Contacto 1</td>
                <td><input type='text' name='telefono_contacto_1' class='form-control' required></td>
            </tr>

            <tr class="success">
                <td>Nombres Contacto 2</td>
                <td><input type='text' name='nombre_contacto_2' class='form-control' required></td>
            </tr>

            <tr class="success">
                <td>Cargo Contacto 2</td>
                <td><input type='text' name='cargo_contacto_2' class='form-control' required></td>
            </tr>

            <tr class="success">
                <td>Email Contacto 2</td>
                <td><input type='text' name='email_contacto_2' class='form-control' required></td>
            </tr>


            <tr class="success">
                <td>Teléfono Contacto 2</td>
                <td><input type='text' name='telefono_contacto_2' class='form-control' required></td>
            </tr>

            <tr class="success">
                <td>Estado</td>
                <td>
                    <select name="estado" class='form-control'>
                        <option value="A">ACTIVO</option>
                        <option value="I">INACTIVO</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary" name="btn-save">
                        <span class="glyphicon glyphicon-plus"></span> Crear un nuevo Cliente
                    </button>  
                    <a href="clientes.php" class="btn btn-large btn-success">
                        <i class="glyphicon glyphicon-backward"></i> &nbsp; RETORNAR A CLIENTES</a>
                </td>
            </tr>

        </table>
    </form>


</div>

<?php include_once 'footer.php'; ?>

