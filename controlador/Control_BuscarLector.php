<?php

class Control_BuscarLector
{

    private $db;

    public function __construct()
    {
        $cn = new conexion();
        $this->db = $cn->conecta();
    }

    public function buscarLectorPorDNI($dni)
    {
        $sql = "SELECT nom_ape as nombre FROM `tb_persona` WHERE id_per = ?";
        $stm = $this->db->prepare($sql);
        $stm->bind_param("i", $dni);
        $stm->execute();
        $result = $stm->get_result();
        $lector = $result->fetch_assoc();
        $stm->close();
        $this->db->close();
        return $lector;
    }
}
