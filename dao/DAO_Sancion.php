<?php
require_once "util/conexion.php";
require_once "modelo/Sancion.php";

class DAO_Sancion
{
    var $cn;

    public function listarSanciones() {
        $cn = new conexion();
        $sql = "select * from tb_sancion";
        $sancion = new Sancion();
        $conn = $cn->conecta();
        $res = mysqli_query($conn, $sql);

        if (!$res) {
            throw new Exception('Error al ejecutar la consulta: ' . mysqli_error($conn));
        }
        
        $sanciones = [];
        
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $sancion->setIdSan($row['id_san']);
                $sancion->setIdPer($row['id_per']);
                $sancion->setDiasSan($row['dias_san']);
                $sancion->setFecIni($row['fec_ini']);
                $sancion->setFecFin($row['fec_fin']);
                $sancion->setRazon($row['razon']);
                $sancion->setEstado($row['estado']);
                $sanciones[] = $sancion;
            }

            mysqli_free_result($res);
        }

        mysqli_close($conn);
        return $sanciones;
    }

    public function consultarSancion($id) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sancion = new Sancion();
        $sql = "select * from tb_sancion where id_san=?";
        $stm = $c->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();
        if ($row = $result->fetch_assoc()) {
            $sancion->setIdSan($row['id_san']);
            $sancion->setIdPer($row['id_per']);
            $sancion->setDiasSan($row['dias_san']);
            $sancion->setFecIni($row['fec_ini']);
            $sancion->setFecFin($row['fec_fin']);
            $sancion->setRazon($row['razon']);
            $sancion->setEstado($row['estado']);
        }
    
        $stm->close();
        $cn->desconecta();    
        return $sancion;
    }

    public function consultarSancionPorUsu($idUsu) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sanciones = [];
        $sql = "select * from tb_sancion where id_per=?";
        $stm = $c->prepare($sql);
        $stm->bind_param("i", $idUsu);
        $stm->execute();
        $result = $stm->get_result();
        while ($row = $result->fetch_assoc()) {
            $sancion = new Sancion();
            $sancion->setIdSan($row['id_san']);
            $sancion->setIdPer($row['id_per']);
            $sancion->setDiasSan($row['dias_san']);
            $sancion->setFecIni($row['fec_ini']);
            $sancion->setFecFin($row['fec_fin']);
            $sancion->setRazon($row['razon']);
            $sancion->setEstado($row['estado']);
            $sanciones[] = $sancion;
        }
    
        $stm->close();
        $cn->desconecta();    
        return $sanciones;
    }

    public function consultarSancionPorEst($estado) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sanciones = [];
        $sql = "select * from tb_sancion where estado=?";
        $stm = $c->prepare($sql);
        $stm->bind_param("s", $estado);
        $stm->execute();
        $result = $stm->get_result();
        while ($row = $result->fetch_assoc()) {
            $sancion = new Sancion();
            $sancion->setIdSan($row['id_san']);
            $sancion->setIdPer($row['id_per']);
            $sancion->setDiasSan($row['dias_san']);
            $sancion->setFecIni($row['fec_ini']);
            $sancion->setFecFin($row['fec_fin']);
            $sancion->setRazon($row['razon']);
            $sancion->setEstado($row['estado']);
            $sanciones[] = $sancion;
        }
    
        $stm->close();
        $cn->desconecta();    
        return $sanciones;
    }

    public function agregarSancion($sancion) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "insert into tb_sancion values (null, ?, ?, ?, ?, ?, ?)";
        $stm = $c->prepare($sql);
        $stm->bind_param("iissss", $sancion->getIdper(), $sancion->getDiasSan(), $sancion->getFecIni()
            , $sancion->getFecFin(), $sancion->getRazon(), $sancion->getEstado());
        $bool = $stm->execute();
        if (!$bool) {
            echo "Error al agregar sancion";
        }
        $cn->desconecta();
    }

    public function eliminarSancion($id) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "delete from tb_sancion where id_san=?";
        $stm = $c->prepare($sql);
        $stm->bind_param("i", $id);
        $bool = $stm->execute();
        if (!$bool) {
            echo "Error al eliminar sancion";
        }
        $cn->desconecta();
    }

    public function actualizarEstado($id, $estado) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "update tb_sancion set estado=? where id_san=?";
        $stm = $c->prepare($sql);
        $stm->bind_param("si", $estado, $id);
        $bool = $stm->execute();
        if (!$bool) {
            echo "Error al actualizar el estado de la sancion";
        }
        $cn->desconecta();

    }
}
?>