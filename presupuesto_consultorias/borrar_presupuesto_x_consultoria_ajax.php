<?php

include_once '../config/dbconfig.php';

if ($crud_presupuesto_consultoria->deletePresupuestoEnConsultoria($_GET['id_consecutivo'])) {
    echo "{\"exito\":\"true\"}";
} else {
    echo "{\"exito\":\"false\"}";
}
exit();

