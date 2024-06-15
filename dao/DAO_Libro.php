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
        $stm->execute(array($id));
        $result = $stm->get_result();
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

    public function consultarLibroPorEst($id_est) {
        $cn = new conexion();
        $c = $cn->conecta();
        $libros = array();
        $sql = "select * from tb_libro where id_est=?";
        $stm = $c->prepare($sql);
        $stm->execute(array($id_est));
        if ($result = $stm->get_result()) {
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
        $sql = "select * from tb_libro where id_cat = ?";
        $stm = $c->prepare($sql);
        $stm->execute(array($id_cat));
        if ($result = $stm->get_result()) {
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
        $sql = "select * from tb_libro where autor = ?";
        $stm = $c->prepare($sql);
        $stm->execute(array($autor));
        if ($result = $stm->get_result()) {
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
        $sql = "insert into tb_libro values (?, ?, ?, ?, ?, ?, ?)";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($libro->getIdLib(), $libro->getIdEst(), $libro->getIdCat(), $libro->getTitulo(), $libro->getDescripcion(), $libro->getAutor(), $libro->getFecPub()));
        if (!$bool) {
            echo "Error al agregar libro";
        }
        $cn->desconecta();
    }

    public function modificarLibro($libro) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "update tb_libro set id_cat=?, titulo=?, descripcion=?, autor=?, fec_pub=? where id_lib=?";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($libro->getIdCat(), $libro->getTitulo(), $libro->getDescripcion(), $libro->getAutor(), $libro->getFecPub(), $libro->getIdLib()));
        if (!$bool) {
            echo "Error al modificar libro";
        }
        $cn->desconecta();
    }

    public function eliminarLibro($id) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "delete from tb_libro where id_lib=?";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($id));
        if (!$bool) {
            echo "Error al eliminar libro";
        }
        $cn->desconecta();
    }

    public function actualizarEstado($id, $id_est) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "update tb_libro set id_est=? where id_lib=?";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($id_est, $id));
        if (!$bool) {
            echo "Error al actualizar el estado del libro";
        }
        $cn->desconecta();
    }
}
?>
