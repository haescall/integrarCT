<?php
include_once '../config/dbconfig.php';
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="add-data_clientes.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Crear Clientes</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr class="success">
     <th>#</th>
     <th>NIT</th>
     <th>Razón Social</th>
     <th>Objeto Social</th>
     <th>Dirección</th>
     <th>Nombre Contacto1</th>
     <th>Cargo Contacto1</th>
     <th>Email Contacto1</th>
     <th>Teléfono Contacto1</th>
     <th>Nombre Contacto2</th>
     <th>Cargo Contacto2</th>
     <th>Email Contacto2</th>
     <th>Teléfono Contacto2</th>
     <th>Estado</th>
     <th colspan="2" align="center">Acciones</th>
     </tr>
     <?php
		$query = " SELECT id, nit, razon_social, objeto_social, direccion, ".
                 " nombre_contacto_1, cargo_contacto_1, email_contacto_1, telefono_contacto_1, ".
                 " nombre_contacto_2, cargo_contacto_2, email_contacto_2, telefono_contacto_2, estado ".
                 " FROM cliente ";
		$records_per_page=18;
		$newquery = $crud_clientes->paging($query,$records_per_page);
		$crud_clientes->dataview($newquery);
	 ?>
    <tr>
        <td colspan="18" align="center">
 			<div class="pagination-wrap">
            <?php $crud_clientes->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once 'footer.php'; ?>

