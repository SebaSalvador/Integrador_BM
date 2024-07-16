<?php
require_once(__DIR__ . '/../util/conexion.php');

class DAO_Observacion
{
    var $cn;

    public function listarObservaciones() {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "select * from tb_observacion";
        $stm = $c->prepare($sql);
        $stm->execute();
        $result = $stm->get_result();
        $arrayObs = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $arrayObs[] = $row;
            }
         }
        $cn->desconecta();   
        return $arrayObs;
    }

    
    public function consultarObservacionPorLib($idLib) {
        $cn = new conexion();
        $c = $cn->conecta();
        $id = (int)$idLib;
        $sql = "select * from tb_observacion where id_lib = ?";
        $stm = $c->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();
        $arrayObs = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $arrayObs[] = $row;
            }
         }
        $cn->desconecta();   
        return $arrayObs;
    }

    public function agregarObservacion($obs) {
        $cn = new conexion();
        $c = $cn->conecta();
        $idLib = (int)$obs['id_lib'];
        $descripcion = $obs['descripcion'];
        $fecObs = $obs['fec_obs'];
        $estado = 'Inutilizable';
        $sql = "insert into tb_observacion values (null, ?, ?, ?, null, ?)";
        $stm = $c->prepare($sql);
        $stm->bind_param("isss", $idLib,$descripcion,$fecObs,$estado);
        $stm->execute();
        $cn->desconecta();   
    }

    public function actualizarEstado($id, $estado) {
        $cn = new conexion();
        $c = $cn->conecta();
        $idObs = (int)$id;
        $sql = "update tb_observacion set estado=? where id_obs=?";
        $stm = $c->prepare($sql);
        $stm->bind_param("si", $estado, $idObs);
        $bool = $stm->execute();
        if (!$bool) {
            echo "Error al actualizar el estado de la observacion";
        }
        $cn->desconecta(); 
    }

    public function actualizarFecSol($id, $fecAct) {
        $cn = new conexion();
        $c = $cn->conecta();
        $idObs = (int)$id;
        $sql = "update tb_observacion set fec_sol=? where id_obs=?";
        $stm = $c->prepare($sql);
        $stm->bind_param("si", $fecAct, $idObs);
        $bool = $stm->execute();
        if (!$bool) {
            echo "Error al actualizar la fecha de solucion";
        }
        $cn->desconecta(); 
    }

    // Método para obtener todas las OBSERVACIONES
    public function obtenertodasObservacionesDAO() {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "SELECT 
                    o.id_obs AS 'ID_Obs', 
                    l.titulo AS 'Titulo', 
                    o.descripcion AS 'Descripcion', 
                    o.estado AS 'Estado', 
                    o.fec_obs AS 'Fec_Obs', 
                    o.fec_sol AS 'Fec_Sol'
                FROM 
                    tb_observacion o
                JOIN 
                    tb_libro l ON o.id_lib = l.id_lib;

                ";
                
        $stm = $c->prepare($sql);
        $stm->execute();
        // Obtener los resultados
        $result = $stm->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $cn->desconecta();
        return $data;
    }


}
?>