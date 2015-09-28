<?php

include_once '../config/dbconfig.php';

if ($crud_consultorias_ejecutadas->delete($_GET['id_consecutivo'])) {
    echo "{\"exito\":\"true\"}";
} else {
    echo "{\"exito\":\"false\"}";
}
exit();

