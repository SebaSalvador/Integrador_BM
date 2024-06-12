<?php
include "../util/conexion.php";
require "../modelo/Libro.php";

class DAO_Libro 
{

    public function listarLibros() {
        $c = conecta();
        $libros = array();
        #$idLib; $idEst; $idCat; $titulo; $descripcion; $autor; $fecPub;
        $sql = "select * from tb_libro";
        if ($result = $c->query($sql)) {
            while ($row = $result->fetch_array()) {
                $libro = new Libro();
                $libro->setIdLib($row[0]);
                $libro->setIdEst($row[1]);
                $libro->setIdCat($row[2]);
                $libro->setTitulo($row[3]);
                $libro->setDescripcion($row[4]);
                $libro->setAutor($row[5]);
                $libro->setFecPub($row[6]);
                array_push($libros, $libro);
            }
        }
        return $libros;
    }

    public function consultarLibro($id) {}

    public function consultarLibroPorEst($estado) {return $libros;}

    public function consultarLibroPorCat($categoria) {return $libros;}
    
    public function consultarLibroPorAut($autor) {return $libros;}

    public function agregarLibro($libro) {}

    public function modificarLibro($libro) {}

    public function eliminarLibro($id) {}

    public function actualizarEstado($id, $estado) {}
}
?>