<?php

include_once '../config/dbconfig.php';
if ($crud_presupuesto_consultoria->create($_GET['id_fase'], $_GET['id_consultoria'], $_GET['horas_presupuestadas'])) {
    echo "{\"exito\":\"true\"}";
} else {
    echo "{\"exito\":\"false\"}";
}
exit();

