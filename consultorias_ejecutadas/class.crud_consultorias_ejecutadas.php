<?php

class crud_consultorias_ejecutadas {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function create($codigo_fase, $codigo_consultoria, $codigo_consultor, $fecha, $horas_laboradas, $valor, $actividades) {
        try {
            $stmt = $this->db->prepare("INSERT INTO consultorias_ejecutadas(  codigo_fase,
                                                                                        codigo_consultoria,
                                                                                        codigo_consultor,
                                                                                        fecha,
                                                                                        horas_laboradas,
                                                                                        valor,
                                                                                        actividades,
                                                                                        created_at
                                      ) VALUES(         :codigo_fase,
                                                        :codigo_consultoria,
                                                        :codigo_consultor,
                                                        :fecha,
                                                        :horas_laboradas,
                                                        :valor,
                                                        :actividades,
                                                        CURDATE()
                                      )");

            $stmt->bindparam(":codigo_fase", $codigo_fase);
            $stmt->bindparam(":codigo_consultoria", $codigo_consultoria);
            $stmt->bindparam(":codigo_consultor", $codigo_consultor);
            $stmt->bindparam(":fecha", $fecha);
            $stmt->bindparam(":horas_laboradas", $horas_laboradas);
            $stmt->bindparam(":valor", $valor);
            $stmt->bindparam(":actividades", $actividades);


            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id) {
        $stmt = $this->db->prepare("SELECT * FROM consultorias_ejecutadas WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function getEjecucionesXConsultoria($idConsultoria) {
        try {
            /* $stmt = $this->db->prepare("SELECT * FROM consultorias_ejecutadas "
              . "WHERE codigo_consultoria = " . $idConsultoria); */
            $stmt = $this->db->prepare("SELECT ce.id, ce.fecha, f.descripcion "
                    . "fase, ce.horas_laboradas, ce.valor, ce.actividades, valida_mod_eli_ejec(ce.id) estado  " .
                    " FROM consultorias_ejecutadas ce, fases f " .
                    " where ce.codigo_fase = f.id and ce.codigo_consultoria = "
                    . $idConsultoria . " order by ce.fecha;");
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

    public function update($id, $codigo_consultoria, $codigo_fase, $fecha, $horas_laboradas, $valor, $actividades) {
        try {
            $stmt = $this->db->prepare("UPDATE consultorias_ejecutadas SET 
                codigo_consultoria = :codigo_consultoria, 
                codigo_fase = :codigo_fase,
                fecha =:fecha,
                horas_laboradas =:horas_laboradas,
                valor = :valor,
                actividades = :actividades,
                updated_at = CURDATE()
                WHERE id=:id ");
            $stmt->bindparam(":codigo_consultoria", $codigo_consultoria);
            $stmt->bindparam(":codigo_fase", $codigo_fase);
            $stmt->bindparam(":fecha", $fecha);
            $stmt->bindparam(":horas_laboradas", $horas_laboradas);
            $stmt->bindparam(":valor", $valor);
            $stmt->bindparam(":actividades", $actividades);
            $stmt->bindparam(":id", $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM consultorias_ejecutadas WHERE id=:id");
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /* paging */

    public function dataview($query) {
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['fecha']); ?></td>
                    <td><?php print($row['fase']); ?></td>
                    <td><?php print($row['horas_laboradas']); ?></td>
                    <td><?php print($row['valor']); ?></td>
                    <td><?php print($row['actividades']); ?></td>
                    <td align="center">
                        <a href="edit-data_consultorias_ejecutadas.php?edit_id=<?php print($row['id']); ?>" title="Editar Registro"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="delete_consultorias_ejecutadas.php?delete_id=<?php print($row['id']); ?>" title="Eliminar Registro"><i class="glyphicon glyphicon-remove-circle"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>No hay Registros creados...</td>
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
}
