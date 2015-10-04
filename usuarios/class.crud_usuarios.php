<?php

class crud_usuarios {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function create($email, $password, $codigo_rol) {
        try {
            $stmt = $this->db->prepare("INSERT INTO users(email,
                                                          password,
                                                          created_at,
                                                          codigo_rol
                                      ) VALUES(           :email,
                                                          :password,
                                                          CURDATE(),
                                                          :codigo_rol
                                      )");
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":password", $password);
            $stmt->bindparam(":codigo_rol", $codigo_rol);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {            
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function validarUsuario($email, $password) {
        try {
            //$stmt = $this->db->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
            $stmt = $this->db->prepare("SELECT a.id, a.password, a.codigo_rol," . 
                    " b.id codigo_consultor, a.email FROM users a, consultor b WHERE " . 
                    " a.email=b.email_contacto AND a.email=:email AND a.password=:password");
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":password", $password);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            /*if ($row["email"] != "") {
                return true;
            } else {
                return false;
            }*/
            return $row;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function update($id, $name, $email, $password, $rememberToken) {
        try {
            $stmt = $this->db->prepare("UPDATE users SET name=:name,
                                                         email=:email,
                                                         password=:password,
                                                         remember_token=:rememberToken,
                                                         updated_at=CURDATE()
                        		WHERE id=:id ");
            $stmt->bindparam(":name", $name);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":password", $password);
            $stmt->bindparam(":rememberToken", $rememberToken);
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
        $stmt = $this->db->prepare("DELETE FROM users WHERE id=:id");
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
                    <td><?php print($row['name']); ?></td>
                    <td><?php print($row['email']); ?></td>
                    <td><?php print($row['remember_token']); ?></td>
                    <td><?php print($row['created_at']); ?></td>
                    <td><?php print($row['updated_at']); ?></td>
                    <td align="center">
                        <a href="edit-data_usuarios.php?edit_id=<?php print($row['id']); ?>">
                            <i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="delete_usuarios.php?delete_id=<?php print($row['id']); ?>">
                            <i class="glyphicon glyphicon-remove-circle"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>No hay Usuarios creados...</td>
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
    