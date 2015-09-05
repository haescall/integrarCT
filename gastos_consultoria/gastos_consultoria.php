<?php
include_once '../config/dbconfig.php';
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="add-data_gastos_consultoria.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Crear Gasto</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr class="success">
     <th>#</th>
     <th>Nro Factura</th>
     <th>Fecha</th>
     <th>Valor</th>
     <th>Concepto</th>
     <th>Proveedor</th>
     <th>Consultoria</th>
     <th colspan="2" align="center">Acciones</th>
     </tr>
     <?php
		$query = " SELECT f.id, f.nro_factura, f.fecha, f.valor, f.concepto, f.proveedor, c.nombre consultoria ".
                 " FROM gastos_consultoria f, consultoria c ".
                 " where f.codigo_consultoria = c.id ; ";
		$records_per_page=10;
		$newquery = $crud_gastos_consultoria->paging($query,$records_per_page);
        $crud_gastos_consultoria->dataview($newquery);
	 ?>
    <tr>
        <td colspan="9" align="center">
 			<div class="pagination-wrap">
            <?php $crud_gastos_consultoria->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once 'footer.php'; ?>

