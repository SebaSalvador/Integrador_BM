<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "util/conexion.php";
require_once 'controlador/Control_BuscarLector.php'; // Ajusta esta ruta según la ubicación real de tu archivo Control_BuscarLector.php
require_once 'controlador/Control_FormPrestamo.php';
require_once 'controlador/Control_ClienteMain.php';
require_once 'controlador/Control_EmpleadoMain.php';


header('Content-Type: application/json'); // Asegura que el contenido sea JSON

ob_start(); // Inicia el almacenamiento en búfer de salida

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if ($_POST['accion'] === 'obtener_prestamos') {
        $estado = $_POST['estado'];
        try {

            $controladorPrestamo = new Control_FormPrestamo();
            $prestamo = $controladorPrestamo->obtenertodosPrestamos($estado);

            echo json_encode($prestamo);
            exit();
        } catch (PDOException $e) {
            echo json_encode(array('status' => 'ERROR', 'message' => 'Error al conectar a la base de datos: ' . $e->getMessage()));
            exit();
        }
    }

    if ($_POST['accion'] === 'obtener_clientes') {
        try {

            $controladorClientes = new Control_ClienteMain();
            $clientes = $controladorClientes->obtenertodosClientes();

            echo json_encode($clientes);
            exit();
        } catch (PDOException $e) {
            echo json_encode(array('status' => 'ERROR', 'message' => 'Error al conectar a la base de datos: ' . $e->getMessage()));
            exit();
        }
    }
    
    if ($_POST['accion'] === 'obtener_empleados') {
        try {

            $controladorEmpleados = new Control_EmpleadoMain();
            $empleados = $controladorEmpleados->obtenertodosEmpleados();

            echo json_encode($empleados);
            exit();
        } catch (PDOException $e) {
            echo json_encode(array('status' => 'ERROR', 'message' => 'Error al conectar a la base de datos: ' . $e->getMessage()));
            exit();
        }
    }

    if ($_POST['accion'] === 'obtener_sanciones') {
        try {

            $controladorSancion = new Control_FormPrestamo();
            $sanciones = $controladorSancion->obtenertodasSanciones();

            echo json_encode($sanciones);
            exit();
        } catch (PDOException $e) {
            echo json_encode(array('status' => 'ERROR', 'message' => 'Error al conectar a la base de datos: ' . $e->getMessage()));
            exit();
        }
    }
    
    $dni = filter_input(INPUT_POST, 'dni', FILTER_VALIDATE_INT);
    
    if ($dni) {
        $controlador = new Control_BuscarLector();
        $lector = $controlador->buscarLectorPorDNI($dni);
        
        if ($lector) {
            ob_end_clean(); // Limpia el búfer de salida antes de enviar la respuesta JSON
            echo json_encode(['success' => true, 'nombre' => $lector['nombre']]);
        } else {
            ob_end_clean(); // Limpia el búfer de salida antes de enviar la respuesta JSON
            echo json_encode(['success' => false, 'message' => 'Lector no encontrado']);
        }
    } else {
        ob_end_clean(); // Limpia el búfer de salida antes de enviar la respuesta JSON
        echo json_encode(['success' => false, 'message' => 'DNI inválido']);
    }
} else {
    ob_end_clean(); // Limpia el búfer de salida antes de enviar la respuesta JSON
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
