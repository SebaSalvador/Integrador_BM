<?php
require_once "util/conexion.php";
require_once "modelo/Estado.php";

class DAO_Estado 
{
    var $con;

    public function consultarEstado($id){
        $cn = new conexion();
        $c = $cn->conecta();
        $estado = new Estado();
        $sql = "select * from tb_estado where id_est = ?";
        $stm = $c->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();
        if ($row = $result->fetch_array()) {
            $estado->setIdEst($row[0]);
            $estado->setEstado($row[1]);
            $estado->setDescripcion($row[2]);
        }
        $cn->desconecta();
        return $estado;

    }
}
?>