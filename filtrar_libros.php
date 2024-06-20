<?php

require_once 'util/conexion.php'; // Asegúrate de incluir tu archivo de conexión

$cn = new conexion();
$conn = $cn->conecta();

session_start();
$idUsu = $_SESSION['user_id'];

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
    $sql .= " AND tl.autor LIKE '%".$conn->real_escape_string($autor)."%'";
}
if (!empty($buscar)) {
    $sql .= " AND tl.titulo LIKE '%".$conn->real_escape_string($buscar)."%'";
}

$result = $conn->query($sql);

echo "<div class='row mb-4'>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='col-xl-3 col-md-6 mb-4'>";
        echo "<div class='card border-left-warning shadow h-100 py-2'>";
        echo "<div class='card-body'>";
        echo "<div class='row no-gutters align-items-center'>";
        echo "<div class='col mr-2'>";
        echo "<div class='text-xs font-weight-bold text-warning text-uppercase mb-1'>Libro</div>";
        echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>" . $row['titulo'] . "</div>";
        echo "<p>ID Libro: " . $row['id_lib'] . "</p>";
        echo '<button type="button" onclick="javascript:openDetailBook(\'' . $row['id_lib'] . '\', '.$idUsu.');">Ver Libro<i class="fa-solid fa-eye"></i></button>';
        echo "</div>";
        echo "<div class='col-auto'>";
        echo "<img src='galeria/" . $row['id_lib'] . ".jpg' alt='Carátula del libro' class='img-fluid' style='max-width: 50px;'>";
        echo "</div>";
        echo "</div>"; // Cierra row no-gutters align-items-center
        echo "</div>"; // Cierra card-body
        echo "</div>"; // Cierra card border-left-warning shadow h-100 py-2
        echo "</div>"; // Cierra col-xl-3 col-md-6 mb-4
    }
} else {
    echo "<p>No se encontraron resultados</p>";
}
echo "</div>"; // Cierra row mb-4


$cn->desconecta();
?>
