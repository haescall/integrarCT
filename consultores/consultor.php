<?php
include_once '../config/dbconfig.php';
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
    <a href="add-data_consultor.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Crear Consultores</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
    <table class='table table-bordered table-responsive'>
        <tr class="success">
            <th>#</th>
            <th>Tipo Documento</th>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Cargo</th>
            <th>Teléfono</th>
            <th>Direccion</th>
            <th>Fecha_ingreso</th>
            <th>Estado</th>
            <th>Email</th>
            <th>Perfil</th>
            <th colspan="2" align="center">Acciones</th>
        </tr>
        <?php
        /*$query = "SELECT id, tipo_documento, documento, nombres, "
                . "apellidos,cargo, telefono, direccion,fecha_ingreso, "
                . "estado, email_contacto FROM consultor";*/
        $query = "SELECT a.id AS id_consultor, a.tipo_documento, a.documento, "
                . "a.nombres, a.apellidos, a.cargo, a.telefono, a.direccion, "
                . "a.fecha_ingreso, a.estado, a.email_contacto, b.id AS id_usuario, "
                . "b.email, b.password, b.codigo_rol, c.nombre_rol FROM consultor a, users b, "
                . "roles c WHERE email_contacto = b.email AND  b.codigo_rol = c.id";
        $records_per_page = 10;
        $newquery = $crud_consultor->paging($query, $records_per_page);
        $crud_consultor->dataview($newquery);
        ?>
        <tr>
            <td colspan="14" align="center">
                <div class="pagination-wrap">
                    <?php $crud_consultor->paginglink($query, $records_per_page); ?>
                </div>
            </td>
        </tr>

    </table>


</div>

<?php include_once 'footer.php'; ?>

