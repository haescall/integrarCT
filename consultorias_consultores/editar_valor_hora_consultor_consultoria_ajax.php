<?php

include_once '../config/dbconfig.php';
if ($crud_consultoria_consultores->editarValorHoraConsultorConsultoria(
                $_GET['id_consecutivo'], $_GET['valor_hora_consultoria'])) {
    echo "{\"exito\":\"true\"}";
} else {
    echo "{\"exito\":\"false\"}";
}
exit();

