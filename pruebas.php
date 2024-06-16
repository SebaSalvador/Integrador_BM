<?php
/*
echo "<br>Prueba de listar libros<br>";
$daoLibro = new DAO_Libro();
$array = $daoLibro->listarLibros();
foreach ($array as $obj) {
    $titulo = $obj->getTitulo();
    echo $titulo.'<br>';

}
    
echo "<br>Prueba de agregar libro<br>";
$libro1 = new Libro();
$libro1->setIdLib(4);
$libro1->setIdEst(2);
$libro1->setIdCat(10);
$libro1->setTitulo("La Odisea");
$libro1->setDescripcion("Poema épico griego atribuido a Homero");
$libro1->setAutor("Homero");
$libro1->setFecPub("8 a.C.");
$daoLibro->agregarLibro($libro1);
echo "<br>Prueba de consultar libro por idLib<br>";
$libroId = $daoLibro->consultarLibro(4);
echo 'Titulo:   '.$libroId->getTitulo().'<br>';
echo 'Autor:    '.$libroId->getAutor().'<br>';

echo "<br>Prueba de consultar libro por autor<br>";
$array2 = $daoLibro->consultarLibroPorAut("Homero");
foreach ($array2 as $obj) {
    $titulo = $obj->getTitulo();
    $fecPub = $obj->getFecPub();
    echo 'Titulo:   '.$titulo.'<br>';
    echo 'Fecha Publicacion:   '.$fecPub.'<br>';

}

echo "<br>Prueba de modificar libro<br>";
$libro2 = new Libro();
$libro2->setIdLib(4);
$libro2->setIdEst(2);
$libro2->setIdCat(10);
$libro2->setTitulo("La Odisea de Homero");
$libro2->setDescripcion("Poema épico griego atribuido a Homero Simpson");
$libro2->setAutor("Homero Simpson");
$libro2->setFecPub("8 a.C.");
$daoLibro->modificarLibro($libro2);

echo "<br>Prueba de eliminar libro<br>";
$daoLibro->eliminarLibro(4);
*/


?>