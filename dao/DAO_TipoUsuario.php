<?php
require_once "util/conexion.php";
require_once "modelo/TipoUsuario.php";

class DAO_TipoUsuario 
{
    var $cn;

    public function consultarTipoUsuario($id) {
        $cn = new conexion();
        $c = $cn->conecta();
        $tipoUsu = new TipoUsuario();
        $sql = "select * from tb_TipoUsuario where id_tipo = ?";
        $stm = $c->prepare($sql);
        $stm->execute(array($id));
        $result = $stm->get_result();
        if ($row = $result->fetch_array()) {
            $tipoUsu->setIdTipo($row[0]);
            $tipoUsu->setRango($row[1]);
            $tipoUsu->setDescripcion($row[2]);
        }
        $cn->desconecta();
        return $tipoUsu;
        
    }

}

?>