<?php

class Usuario {
    private $idPer;
    //tb_usuario
    private $idTipo;
    private $pass;
    private $estado;
    //tb_persona
    private $nomApe;
    private $edad;
    private $correo;
    private $direccion;
    private $telefono;

    public function getIdPer() {
        return $this->idPer;
    }

    public function setIdPer($idPer) {
        $this->idPer = $idPer;
    }

    public function getIdTipo() {
        return $this->idTipo;
    }

    public function setIdTipo($idTipo) {
        $this->idTipo = $idTipo;
    }

    public function getPass() {
        return $this->pass;
    }

    public function setPass($pass) {
        $this->pass = $pass;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getNomApe() {
        return $this->nomApe;
    }

    public function setNomApe($nomApe) {
        $this->nomApe = $nomApe;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
}
?>
