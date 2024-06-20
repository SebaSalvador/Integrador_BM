<?php

class Observacion {
    private $idObs;
    private $idLib;
    private $descripcion;
    private $fechaObservacion;
    private $condicion;

    public function getIdObs() {
        return $this->idObs;
    }

    public function setIdObs($idObs) {
        $this->idObs = $idObs;
    }

    public function getIdLib() {
        return $this->idLib;
    }

    public function setIdLib($idLib) {
        $this->idLib = $idLib;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getFecObservacion() {
        return $this->fechaObservacion;
    }

    public function setFecObservacion($fechaObservacion) {
        $this->fechaObservacion = $fechaObservacion;
    }

    public function getCondicion() {
        return $this->condicion;
    }

    public function setCondicion($condicion) {
        $this->condicion = $condicion;
    }
}
?>
