<?php

include_once '../config/dbconfig.php';
//include_once 'header.php';
//header('Content-type: application/json; charset=utf-8');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* $stmt = $DB_con->prepare("SELECT id, concat(nombres, ' ',apellidos) "
  . "nombres, cargo FROM consultor "); 
$stmt = $DB_con->prepare("SELECT b.id, concat(b.nombres, ' ',b.apellidos) nombres, "
        . "b.cargo, a.id, valida_consultoria_ejecutada(b.id) ejecuto FROM consultoria_consultor a, consultor b "
        . "WHERE a.codigo_consultor = b.id and a.codigo_consultoria = " . $_GET['consultoria_id']);
$stmt->execute();
$lista = array();
$i = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $lista[$i] = $row;
    $i++;
}*/

//echo 'El id es : ' . $_GET['id_consultoria'];
//echo $lista;
echo json_encode($crud_consultoria_consultores->getConsultoresXConsultoria($_GET['consultoria_id']));
exit();

