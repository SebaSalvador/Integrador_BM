<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "util/conexion.php";
require_once 'controlador/Control_BuscarLector.php'; // Ajusta esta ruta según la ubicación real de tu archivo Control_BuscarLector.php
require_once 'controlador/Control_FormPrestamo.php';

header('Content-Type: application/json'); // Asegura que el contenido sea JSON

ob_start(); // Inicia el almacenamiento en búfer de salida

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['accion'] === 'obtener_prestamos') {
        $estado = $_POST['estado'];
        try {

            $controlador = new Control_FormPrestamo();
            $prestamo = $controlador->obtenertodosPrestamos($estado);

            echo json_encode($prestamo);
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
