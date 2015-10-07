<?php

include_once '../config/dbconfig.php';
//include_once 'header.php';
//header('Content-type: application/json; charset=utf-8');

echo json_encode($crud_consultorias_ejecutadas->getEjecucionesXConsultoria($_GET['consultoria_id']));
exit();

