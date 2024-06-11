<?php

class Sancion {
    private $idSan;
    private $idPer;
    private $diasSan;
    private $fecIni;
    private $razon;

    public function getIdSan() {
        return $this->idSan;
    }

    public function setIdSan($idSan) {
        $this->idSan = $idSan;
    }

    public function getIdPer() {
        return $this->idPer;
    }

    public function setIdPer($idPer) {
        $this->idPer = $idPer;
    }

    public function getDiasSan() {
        return $this->diasSan;
    }

    public function setDiasSan($diasSan) {
        $this->diasSan = $diasSan;
    }

    public function getFecIni() {
        return $this->fecIni;
    }

    public function setFecIni($fecIni) {
        $this->fecIni = $fecIni;
    }

    public function getRazon() {
        return $this->razon;
    }

    public function setRazon($razon) {
        $this->razon = $razon;
    }
}
?>
