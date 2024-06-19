<?php
require_once "util/conexion.php";
require_once "modelo/Sancion.php";

class DAO_Sancion
{
    var $cn;

    public function listarSanciones() {return $sanciones;}

    public function consultarSancion($id) {return $sancion;}

    public function consultarSancionPorUsu($usuario) {return $sanciones;}

    public function agregarSancion($sancion) {}

    public function eliminarSancion($id) {}
}
?>