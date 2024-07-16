<?php

require_once "dao/DAO_Prestamo.php";
require_once "modelo/Prestamo.php";
require_once "dao/DAO_Sancion.php";
require_once "dao/DAO_Observacion.php";

class Control_FormPrestamo
{

    // Método para registrar un préstamo
    public function registrarPrestamo($id_persona, $id_libro, $fecha_prestamo, $hora_prestamo, $fecha_devolucion, $hora_devolucion, $estado)
    {
        // Verificar que ningún parámetro esté vacío
        if (
            empty($id_persona) ||
            empty($id_libro) ||
            empty($fecha_prestamo) ||
            empty($hora_prestamo) ||
            empty($fecha_devolucion) ||
            empty($hora_devolucion) ||
            empty($estado)
        ) {

            // Manejo de error si algún parámetro está vacío
            echo "Error: Todos los campos deben estar llenos.";
            return false;
        }

        $dao = new DAO_Prestamo();
        $prestamo = new Prestamo();
        $prestamo->setIdPer($id_persona);
        $prestamo->setIdLib($id_libro);
        $prestamo->setFecPre($fecha_prestamo);
        $prestamo->setHorPre($hora_prestamo);
        $prestamo->setFecDev($fecha_devolucion);
        $prestamo->setHorDev($hora_devolucion);
        $prestamo->setEstado($estado);

        // Agregar el préstamo usando el DAO
        $res = $dao->agregarPrestamo($prestamo);

        if ($res === false) {
            // Manejo de error si la inserción falla
            echo "Error al registrar el préstamo.";
        } else {
            echo "Préstamo registrado correctamente.";
        }

        return $res;
    }

    // Método para obtener todos los préstamos
    public function obtenertodosPrestamos($estado)
    {

        $dao = new DAO_Prestamo();

        // Agregar el préstamo usando el DAO
        $res = $dao->obtenertodosPrestamos($estado);

        return $res;
    }

    
    public function obtenertodosPrestamosEmpleado(){
        $dao = new DAO_Prestamo();
        $res = $dao->obtenertodosPrestamosEmpleadoDAO();
        return $res;
    }


    // Método para obtener todas las sanciones
    public function obtenertodasSanciones()
    {

        $dao = new DAO_Sancion();

        // Agregar el préstamo usando el DAO
        $res = $dao->obtenertodasSancionesDAO();

        return $res;
    }

    // Método para obtener todas las observaciones
    public function obtenertodasObservaciones()
    {

        $dao = new DAO_Observacion();

        // Agregar el préstamo usando el DAO
        $res = $dao->obtenertodasObservacionesDAO();

        return $res;
    }
    // Método para obtener todas las observaciones
    public function obtenertodasCantidad()
    {

        $dao = new DAO_Prestamo();

        // Agregar el préstamo usando el DAO
        $res = $dao->obtenertodasCantidadDAO();

        return $res;
    }
}
