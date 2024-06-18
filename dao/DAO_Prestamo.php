<?php
require_once "util/conexion.php";
require_once "modelo/Prestamo.php";

class DAO_Prestamo
{
    var $cn;
    public function consultarLibroPorEst($estado) {
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
                $prestamos[] = $prestamo;
            }
        }
        $cn->desconecta();   
        return $prestamos;
    }
    
}
?>
