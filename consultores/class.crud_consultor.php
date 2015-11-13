<?php

class crud_consultor {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function create($tipo_documento, $documento, $nombres, $apellidos, $cargo, $telefono, $direccion, $fecha_ingreso, $estado, $email_contacto) {
        try {
            $stmt = $this->db->prepare("INSERT INTO consultor(
                                                            tipo_documento,
                                                            documento,
                                                            nombres,
                                                            apellidos,
                                                            cargo,
                                                            telefono,
                                                            direccion,
                                                            fecha_ingreso,
                                                            estado,
                                                            email_contacto
                                      ) VALUES(             :tipo_documento,
                                                            :documento,
                                                            :nombres,
                                                            :apellidos,
                                                            :cargo,
                                                            :telefono,
                                                            :direccion,
                                                            :fecha_ingreso,
                                                            :estado,
                                                            :email_contacto
                                      )");

            $stmt->bindparam(":tipo_documento", $tipo_documento);
            $stmt->bindparam(":documento", $documento);
            $stmt->bindparam(":nombres", $nombres);
            $stmt->bindparam(":apellidos", $apellidos);
            $stmt->bindparam(":cargo", $cargo);
            $stmt->bindparam(":telefono", $telefono);
            $stmt->bindparam(":direccion", $direccion);
            $stmt->bindparam(":fecha_ingreso", $fecha_ingreso);
            $stmt->bindparam(":estado", $estado);
            $stmt->bindparam(":email_contacto", $email_contacto);


            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function infoDetalladaConsultor($fechaIni, $fechaFin, $consultorID) {
        try {
            $stmt = $this->db->prepare("SELECT a.id as id_consultor, concat(a.nombres,  '  ',  a.apellidos) "
                    . "consultor, c.id as cod_cliente, b.fecha, d.id as id_consultoria, "
                    . "c.razon_social cliente, d.descripcion, b.horas_laboradas, "
                    . "e.id as id_fase, e.descripcion as nombre_fase, b.valor, "
                    . "b.actividades, total_horas_consultor(a.id, STR_TO_DATE('" . $fechaIni . "','%Y-%m-%d'), "
                    . "STR_TO_DATE('" . $fechaFin . "','%Y-%m-%d')) total_horas, "
                    . "total_valor_consultor(a.id, STR_TO_DATE('$fechaIni','%Y-%m-%d'), "
                    . "STR_TO_DATE('$fechaFin','%Y-%m-%d')) total_valor  "
                    . "from consultor a, consultorias_ejecutadas b, cliente c, "
                    . "consultoria d, fases e where a.id = b.codigo_consultor "
                    . "and c.id = d.codigo_cliente and b.codigo_consultoria = d.id "
                    . "and b.codigo_fase = e.id "
                    . "and DATE_FORMAT(b.fecha ,'%Y-%m-%d') between STR_TO_DATE('" . $fechaIni . "','%Y-%m-%d') "
                    . "and STR_TO_DATE('" . $fechaFin . "','%Y-%m-%d') order by a.id, b.fecha");
            $stmt->execute();
            $lista = array();
            $i = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lista[$i] = $row;
                $i++;
                //echo $i;
            }
            return $lista;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getID($id) {
        $stmt = $this->db->prepare("SELECT * FROM consultor WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function update($id, $tipo_documento, $documento, $nombres, $apellidos, $cargo, $telefono, $direccion, $fecha_ingreso, $estado, $email_contacto) {
        try {
            $stmt = $this->db->prepare("UPDATE consultor SET tipo_documento=:tipo_documento,
		                                                   documento= :documento,
													       nombres=:nombres,
													       apellidos=:apellidos,
													       cargo=:cargo,
													       telefono=:telefono,
													       direccion=:direccion,
													       fecha_ingreso=:fecha_ingreso,
													       estado=:estado,
													       email_contacto=:email_contacto
													WHERE id=:id ");
            $stmt->bindparam(":tipo_documento", $tipo_documento);
            $stmt->bindparam(":documento", $documento);
            $stmt->bindparam(":nombres", $nombres);
            $stmt->bindparam(":apellidos", $apellidos);
            $stmt->bindparam(":cargo", $cargo);
            $stmt->bindparam(":telefono", $telefono);
            $stmt->bindparam(":direccion", $direccion);
            $stmt->bindparam(":fecha_ingreso", $fecha_ingreso);
            $stmt->bindparam(":estado", $estado);
            $stmt->bindparam(":email_contacto", $email_contacto);
            $stmt->bindparam(":id", $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM consultor WHERE id=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return true;
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
                    <td><?php print($row['tipo_documento']); ?></td>
                    <td><?php print($row['documento']); ?></td>
                    <td><?php print($row['nombres']); ?></td>
                    <td><?php print($row['apellidos']); ?></td>
                    <td><?php print($row['cargo']); ?></td>
                    <td><?php print($row['telefono']); ?></td>
                    <td><?php print($row['direccion']); ?></td>
                    <td><?php print($row['fecha_ingreso']); ?></td>
                    <td><?php print($row['estado']); ?></td>
                    <td><?php print($row['email_contacto']); ?></td>
                    <td align="center">
                        <a href="edit-data_consultor.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="delete_consultor.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="13" align="center">No hay Consultores creados...</td>
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
