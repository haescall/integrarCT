<?php
include_once '../config/dbconfig.php';
if (isset($_POST['btn-update'])) {
    $id = $_GET['edit_id'];
    $id_consultoria = $_POST['cod_consul'];
    $codigo_fase = $_POST['codigo_fase'];
    $fecha = $_POST['fecha'];
    $horas_laboradas = $_POST['horas_laboradas'];
    $valor = $_POST['valor'];
    $actividades = $_POST['actividades'];

    if ($crud_consultorias_ejecutadas->update($id, $id_consultoria, $codigo_fase, $fecha, $horas_laboradas, $valor, $actividades)) {
        $msg = "<div class='alert alert-info'>
			La Consultoría ejecutada fue actualizada correctamente <a href='consultorias_ejecutadas.php'>RETORNAR A CONSULTORÍAS EJECUTADAS</a>!
			</div>";
    } else {
        $msg = "<div class='alert alert-warning'>
				ERROR actualizando la Consultoría ejecutada !
				</div>";
    }
}

if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    extract($crud_consultorias_ejecutadas->getID($id));
    $id_consultoria = $_GET['data-id-consultoria'];
}
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
</div>

<div class="clearfix"></div><br />

<div class="container">

    <form method='post'>

        <table class='table table-bordered'>
            <tr class="success">
                <td>Fecha</td>
                <td>
                    <div class="hero-unit">
                        <input name="fecha" type="text" 
                               placeholder="Click para ingresar la fecha"  
                               id="fecha" class='form-control' 
                               value="<?php echo $fecha; ?>" required>
                    </div>
                </td>
            </tr>

            <tr class="success">
                <td>Consultoría</td>
                <td>
                    <select id="cod_consul" name="cod_consul" class="form-control" required>
                        <option value="" selected>Seleccione una consultoría...</option>
                        <?php
                        foreach ($crud_consultoria_consultores->getConsultoriasXConsultor($_SESSION["codigo_consultor"]) as $value) {
                            if ($value['id'] == $id_consultoria) {
                                ?>
                                <option value="<?php echo $id_consultoria; ?>" selected><?php print($value['nombre']); ?></option>
                            <?php } else { ?>
                                <option value = "<?php print($value['id']); ?>"><?php print($value['nombre']); ?></option>  
                                <?php
                            }
                        }
                        ?>
                    </select>
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

                                <?php if ($row['id'] == $codigo_fase) { ?>
                                    <option value="<?php echo $codigo_fase; ?>" selected><?php print($row['descripcion']); ?></option>
                                    <?php
                                }
                                if ($row['id'] != $codigo_fase) {
                                    ?>
                                    <option value="<?php print($row['id']); ?>"> <?php print($row['descripcion']); ?> </option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr class="success">
                <td>Horas</td>
                <td><input type='text' name='horas_laboradas' 
                           class='form-control' value="<?php echo $horas_laboradas; ?>" required></td>
            </tr>
            <tr class="success">
                <td>Valor</td>
                <td><input type='text' name='valor' class='form-control' 
                           value="<?php echo $valor; ?>" required></td>
            </tr>

            <tr class="success">
                <td>Labor Realizada</td>
                <td><textarea name="actividades" class="form-control"  
                              rows="3" required><?php echo $actividades; ?></textarea></td>
            </tr>
            <tr>

            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary" name="btn-update">
                        <span class="glyphicon glyphicon-edit"></span>  Actualizar registro de la consultoría
                    </button>
                    <!--<a  href="javascript:window.history.back();" 
                        onclick="getEjecucionesXConsultoria();" 
                        class="btn btn-large btn-success">
                        <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCELAR</a>-->

                    <a href="consultorias_ejecutadas.php?consultoria_id=<?php echo $id_consultoria ?>" 
                       class="btn btn-large btn-success">
                        <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCELAR</a>
                </td>
            </tr>

        </table>
    </form>


</div>

<?php include_once 'footer.php'; ?>

