<?php
require_once "../dao/DAO_Prestamo.php";
require_once "../modelo/Prestamo.php";
$idPer = $_GET['idPer'];
if (isset($idPer)) {
    $daoPre = new DAO_Prestamo();
    $estado = $daoPre->verificarPosibilidadPrestamo($idPer);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($estado);
} else {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'No se especifico ningun id de persona']);
}

?>