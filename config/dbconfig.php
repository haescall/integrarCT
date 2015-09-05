<?php

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "integrarct";


try {
    $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}", $DB_user, $DB_pass);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

include_once '../clientes/class.crud_clientes.php';
include_once '../fases/class.crud_fases.php';
include_once '../consultores/class.crud_consultor.php';
include_once '../consultorias/class.crud_consultoria.php';
include_once '../consultorias_consultores/class.crud_consultoria_consultores.php';
include_once '../presupuesto_consultorias/class.crud_presupuesto_consultoria.php';
include_once '../consultorias_ejecutadas/class.crud_consultorias_ejecutadas.php';


$crud_clientes = new crud_clientes($DB_con);
$crud_fases = new crud_fases($DB_con);
$crud_consultor = new crud_consultor($DB_con);
$crud_consultoria = new crud_consultoria($DB_con);
$crud_consultoria_consultores = new crud_consultoria_consultores($DB_con);
$crud_consultorias_ejecutadas = new crud_consultorias_ejecutadas($DB_con);
$crud_presupuesto_consultoria = new crud_presupuesto_consultoria($DB_con);
