<?php

include_once '../config/dbconfig.php';

if ($crud_consultoria_consultores->deleteConsultorEnConsultoria($_GET['id_consecutivo'])) {
    echo "{\"exito\":\"true\"}";
} else {
    echo "{\"exito\":\"false\"}";
}
exit();

