<?php

class Estado {
    private $idEst;
    private $estado;
    private $descripcion;

    public function getIdEst() {
        return $this->idEst;
    }

    public function setIdEst($idEst) {
        $this->idEst = $idEst;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
}
?>
