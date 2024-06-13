<?php
require_once "controlador/Control.php";
require_once "dao/DAO_Libro.php";
require_once "modelo/Libro.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $daoLibro = new DAO_Libro();
    $array = $daoLibro->listarLibros();
    foreach ($array as $obj) {
        $titulo = $obj->getTitulo();
        echo $titulo.'<br>';

    }
    ?>
</body>
</html>