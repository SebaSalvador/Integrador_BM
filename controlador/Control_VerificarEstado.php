<?php
require_once "../dao/DAO_Libro.php";

$idLib = $_GET['idLib'];
if (isset($idLib)) {
    $daoLib = new DAO_Libro();
    $idEst = $daoLib->consultarEstado($idLib);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($idEst);
} else {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'No se especifico ningun id de libro']);
}

?>