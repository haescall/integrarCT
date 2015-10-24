<?php

class crud_consultoria {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function create($nombre, $descripcion, $fecha_inicio, $codigo_cliente, $valor_contrato, $entregables, $estado) {
        try {
            $stmt = $this->db->prepare("INSERT INTO consultoria(
                                                            nombre,
                                                            descripcion,
                                                            fecha_inicio,
                                                            codigo_cliente,
                                                            valor_contrato,
                                                            entregables,
                                                            estado,
                                                            created_at
                                      ) VALUES(             :nombre,
                                                            :descripcion,
                                                            :fecha_inicio,
                                                            :codigo_cliente,
                                                            :valor_contrato,
                                                            :entregables,
                                                            :estado,
                                                            CURDATE()
                                      )");

            $stmt->bindparam(":nombre", $nombre);
            $stmt->bindparam(":descripcion", $descripcion);
            $stmt->bindparam(":fecha_inicio", $fecha_inicio);
            $stmt->bindparam(":codigo_cliente", $codigo_cliente);
            $stmt->bindparam(":valor_contrato", $valor_contrato);
            $stmt->bindparam(":entregables", $entregables);
            $stmt->bindparam(":estado", $estado);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            //echo ErrorMsg();
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id) {
        $stmt = $this->db->prepare("SELECT * FROM consultoria WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function update($id, $nombre, $descripcion, $fecha_inicio, $codigo_cliente, $valor_contrato, $entregables, $estado) {
        try {
            $stmt = $this->db->prepare("UPDATE consultoria SET nombre = :nombre,
                                                           descripcion=:descripcion,
		                                                   fecha_inicio= :fecha_inicio,
													       codigo_cliente=:codigo_cliente,
													       valor_contrato=:valor_contrato,
													       entregables=:entregables,
													       estado=:estado,
													       updated_at=CURDATE()
													WHERE id=:id ");
            $stmt->bindparam(":nombre", $nombre);
            $stmt->bindparam(":descripcion", $descripcion);
            $stmt->bindparam(":fecha_inicio", $fecha_inicio);
            $stmt->bindparam(":codigo_cliente", $codigo_cliente);
            $stmt->bindparam(":valor_contrato", $valor_contrato);
            $stmt->bindparam(":entregables", $entregables);
            $stmt->bindparam(":estado", $estado);
            $stmt->bindparam(":id", $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM consultoria WHERE id=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return true;
    }

    /* paging */

    public function dataview($query) {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $i = 0;

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $i++;
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['nombre']); ?></td>
                    <td><?php print($row['descripcion']); ?></td>
                    <td><?php print($row['fecha_inicio']); ?></td>
                    <td><?php print($row['razon_social']); ?></td>
                    <td><?php print($row['valor_contrato']); ?></td>
                    <td><?php print($row['entregables']); ?></td>
                    <td><?php print($row['estado']); ?></td>
                    <td><?php print($row['created_at']); ?></td>
                    <td><?php print($row['updated_at']); ?></td>
                    <td align="center">
                        <a href="edit-data_consultoria.php?edit_id=<?php print($row['id']); ?>" 
                           title="Editar Registro"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="delete_consultoria.php?delete_id=<?php print($row['id']); ?>" 
                           title="Eliminar Registro"><i class="glyphicon glyphicon-remove-circle"></i></a>
                    </td>
                    <td align="center">
                        <a href="#" class="dlg_consultores_consultorias"
                           data-proceso="1" id="asig_consultores<?php print(+$i); ?>"
                           data-target="#consul" data-toggle="modal" 
                           data-id-consultoria="<?php print($row['id']); ?>"  
                           data-nombre="<?php print($row['nombre']); ?>" 
                           title="Asignar Consultores">
                            <i class="glyphicon glyphicon-user"></i></a>
                    </td>
                    <td align="center">
                        <a href="#" class="dlg_presupuesto_consultorias"
                           data-proceso="2" id="asig_presu<?php print(+$i); ?>"
                           data-target="#dlg-presu" data-toggle="modal" 
                           data-id-consultoria="<?php print($row['id']); ?>"  
                           data-nombre="<?php print($row['nombre']); ?>" 
                           title="Asignar Presupuesto">
                            <i class="glyphicon glyphicon-usd"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="14" align="center">No hay Consultorías creadas...</td>
            </tr>
            <?php
        }
    }

    public function paging($query, $records_per_page) {
        $starting_position = 0;
        if (isset($_GET["page_no"])) {
            $starting_position = ($_GET["page_no"] - 1) * $records_per_page;
        }
        $query2 = $query . " limit $starting_position,$records_per_page";
        return $query2;
    }

    public function paginglink($query, $records_per_page) {

        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $total_no_of_records = $stmt->rowCount();

        if ($total_no_of_records > 0) {
            ?><ul class="pagination"><?php
                $total_no_of_pages = ceil($total_no_of_records / $records_per_page);
                $current_page = 1;
                if (isset($_GET["page_no"])) {
                    $current_page = $_GET["page_no"];
                }
                if ($current_page != 1) {
                    $previous = $current_page - 1;
                    echo "<li><a href='" . $self . "?page_no=1'>Primero</a></li>";
                    echo "<li><a href='" . $self . "?page_no=" . $previous . "'>Anterior</a></li>";
                }
                for ($i = 1; $i <= $total_no_of_pages; $i++) {
                    if ($i == $current_page) {
                        echo "<li><a href='" . $self . "?page_no=" . $i . "' style='color:red;'>" . $i . "</a></li>";
                    } else {
                        echo "<li><a href='" . $self . "?page_no=" . $i . "'>" . $i . "</a></li>";
                    }
                }
                if ($current_page != $total_no_of_pages) {
                    $next = $current_page + 1;
                    echo "<li><a href='" . $self . "?page_no=" . $next . "'>Siguiente</a></li>";
                    echo "<li><a href='" . $self . "?page_no=" . $total_no_of_pages . "'>Último</a></li>";
                }
                ?></ul><?php
        }
    }

    /* paging */

    /*  public function getInfoComboBox($tabla, $colum_codigo, $colum_nombre){
      $this->conectar();
      $sql = "SELECT id, razon_social FROM ".$tabla;
      $resp = $this->conn->consultar($sql);
      $info = array();
      $i = 0;
      while($datos = @mysql_fetch_array($resp)){
      $info[$i] = $datos[$colum_codigo];
      $i++;
      $info[$i] = $datos[$colum_nombre];
      $i++;
      }
      $this->desconectar();
      return $info;
      } */
}
