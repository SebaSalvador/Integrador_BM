<?php
require_once "util/conexion.php";
require_once "modelo/Prestamo.php";

class DAO_Prestamo
{
    var $cn;

    #Recordar: agrega el atributo '$estado' a la clase Prestamo
    public function consultarPrestamo($id) {return $prestamo;}
    
    public function consultarPrestamoPorEst($estado) {
        $cn = new conexion();
        $c = $cn->conecta();
        $prestamos = array();
        $sql = "select * from tb_prestamo where estado=?";
        $stm = $c->prepare($sql);
        $stm->execute(array($estado));
        if ($result = $stm->get_result()) {
            while ($row = $result->fetch_array()) {
                $prestamo = new Prestamo();
                $prestamo->setIdPre($row[0]);
                $prestamo->setIdPer($row[1]);
                $prestamo->setIdLib($row[2]);
                $prestamo->setFecPre($row[3]);
                $prestamo->setHorPre($row[4]);
                $prestamo->setFecDev($row[5]);
                $prestamo->setHorDev($row[6]);
                $prestamo->setEstado($row[7]);
                $prestamos[] = $prestamo;
            }
        }
        $cn->desconecta();   
        return $prestamos;
    }

    public function agregarPrestamo($prestamo) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "INSERT INTO tb_prestamo (id_per, id_lib, fec_pre, hor_pre, fec_dev, hor_dev, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stm = $c->prepare($sql);
        
        // Obtener los valores del objeto $prestamo
        $id_per = $prestamo->getIdPer();
        $id_lib = $prestamo->getIdLib();
        $fec_pre = $prestamo->getFecPre();
        $hor_pre = $prestamo->getHorPre();
        $fec_dev = $prestamo->getFecDev();
        $hor_dev = $prestamo->getHorDev();
        $estado = $prestamo->getEstado();
        
        // Vincular parámetros
        $stm->bind_param("iisssss", 
            $id_per, 
            $id_lib, 
            $fec_pre, 
            $hor_pre, 
            $fec_dev, 
            $hor_dev, 
            $estado
        );
        
        // Ejecutar la sentencia preparada
        $bool = $stm->execute();
        
        $cn->desconecta();
    
        return $bool;
    }
        

    public function actualizarEstado($id, $estado) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "update tb_prestamo set estado=? where id_pre=?";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($estado, $id));
        if (!$bool) {
            echo "Error al actualizar el estado del prestamo";
        }
        $cn->desconecta();
    }
}
?>
