<?php
require_once "util/conexion.php";
require_once "modelo/Categoria.php";

class DAO_Categoria
{
    var $cn;

    public function listarCategorias() {
        $cn = new conexion();
        $c = $cn->conecta();
        $categorias = array();
        $sql = "select * from tb_categoria";
        if ($result = $c->query($sql)) {
            while ($row = $result->fetch_array()) {
                $categoria = new Categoria();
                $categoria->setIdCat($row[0]);
                $categoria->setNombre($row[1]);
                $categorias[] = $categoria;
            }
        }
        $cn->desconecta();
        return $categorias;
    }

    public function consultarCategoria($id) {
        $cn = new conexion();
        $c = $cn->conecta();
        $categoria = new Categoria();
        $sql = "select * from tb_categoria where id_cat = ?";
        $stm = $c->prepare($sql);
        $stm->execute(array($id));
        $result = $stm->get_result();
        if ($row = $result->fetch_array()) {
            $categoria->setIdCat($row[0]);
            $categoria->setNombre($row[1]);
        }
        $cn->desconecta();
        return $categoria;

    }

    public function agregarCategoria($categoria) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "insert into tb_categoria values (?, ?)";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($categoria->getIdCat(), $categoria->getNombre()));
        if (!$bool) {
            echo "Error al agregar libro";
        }
        $cn->desconecta();

    }

    public function modificarCategoria($categoria) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "update tb_categoria set nombre=? where id_cat=?";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($categoria->getNombre(), $categoria->getIdCat()));
        if (!$bool) {
            echo "Error al modificar libro";
        }
        $cn->desconecta();

    }

    public function eliminarCategoria($id) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "delete from tb_categoria where id_cat=?";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($id));
        if (!$bool) {
            echo "Error al eliminar libro";
        }
        $cn->desconecta();

    }

}
?>