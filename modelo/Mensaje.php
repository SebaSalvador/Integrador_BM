<?php

class Mensaje {
    private $idMen;
    private $idPer;
    private $asunto;
    private $detalle;
    private $fecEnv;
    private $horEnv;
    private $estado;

    public function getIdMen() {
        return $this->idMen;
    }

    public function setIdMen($idMen) {
        $this->idMen = $idMen;
    }

    public function getIdPer() {
        return $this->idPer;
    }

    public function setIdPer($idPer) {
        $this->idPer = $idPer;
    }

    public function getAsunto() {
        return $this->asunto;
    }

    public function setAsunto($asunto) {
        $this->asunto = $asunto;
    }

    public function getDetalle() {
        return $this->detalle;
    }

    public function setDetalle($detalle) {
        $this->detalle = $detalle;
    }

    public function getFecEnv() {
        return $this->fecEnv;
    }

    public function setFecEnv($fecEnv) {
        $this->fecEnv = $fecEnv;
    }

    public function getHorEnv() {
        return $this->horEnv;
    }

    public function setHorEnv($horEnv) {
        $this->horEnv = $horEnv;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
}
?>
