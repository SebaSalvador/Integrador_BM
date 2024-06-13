<?php
require_once "util/conexion.php";
require_once "modelo/Libro.php";

class DAO_Libro 
{
    var $cn;
    
    public function listarLibros() {
        $cn = new conexion();
        $c = $cn->conecta();
        $libros = array();
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
                $libros[] = $libro;
            }
        }
        $cn->desconecta();
        return $libros;
    }

    public function consultarLibro($id) {
        $cn = new conexion();
        $c = $cn->conecta();
        $libro = new Libro();
        $sql = "select * from tb_libro where id_lib = ?";
        $stm = $c->prepare($sql);
        $result = $stm->execute(array($id));
        if ($row = $result->fetch_array()) {
            $libro->setIdLib($row[0]);
            $libro->setIdEst($row[1]);
            $libro->setIdCat($row[2]);
            $libro->setTitulo($row[3]);
            $libro->setDescripcion($row[4]);
            $libro->setAutor($row[5]);
            $libro->setFecPub($row[6]);
        }
        $cn->desconecta();
        return $libro;
        
    }

    public function consultarLibroPorEst($estado) {
        $cn = new conexion();
        $c = $cn->conecta();
        $libros = array();
        $sql = "select * from tb_libro where estado=?";
        $stm = $c->prepare($sql);
        if ($result = $stm->execute(array($estado))) {
            while ($row = $result->fetch_array()) {
                $libro = new Libro();
                $libro->setIdLib($row[0]);
                $libro->setIdEst($row[1]);
                $libro->setIdCat($row[2]);
                $libro->setTitulo($row[3]);
                $libro->setDescripcion($row[4]);
                $libro->setAutor($row[5]);
                $libro->setFecPub($row[6]);
                $libros[] = $libro;
            }
        }
        $cn->desconecta();   
        return $libros;
    }

    public function consultarLibroPorCat($id_cat) {
        $cn = new conexion();
        $c = $cn->conecta();
        $libros = array();
        #$sql = "select * from tb_libro as tb inner join tb_categoria as tc on tb.id_cat = tc.id_cat where tc.categoria = ?";
        $sql = "select * from tb_libro where id_cat = ?"
        $stm = $c->prepare($sql);
        if ($result = $stm->execute(array($id_cat))) {
            while ($row = $result->fetch_array()) {
                $libro = new Libro();
                $libro->setIdLib($row[0]);
                $libro->setIdEst($row[1]);
                $libro->setIdCat($row[2]);
                $libro->setTitulo($row[3]);
                $libro->setDescripcion($row[4]);
                $libro->setAutor($row[5]);
                $libro->setFecPub($row[6]);
                $libros[] = $libro;
            }
        }
        $cn->desconecta(); 
        return $libros;
    }
    
    public function consultarLibroPorAut($autor) {
        $cn = new conexion();
        $c = $cn->conecta();
        $libros = array();
        $sql = "select * from tb_libro where autor = ?"
        $stm = $c->prepare($sql);
        if ($result = $stm->execute(array($autor))) {
            while ($row = $result->fetch_array()) {
                $libro = new Libro();
                $libro->setIdLib($row[0]);
                $libro->setIdEst($row[1]);
                $libro->setIdCat($row[2]);
                $libro->setTitulo($row[3]);
                $libro->setDescripcion($row[4]);
                $libro->setAutor($row[5]);
                $libro->setFecPub($row[6]);
                $libros[] = $libro;
            }
        }
        $cn->desconecta(); 
        return $libros;
    }

    public function agregarLibro($libro) {
        $cn = new conexion();
        $c = $cn->conecta();
        $libros = array();
        $sql = "insert into tb_libro values (?)";
        $stm = $c->prepare($sql);
        
    }

    public function modificarLibro($libro) {}

    public function eliminarLibro($id) {}

    public function actualizarEstado($id, $estado) {}
}
?>
