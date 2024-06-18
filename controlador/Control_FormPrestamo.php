<?php

require_once "dao/DAO_Prestamo.php";
require_once "modelo/Prestamo.php";

class Control_FormPrestamo {
    
    // Método para registrar un préstamo
    public function registrarPrestamo($id_persona, $id_libro, $fecha_prestamo, $hora_prestamo, $fecha_devolucion, $hora_devolucion, $estado) {
        $dao = new DAO_Prestamo();
        $prestamo = new Prestamo();
        $prestamo->setIdPer($id_persona);
        $prestamo->setIdLib($id_libro);
        $prestamo->setFecPre($fecha_prestamo);
        $prestamo->setHorPre($hora_prestamo);
        $prestamo->setFecDev($fecha_devolucion);
        $prestamo->setHorDev($hora_devolucion);
        $prestamo->setEstado($estado);

        $res = $dao->agregarPrestamo($prestamo);
        return $res;
    }
}

?>
