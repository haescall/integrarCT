<?php

include_once '../config/dbconfig.php';
if ($crud_consultoria_consultores->create($_GET['id_consultor'], $_GET['id_consultoria'], $_GET['valor_hora'])) {
    echo "{\"exito\":\"true\"}";
} else {
    echo "{\"exito\":\"false\"}";
}
exit();

