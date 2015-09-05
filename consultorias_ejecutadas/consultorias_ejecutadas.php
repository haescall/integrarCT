<?php
include_once '../config/dbconfig.php';
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
    <a href="add-data_consultorias_ejecutadas.php?id_consul=<?php $_POST['codigo_consultoria']; ?>" 
       class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus">
        </i> &nbsp; Crear Registro de Consultoría</a>
</div>

<div class="clearfix"></div><br/>



<div class="container">

    <?php
    $stmt = $DB_con->prepare("SELECT id, nombre FROM consultoria where estado = 'A'");
    $stmt->execute();
    ?>

    <tr class="success">
        <td>Consultorias creadas...</td>  
        <td>
            <select name="codigo_consultoria" class="form-control" id="codigo_consultoria" required>
                <option value="" selected>Seleccione una consultoría...</option>
                <?php
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <option value="<?php print($row['id']); ?>">
                            <?php print($row['nombre']); ?>
                        </option>
                        <?php
                    }
                }
                ?>

            </select>
        </td>
    </tr>

    </br>

    Registro de horas y actividades...
    <table class='table table-bordered table-responsive'>
        <tr class="success">
            <th>#</th>
            <th>Fecha</th>
            <th>Fase</th>
            <th>Horas</th>
            <th>Valor</th>
            <th>Labor Realizada</th>
            <th colspan="2" align="center">Acciones</th>
        </tr>
        <tbody id="data">
        </tbody>
    </table>


</div>

<?php include_once 'footer.php'; ?>

