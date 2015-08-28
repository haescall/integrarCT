<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//print("La consultoria es " . $_COOKIE["id_consultoria"]);
//$stmt = $DB_con->prepare("SELECT id, concat(nombres, ' ',apellidos) "
//       . "nombres, cargo FROM consultor ");
$stmt = $DB_con->prepare("SELECT b.id, concat(b.nombres, ' ',b.apellidos) nombres, "
        . "b.cargo, a.id FROM consultorias_ejecutadas a, consultor b "
        . "WHERE a.codigo_consultor = b.id and a.codigo_consultoria = 1");
//.  $_COOKIE["id_consultoria"]);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
    ?>
    <tr>
        <td><?php print($row['id']); ?></td>
        <td><?php print($row['nombres']); ?></td>
        <td><?php print($row['cargo']); ?></td>
    </tr>
<?php } ?>