<?php

require_once 'util/conexion.php'; // Asegúrate de incluir tu archivo de conexión

$cn = new conexion();
$conn = $cn->conecta();

$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
$buscar = isset($_POST['buscar']) ? $_POST['buscar'] : '';
$autor = isset($_POST['autor']) ? $_POST['autor'] : '';

$sql = "SELECT tl.id_lib, tl.titulo 
        FROM tb_libro tl
        INNER JOIN tb_categoria tc ON tl.id_cat = tc.id_cat 
        WHERE 1=1";

if (!empty($categoria)) {
    $sql .= " AND tc.id_cat = '".$conn->real_escape_string($categoria)."'";
}
if (!empty($autor)) {
    $sql .= " AND tl.autor = '".$conn->real_escape_string($autor)."'";
}
if (!empty($buscar)) {
    $sql .= " AND tl.titulo LIKE '%".$conn->real_escape_string($buscar)."%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='card'>";
        echo "<h2>".$row['titulo']."</h2>";
        echo "<p>ID Libro: ".$row['id_lib']."</p>";
        echo "</div>";
    }
} else {
    echo "<p>No se encontraron resultados</p>";
}

$cn->desconecta();
?>
