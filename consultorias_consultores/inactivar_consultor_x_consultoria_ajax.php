<?php

include_once '../config/dbconfig.php';
if ($crud_consultoria_consultores->inactivarConsultorEnConsultoria($_GET['id_consultor'])) {
    echo "{\"inactivo\":\"true\"}";
} else {
    echo "{\"inactivo\":\"false\"}";
}
exit();

