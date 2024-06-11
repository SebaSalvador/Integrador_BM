<?php

class Categoria {
    private $idCat;
    private $nombre;

    public function getIdCat() {
        return $this->idCat;
    }

    public function setIdCat($idCat) {
        $this->idCat = $idCat;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
}
?>
