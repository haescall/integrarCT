<?php

include_once '../config/dbconfig.php';

echo json_encode($crud_usuario->getPass($_GET['email']));
exit();

