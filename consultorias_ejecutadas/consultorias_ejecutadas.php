<?php
include_once '../config/dbconfig.php';
//$_SESSION["codigo_consultor"] = 1;
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
    //$stmt = $DB_con->prepare("SELECT id, nombre FROM consultoria where estado = 'A'");
    //$stmt->execute();
    ?>

    <!-- <div class="success pui-grid-col-10">Consultorias creadas...  
         <select name="con_eje" id="con_eje" 
                 class="form-control" >
             <option value="" selected>Seleccione una consultoría...</option>
    <?php
    /* if ($stmt->rowCount() > 0) {
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      ?> <option value="<?php print(trim($row['id'])); ?>">
      <?php print(trim($row['nombre'])); ?></option>
      <?php
      }
      } */
    ?>
         </select>&nbsp;&nbsp;-->

    <div class="row">
        <div class="col-md-11">
            <select id="con_eje" name="con_eje" class="form-control">
                <option value="" selected>Seleccione una consultoría...</option>
                <?php
                foreach ($crud_consultoria_consultores->getConsultoriasXConsultor($_SESSION["codigo_consultor"]) as $value) {
                    if ($value['id'] == $_GET['consultoria_id']) {
                        ?>
                        <option value="<?php echo $_GET['consultoria_id']; ?>" selected><?php print($value['nombre']); ?></option>
                    <?php } else { ?>
                        <option value = "<?php print($value['id']); ?>"><?php print($value['nombre']); ?></option>  
                        <?php
                    }
                }
                ?>
            </select>

        </div>
        <div  class="col-md-1">
            <button id="find-ejec" type="button" 
                    title="Buscar trabajo realizado en la consultoría" 
                    class="btn btn-default glyphicon glyphicon-search"/>
        </div>
    </div>
    </br>
    <div id="msg"></div>
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
        </tbody>
    </table>


</div>

<?php include_once 'footer.php'; ?>

