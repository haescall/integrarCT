<?php
include_once '../config/dbconfig.php';
include_once 'header.php';
?>

<div class="clearfix"></div>
<div class="container">
    <a href="add-data_consultoria.php" class="btn btn-large btn-info">
        <i class="glyphicon glyphicon-plus">
        </i> &nbsp; Crear Consultorias para los Clientes</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
    <table class='table table-bordered table-responsive'>
        <tr class="success">
            <th>#</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Fecha Inicio</th>
            <th>Cliente</th>
            <th>Valor Contrato</th>
            <th>Entregables</th>
            <th>Forma de pago</th>
            <th>Estado</th>            
            <th>Fecha Creacion</th>
            <th>Última Modificación</th>
            <th colspan="4" align="center">Acciones</th>
        </tr>
        <?php
        $query = " SELECT c.id, c.nombre, c.descripcion, c.fecha_inicio, "
                . "cl.razon_social, c.valor_contrato, c.entregables, " .
                " c.forma_pago, c.estado,  c.created_at, c.updated_at " .
                " FROM consultoria c, cliente cl " .
                " WHERE c.codigo_cliente = cl.id";
        $records_per_page = 10;
        $newquery = $crud_consultoria->paging($query, $records_per_page);
        $crud_consultoria->dataview($newquery);
        ?>
        <tr>
            <td colspan="14" align="center">
                <div class="pagination-wrap">
                    <?php $crud_consultoria->paginglink($query, $records_per_page); ?>
                </div>
            </td>
        </tr>

    </table>

</div>

<!-- VENTANA MODAL DE LA ASIGNACIN DE CONSULTORES************************************************************ -->
<div id="consul" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button id="close" class="close" 
                        data-dismiss="modal" aria-hidden="true">&times;</button>
                <div id="titulo_asig" class="alert alert-info"></div>
                <!--<h4 id="titulo_asig" class="alert alert-info">Lista y Asignación de Consultores</h4>-->
            </div>
            <div id="msg"></div>
            <div class="modal-body">
                <p class="text-justify">
                    <!-- INFORMACION CONSULTORES -->
                <table class='table table-bordered'>
                    <tr class="success">
                        <th>ID Consultor</th>
                        <th>Nombres</th>
                        <th>Cargo</th>
                        <th>Valor Hora</th>
                        <th>Estado</th>
                        <th colspan="2">Acción</th>
                    </tr>
                    <tbody id="consultores">
                    </tbody>
                </table>
                <div id="cosultores_disp">

                </div>
            </div>
            </p>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>


<!-- VENTANA MODAL DE LA ASIGNACIN DE CONSULTORES************************************************************ -->
<div id="dlg-presu" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button id="close" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div id="titulo_presu" class="alert alert-info"></div>
            </div>
            <div id="msg"></div>
            <div class="modal-body">
                <p class="text-justify">
                    <!-- INFORMACION CONSULTORES -->
                <table class='table table-bordered'>
                    <tr class="success">
                        <th>ID Fase</th>
                        <th>Descripcion</th>
                        <th>Hora Presupuestadas</th>
                        <th>Acción</th>
                    </tr>
                    <tbody id="presupuesto">
                    </tbody>
                </table>
                <div id="presu_disp">

                </div>
            </div>
            </p>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>

<?php include_once 'footer.php'; ?>

