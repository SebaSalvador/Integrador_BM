<?php
require_once "util/conexion.php";
require_once "modelo/Observacion.php";

class DAO_Observacion
{
    var $cn;

    public function listarObservaciones() {return $observaciones;}

    public function consultarObservacion($id) {return $observacion;}

    public function consultarObservacionPorCon($condicion) {return $observaciones;}

    public function agregarObservacion($observacion) {}

    public function actualizarCondicion($id, $condicion) {}

}
?>