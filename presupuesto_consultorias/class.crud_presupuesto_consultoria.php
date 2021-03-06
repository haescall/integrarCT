<?php

class crud_presupuesto_consultoria {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function create($codigoFase, $codigoConsultoria, $horasPresupuestadas) {
        try {
            $stmt = $this->db->prepare("INSERT INTO presupuesto_consultoria_fases(
                                                            codigo_fase,
                                                            codigo_consultoria,
                                                            numero_horas_presupuestadas
                                      ) VALUES(             :codigoFase,
                                                            :codigoConsultoria,
                                                            :horasPresupuestadas
                                      )");
            $stmt->bindparam(":codigoFase", $codigoFase);
            $stmt->bindparam(":codigoConsultoria", $codigoConsultoria);
            $stmt->bindparam(":horasPresupuestadas", $horasPresupuestadas);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
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

    public function getPresupuestoXConsultoria($idConsultoria) {
        try {
            $stmt = $this->db->prepare("SELECT a.id id_consecutivo, b.id id_fase, "
                    . "b.descripcion, a.numero_horas_presupuestadas "
                    . "FROM presupuesto_consultoria_fases a, fases b "
                    . "WHERE a.codigo_fase = b.id and a.codigo_consultoria = " . $idConsultoria);
            $stmt->execute();
            $lista = array();
            $i = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lista[$i] = $row;
                $i++;
            }
            return $lista;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deletePresupuestoEnConsultoria($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM presupuesto_consultoria_fases WHERE id=:id");
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getFasesDisponiblesPresupuestoXConsultoria($idConsultoria) {
        try {
            $stmt = $this->db->prepare("SELECT a.id, a.descripcion"
                    . " FROM fases a WHERE a.id NOT IN (SELECT b.codigo_fase "
                    . " FROM presupuesto_consultoria_fases b WHERE a.id = b.codigo_fase "
                    . " and b.codigo_consultoria = " . $idConsultoria . ")");
            $stmt->execute();
            $lista = array();
            $i = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lista[$i] = $row;
                $i++;
            }
            return $lista;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /* paging */

    public function dataview(
    $query) {
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
                        <a href="edit-data_consultoria.php?edit_id = <?php print($row['id']);
                ?>" title="Editar Registro"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="delete_consultoria.php?delete_id=<?php print($row['id']); ?>" title="Eliminar Registro"><i class="glyphicon glyphicon-remove-circle"></i></a>
                    </td>
                    <td align="center">
                        <a href="#" class="dlg_consultores_consultorias"
                           data-target="#consul" data-toggle="modal" 
                           data-id="<?php print($row['id']); ?>" 
                           data-nombre="<?php print($row['nombre']); ?>"  
                           title="Asignar Consultor">
                            <i class="glyphicon glyphicon-user"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>No hay Consultorías creadas...</td>
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

}
