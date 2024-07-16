<?php
require_once "util/conexion.php";
require_once 'dao/DAO_Prestamo.php';
require_once 'dao/DAO_Libro.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];

    $daoPrestamo = new DAO_Prestamo();
    $prestamo = $daoPrestamo->consultarPrestamo($id);
    $idLib = $prestamo->getIdLib();
    echo $idLib;
    $daoLib = new DAO_Libro();

    $cn = new conexion();
    $conn = $cn->conecta();

    $sql = "UPDATE tb_prestamo SET estado = ? WHERE id_pre = ?";

    if ($stmt = $conn->prepare($sql)) {
        $idpre = (int)$id;
        echo $idpre;
        echo $estado;
        if ($estado == "Finalizado") {
            $daoLib->actualizarEstado($idLib, 1);
            
        }

        $stmt->bind_param("si", $estado, $idpre);
        
        if ($stmt->execute()) {
            echo "Estado actualizado correctamente";
        } else {
            echo "Error al actualizar el estado: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    mysqli_close($conn);
}
?>
