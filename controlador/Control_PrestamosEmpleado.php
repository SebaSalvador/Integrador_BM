<?php


require_once "dao/DAO_Prestamo.php";

class Control_PrestamosEmpleado
{
    private $cn;

    public function __construct()
    {
        $this->cn = new conexion();
    }

    public function getPrestamos()
    {
        $dao = new DAO_Prestamo();
        $prestamos = $dao->listarPrestamos();
        // Devolver el array de préstamos, puede ser un array vacío si no se encontraron resultados
        return $prestamos;
    }
}

