<?php
include_once '../config/dbconfig.php';
if (isset($_POST['btn-save'])) {
    //$cod_consul =  $_POST['cod_consul'];
    $codigo_fase = $_POST['codigo_fase'];
    $codigo_consultoria = $_POST['cod_consul'];
    $codigo_consultor = $_POST['codigo_consultor'];
    $fecha = $_POST['fecha'];
    $horas_laboradas = $_POST['horas_laboradas'];
    $valor = $_POST['valor'];
    $actividades = $_POST['actividades'];

    if ($crud_consultorias_ejecutadas->create($codigo_fase, $codigo_consultoria, $codigo_consultor, $fecha, $horas_laboradas, $valor, $actividades)) {
        header("Location: add-data_consultorias_ejecutadas.php?inserted");
    } else {
        header("Location: add-data_consultorias_ejecutadas.php?failure");
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
            Registro ejecutado con éxito. <a href="consultorias_ejecutadas.php">RETORNAR A CONSULTORIAS EJECUTADAS</a>!
        </div>
    </div>
    <?php
} else if (isset($_GET['failure'])) {
    ?>
    <div class="container">
        <div class="alert alert-warning">
            <strong>ERROR!</strong> ERROR creando el registro de la consultoría !
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
                <td>Consultoría</td>
                <td>
                    <select id="cod_consul" name="cod_consul" class="form-control" required>
                        <option value="" selected>Seleccione una consultoría...</option>
                        <?php
                        foreach ($crud_consultoria_consultores->getConsultoriasActivas() as $value) {
                            ?>
                            <option value = "<?php print($value['id']); ?>">
                                <?php print($value['nombre']); ?></option>  

                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr class="success">
                <td>Fecha</td>
                <td>
                    <div class="hero-unit">
                        <input name="fecha" type="text" placeholder="Click para ingresar la fecha"  id="fecha" class='form-control' required>
                    </div>
                </td>
            </tr>
            <?php
            $stmt = $DB_con->prepare("SELECT id, descripcion FROM fases");
            $stmt->execute();
            ?>

            <tr class="success">
                <td>Fase</td>
                <td>
                    <select name="codigo_fase" class="form-control" required>
                        <option value="" selected>Seleccione una fase...</option>
                        <?php
                        if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <option value="<?php print($row['id']); ?>">
                                    <?php print($row['descripcion']); ?>
                                </option>
                                <?php
                            }
                        }
                        ?>

                    </select>
                </td>
            </tr>
            <tr class="success">
                <td>Horas</td>
                <td><input type='text' name='horas_laboradas' class='form-control' required></td>
            </tr>
            <tr class="success">
                <td>Valor</td>
                <td><input type='text' name='valor' class='form-control' required></td>
            </tr>

            <tr class="success">
                <td>Labor Realizada</td>
                <td><textarea name="actividades" class="form-control" rows="3" required></textarea></td>
            </tr>
            <tr>

                <td colspan="2">
                    <button type="submit" class="btn btn-primary" name="btn-save" onclick="setCodigoConsultoria();">
                        <span class="glyphicon glyphicon-plus"></span> Registrar una consultoría ejecutada
                    </button>  
                    <a href="consultorias_ejecutadas.php" class="btn btn-large btn-success">
                        <i class="glyphicon glyphicon-backward"></i> &nbsp; RETORNAR A CONSULTORIAS EJECUTADAS</a>
                </td>
            </tr>

        </table>
    </form>


</div>

<?php include_once 'footer.php'; ?>

