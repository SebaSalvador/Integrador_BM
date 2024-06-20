<?php
require_once "dao/DAO_Sancion.php";
require_once "dao/DAO_Prestamo.php";
require_once "modelo/Sancion.php";
require_once "modelo/Prestamo.php";

class Control_AgregarSancion
{
#Calcular dias_san
function calcularDiasSan($idPre, $fec_ent) {
    $daoPre = new DAO_Prestamo();
    $prestamo = $daoPre->consultarPrestamo($idPre);
    $fec_dev = $prestamo->getFecDev();
    $fecha_devolucion = new DateTime($fec_dev);
    $fecha_entrega = new DateTime($fec_ent);

    if ($fecha_entrega > $fecha_devolucion) {
        $intervalo = $fecha_devolucion->diff($fecha_entrega);
        $diasSan = $intervalo->days;
    } else {
        $diasSan = 0;
    }

    return $diasSan;
}
#Calcular fec_fin de Sancion
function calcularFecFin($fec_ent, $diasSan) {
    $fecha = new DateTime($fec_ent);
    $fecha->modify("+$diasSan days");
    $fecFin = $fecha->format('Y-m-d');
    return $fecFin;
}

function agregarSancion($sancion, $idPre) {
    $daoSan = new DAO_Sancion();
    $diasSan = calcularDiasSan($idPre);
    $fecFin = calcularFecFin($diasSan);
    $sancion->setDiasSan($diasSan);
    $sancion->setFecFin($fecFin);
    $daoSan->agregarSancion($sancion);
}

function getSancionPorUsu($id) {
    $daoSan = new DAO_Sancion();
    $sanciones = $daoSan->consultarSancionPorUsu($id);
    return $sanciones;
    
}
} 


?>