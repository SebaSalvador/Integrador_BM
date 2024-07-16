<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];

    $cn = new conexion();
    $conn = $cn->conecta();

    $sql = "UPDATE tb_prestamo SET estado = ? WHERE id_pre = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $estado, $id);
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
