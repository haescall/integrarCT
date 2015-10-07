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

    <div id="panelCons">
        <?php
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <h3 data-id-consultoria="<?php print($row['id']); ?>">
                    <?php print($row['nombre']); ?></h3>
                <div>
                    <table class='table table-bordered table-responsive'>
                        <caption>Registro de horas y actividades...</caption>
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
                        <td>1</td>
                        <td>23/01/2015</td>
                        <td>Fase 1</td>
                        <td>10</td>
                        <td>50000</td>
                        <td>Labor Realizada</td>
                        <td>Icono para borrar o lo que sea</td>
                        </tbody>
                    </table>
                </div>
                <?php
            }
        }
        ?>
    </div></br>





</div>

<?php include_once 'footer.php'; ?>

