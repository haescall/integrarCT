<?php
include_once '../config/dbconfig.php';
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="add-data_facturacion_consultoria.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Crear Facturación</a>
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
     <th>Consultoria</th>
     <th colspan="2" align="center">Acciones</th>
     </tr>
     <?php
		$query = " SELECT f.id, f.nro_factura, f.fecha, f.valor, f.concepto, c.nombre consultoria ".
                 " FROM facturacion_consultoria f, consultoria c ".
                 " where f.codigo_consultoria = c.id ; ";
		$records_per_page=10;
		$newquery = $crud_facturacion_consultoria->paging($query,$records_per_page);
        $crud_facturacion_consultoria->dataview($newquery);
	 ?>
    <tr>
        <td colspan="8" align="center">
 			<div class="pagination-wrap">
            <?php $crud_facturacion_consultoria->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once 'footer.php'; ?>

