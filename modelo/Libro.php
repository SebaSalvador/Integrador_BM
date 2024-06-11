<?php

class Libro {
    private $idLib;
    private $idEst;
    private $idCat;
    private $titulo;
    private $descripcion;
    private $autor;
    private $fecPub;

    public function getIdLib() {
        return $this->idLib;
    }

    public function setIdLib($idLib) {
        $this->idLib = $idLib;
    }

    public function getIdEst() {
        return $this->idEst;
    }

    public function setIdEst($idEst) {
        $this->idEst = $idEst;
    }

    public function getIdCat() {
        return $this->idCat;
    }

    public function setIdCat($idCat) {
        $this->idCat = $idCat;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getFecPub() {
        return $this->fecPub;
    }

    public function setFecPub($fecPub) {
        $this->fecPub = $fecPub;
    }
}
?>
