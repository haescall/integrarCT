<?php

class crud_gastos_consultoria
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	public function create($nro_factura, $fecha, $valor, $concepto, $proveedor, $codigo_consultoria)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO gastos_consultoria(  nro_factura,
                                                                              fecha,
                                                                              valor,
                                                                              concepto,
                                                                              proveedor,
                                                                              codigo_consultoria
                                      ) VALUES(           :nro_factura,
                                                          :fecha,
                                                          :valor,
                                                          :concepto,
                                                          :proveedor,
                                                          :codigo_consultoria
                                      )");

			$stmt->bindparam(":nro_factura",$nro_factura);
            $stmt->bindparam(":fecha",$fecha);
            $stmt->bindparam(":valor",$valor);
            $stmt->bindparam(":concepto",$concepto);
            $stmt->bindparam(":proveedor",$proveedor);
            $stmt->bindparam(":codigo_consultoria",$codigo_consultoria);


            $stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
		
	}
	
	public function getID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM gastos_consultoria WHERE id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id,$nro_factura, $fecha, $valor, $concepto, $proveedor, $codigo_consultoria)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE gastos_consultoria SET nro_factura = :nro_factura,
                                                       fecha = :fecha,
                                                       valor = :valor,
                                                       concepto = :concepto,
                                                       proveedor = :proveedor,
                                                       codigo_consultoria = :codigo_consultoria
													WHERE id=:id ");
            $stmt->bindparam(":nro_factura",$nro_factura);
            $stmt->bindparam(":fecha",$fecha);
            $stmt->bindparam(":valor",$valor);
            $stmt->bindparam(":concepto",$concepto);
            $stmt->bindparam(":proveedor",$proveedor);
            $stmt->bindparam(":codigo_consultoria",$codigo_consultoria);
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function delete($id)
	{
		$stmt = $this->db->prepare("DELETE FROM gastos_consultoria WHERE id=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}
	
	/* paging */
	
	public function dataview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['id']); ?></td>
                <td><?php print($row['nro_factura']); ?></td>
                <td><?php print($row['fecha']); ?></td>
                <td><?php print($row['valor']); ?></td>
                <td><?php print($row['concepto']); ?></td>
                <td><?php print($row['proveedor']); ?></td>
                <td><?php print($row['consultoria']); ?></td>
                <td align="center">
                <a href="edit-data_gastos_consultoria.php?edit_id=<?php print($row['id']); ?>" title="Editar Registro"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete_gastos_consultoria.php?delete_id=<?php print($row['id']); ?>" title="Eliminar Registro"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>No hay Gastos creados...</td>
            </tr>
            <?php
		}
		
	}
	
	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
	
	public function paginglink($query,$records_per_page)
	{
		
		$self = $_SERVER['PHP_SELF'];
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$total_no_of_records = $stmt->rowCount();
		
		if($total_no_of_records > 0)
		{
			?><ul class="pagination"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<li><a href='".$self."?page_no=1'>Primero</a></li>";
				echo "<li><a href='".$self."?page_no=".$previous."'>Anterior</a></li>";
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<li><a href='".$self."?page_no=".$next."'>Siguiente</a></li>";
				echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Último</a></li>";
			}
			?></ul><?php
		}
	}
	
	/* paging */
	
}

