<?php
include_once '../config/dbconfig.php';
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="add-data_fases.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Crear Fases</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr class="success">
     <th>#</th>
     <th>Descripción</th>
     <th>Fecha Creación</th>
     <th>Última Modificación</th>
     <th colspan="2" align="center">Acciones</th>
     </tr>
     <?php
		$query = "SELECT id, descripcion, created_at, updated_at FROM fases";
		$records_per_page=10;
		$newquery = $crud_fases->paging($query,$records_per_page);
        $crud_fases->dataview($newquery);
	 ?>
    <tr>
        <td colspan="7" align="center">
 			<div class="pagination-wrap">
            <?php $crud_fases->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once 'footer.php'; ?>

