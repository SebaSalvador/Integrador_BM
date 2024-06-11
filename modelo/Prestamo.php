<?php

class Prestamo {
    private $idPre;
    private $idPer;
    private $idLib;
    private $fecPre;
    private $horPre;
    private $fecDev;
    private $horDev;

    public function getIdPre() {
        return $this->idPre;
    }

    public function setIdPre($idPre) {
        $this->idPre = $idPre;
    }

    public function getIdPer() {
        return $this->idPer;
    }

    public function setIdPer($idPer) {
        $this->idPer = $idPer;
    }

    public function getIdLib() {
        return $this->idLib;
    }

    public function setIdLib($idLib) {
        $this->idLib = $idLib;
    }

    public function getFecPre() {
        return $this->fecPre;
    }

    public function setFecPre($fecPre) {
        $this->fecPre = $fecPre;
    }

    public function getHorPre() {
        return $this->horPre;
    }

    public function setHorPre($horPre) {
        $this->horPre = $horPre;
    }

    public function getFecDev() {
        return $this->fecDev;
    }

    public function setFecDev($fecDev) {
        $this->fecDev = $fecDev;
    }

    public function getHorDev() {
        return $this->horDev;
    }

    public function setHorDev($horDev) {
        $this->horDev = $horDev;
    }
}
?>
