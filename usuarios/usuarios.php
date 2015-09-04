<?php
include_once '../config/dbconfig.php';
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
    <a href="add-data_usuarios.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Crear Usuarios</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
    <table class='table table-bordered table-responsive'>
        <tr class="success">
            <th>#</th>
            <th>Nombre</th>
            <th>E-Mail</th>
            <th>Password</th>
            <th colspan="2" align="center">Acciones</th>
        </tr>
        <?php
        $query = " SELECT * FROM users ";
        $records_per_page = 18;
        $newquery = $crud_clientes->paging($query, $records_per_page);
        $crud_clientes->dataview($newquery);
        ?>
        <tr>
            <td colspan="18" align="center">
                <div class="pagination-wrap">
                    <?php $crud_usuarios->paginglink($query, $records_per_page); ?>
                </div>
            </td>
        </tr>

    </table>


</div>

<?php include_once 'footer.php'; ?>

