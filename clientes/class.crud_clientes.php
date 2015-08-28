<?php

class crud_clientes {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function create($nit, $razon_social, $objeto_social, $direccion, $nombre_contacto_1, $cargo_contacto_1, $email_contacto_1, $telefono_contacto_1, $nombre_contacto_2, $cargo_contacto_2, $email_contacto_2, $telefono_contacto_2, $estado) {
        try {
            $stmt = $this->db->prepare("INSERT INTO cliente(nit,
                                                            razon_social,
                                                            objeto_social,
                                                            direccion,
                                                            nombre_contacto_1,
                                                            cargo_contacto_1,
                                                            email_contacto_1,
                                                            telefono_contacto_1,
                                                            nombre_contacto_2,
                                                            cargo_contacto_2,
                                                            email_contacto_2,
                                                            telefono_contacto_2,
                                                            estado
                                      ) VALUES(             :nit,
                                                            :razon_social,
                                                            :objeto_social,
                                                            :direccion,
                                                            :nombre_contacto_1,
                                                            :cargo_contacto_1,
                                                            :email_contacto_1,
                                                            :telefono_contacto_1,
                                                            :nombre_contacto_2,
                                                            :cargo_contacto_2,
                                                            :email_contacto_2,
                                                            :telefono_contacto_2,
                                                            :estado
                                      )");



            $stmt->bindparam(":nit", $nit);
            $stmt->bindparam(":razon_social", $razon_social);
            $stmt->bindparam(":objeto_social", $objeto_social);
            $stmt->bindparam(":direccion", $direccion);

            $stmt->bindparam(":nombre_contacto_1", $nombre_contacto_1);
            $stmt->bindparam(":cargo_contacto_1", $cargo_contacto_1);
            $stmt->bindparam(":email_contacto_1", $email_contacto_1);
            $stmt->bindparam(":telefono_contacto_1", $telefono_contacto_1);

            $stmt->bindparam(":nombre_contacto_2", $nombre_contacto_2);
            $stmt->bindparam(":cargo_contacto_2", $cargo_contacto_2);
            $stmt->bindparam(":email_contacto_2", $email_contacto_2);
            $stmt->bindparam(":telefono_contacto_2", $telefono_contacto_2);

            $stmt->bindparam(":estado", $estado);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo ErrorMsg();
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id) {
        $stmt = $this->db->prepare("SELECT * FROM cliente WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function update($id, $nit, $razon_social, $objeto_social, $direccion, $nombre_contacto_1, $cargo_contacto_1, $email_contacto_1, $telefono_contacto_1, $nombre_contacto_2, $cargo_contacto_2, $email_contacto_2, $telefono_contacto_2, $estado) {
        try {
            $stmt = $this->db->prepare("UPDATE cliente SET nit=:nit,
                                                         razon_social=:razon_social,
                                                         objeto_social=:objeto_social,
                                                         direccion=:direccion,
                                                         nombre_contacto_1=:nombre_contacto_1,
                                                         cargo_contacto_1=:cargo_contacto_1,
                                                         email_contacto_1=:email_contacto_1,
                                                         telefono_contacto_1=:telefono_contacto_1,
                                                         nombre_contacto_2=:nombre_contacto_2,
                                                         cargo_contacto_2=:cargo_contacto_2,
                                                         email_contacto_2=:email_contacto_2,
                                                         telefono_contacto_2=:telefono_contacto_2,
                                                         estado=:estado
													WHERE id=:id ");
            $stmt->bindparam(":nit", $nit);
            $stmt->bindparam(":razon_social", $razon_social);
            $stmt->bindparam(":objeto_social", $objeto_social);
            $stmt->bindparam(":direccion", $direccion);
            $stmt->bindparam(":nombre_contacto_1", $nombre_contacto_1);
            $stmt->bindparam(":cargo_contacto_1", $cargo_contacto_1);
            $stmt->bindparam(":email_contacto_1", $email_contacto_1);
            $stmt->bindparam(":telefono_contacto_1", $telefono_contacto_1);
            $stmt->bindparam(":nombre_contacto_2", $nombre_contacto_2);
            $stmt->bindparam(":cargo_contacto_2", $cargo_contacto_2);
            $stmt->bindparam(":email_contacto_2", $email_contacto_2);
            $stmt->bindparam(":telefono_contacto_2", $telefono_contacto_2);
            $stmt->bindparam(":estado", $estado);
            $stmt->bindparam(":id", $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo ErrorMsg();
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM cliente WHERE id=:id");
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
                    <td><?php print($row['nit']); ?></td>
                    <td><?php print($row['razon_social']); ?></td>
                    <td><?php print($row['objeto_social']); ?></td>
                    <td><?php print($row['direccion']); ?></td>
                    <td><?php print($row['nombre_contacto_1']); ?></td>
                    <td><?php print($row['cargo_contacto_1']); ?></td>
                    <td><?php print($row['email_contacto_1']); ?></td>
                    <td><?php print($row['telefono_contacto_1']); ?></td>
                    <td><?php print($row['nombre_contacto_2']); ?></td>
                    <td><?php print($row['cargo_contacto_2']); ?></td>
                    <td><?php print($row['email_contacto_2']); ?></td>
                    <td><?php print($row['telefono_contacto_2']); ?></td>
                    <td><?php print($row['estado']); ?></td>
                    <td align="center">
                        <a href="edit-data_clientes.php?edit_id=<?php print($row['id']); ?>">
                            <i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="delete_clientes.php?delete_id=<?php print($row['id']); ?>">
                            <i class="glyphicon glyphicon-remove-circle"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>No hay Clientes creados...</td>
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
