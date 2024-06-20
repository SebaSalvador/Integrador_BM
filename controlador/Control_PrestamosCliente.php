<?php


require_once "dao/DAO_Prestamo.php";

class Control_PrestamosCliente
{
    private $cn;

    public function __construct()
    {
        $this->cn = new conexion();
    }

    public function getPrestamosPorUsuario($user_id)
    {
        $dao = new DAO_Prestamo();
        $prestamos = $dao->consultarPrestamoPorUsuario($user_id);
        // Devolver el array de préstamos, puede ser un array vacío si no se encontraron resultados
        return $prestamos;
    }
}

