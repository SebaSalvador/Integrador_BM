<?php

require_once "modelo/TipoUsuario.php";
require_once "dao/DAO_TipoUsuario.php";
require_once "modelo/Estado.php";
require_once "dao/DAO_Estado.php";
require_once "modelo/Categoria.php";
require_once "dao/DAO_Categoria.php";
require_once "modelo/Usuario.php";
require_once "dao/DAO_Usuario.php";
require_once "modelo/Prestamo.php";
require_once "dao/DAO_Prestamo.php";

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
/*
$daoTipoUsu = new DAO_TipoUsuario();
echo "<br><h3>Prueba de consultar tipo usuario</h3>";
$tipoUsu = $daoTipoUsu->consultarTipoUsuario(0);
echo "Rango:    ".$tipoUsu->getRango()."<br>";
echo "Descripcion:    ".$tipoUsu->getDescripcion()."<br>";

$daoEstado = new DAO_Estado();
echo "<br><h3>Prueba de consultar estado de libro</h3>";
$estado = $daoEstado->consultarEstado(1);
echo "Estado:    ".$estado->getEstado()."<br>";
echo "Descripcion:    ".$estado->getDescripcion()."<br>";
*/

/*
$daoCategoria = new DAO_Categoria();
echo "<br><h3>Prueba de listar Categorias</h3>";
$array3 = $daoCategoria->listarCategorias();
foreach ($array3 as $obj) {
    $idCat = $obj->getIdCat();
    $nombre = $obj->getNombre();
    echo 'Id de categoria:   '.$idCat.', ';
    echo 'Nombre:   '.$nombre.'<br>';
}

echo "<br><h3>Prueba de consultar Categoria</h3>";
$categoria = $daoCategoria->consultarCategoria(10);
$idCat = $categoria->getIdCat();
$nombre = $categoria->getNombre();
echo 'Id de categoria:   '.$idCat.', ';
echo 'Nombre:   '.$nombre.'<br>';


echo "<br><h3>Prueba de agregar Categoria</h3>";
$categoria2 = new Categoria();
$categoria2->setIdCat(15);
$categoria2->setNombre("Filosofia");
$daoCategoria->agregarCategoria($categoria2);


echo "<br><h3>Prueba de modificar Categoria</h3>";
$categoria3 = new Categoria();
$categoria3->setIdCat(15);
$categoria3->setNombre("Artes Audio-Visuales");
$daoCategoria->modificarCategoria($categoria3);

echo "<br><h3>Prueba de eliminar Categoria</h3>";
$daoCategoria->eliminarCategoria(15);
*/
/*
$daoUsuario = new DAO_Usuario();
echo "<br><h3>Prueba de listar Usuarios</h3>";
$array4 = $daoUsuario->listarUsuarios();
foreach ($array4 as $obj) {
    $idPer = $obj->getIdPer();
    $idTipo = $obj->getIdTipo();
    $pass = $obj->getPass();
    $estado = $obj->getEstado();
    $nomApe = $obj->getNomApe();
    $edad = $obj->getEdad();
    $correo = $obj->getCorreo();
    $direccion = $obj->getDireccion();
    $telefono = $obj->getTelefono();

    echo 'Id persona:   '.$idPer.', ';
    echo 'Id tipo:   '.$idTipo.', ';
    echo 'Password:   '.$pass.', ';
    echo 'Estado:   '.$estado.', ';
    echo 'Nombres y Apellidos:   '.$nomApe.', ';
    echo 'Edad:   '.$edad.', ';
    echo 'Correo:   '.$correo.', ';
    echo 'Direccion:   '.$direccion.', ';
    echo 'Telefono:   '.$telefono.'<br>';
}

echo "<br><h3>Prueba de agregar Usuario</h3>";
$usuario = new Usuario();
$usuario->setIdPer(88662233);
$usuario->setIdTipo(2);
$usuario->setPass("2468");
$usuario->setEstado("Activo");
$usuario->setNomApe("DE LA CRUZ ZAPATA ROMEL");
$usuario->setEdad(23);
$usuario->setCorreo("delacruzzapatar@gmail.com");
$usuario->setDireccion("jr. Zuñiga 403 lt 12");
$usuario->setTelefono("945000222");

$daoUsuario->agregarUsuario($usuario);


echo "<br><h3>Prueba de modificar Usuario</h3>";
$usuario2 = new Usuario();
$usuario2->setIdPer(88662233);
$usuario2->setIdTipo(2);
$usuario2->setPass("2468");
$usuario2->setEstado("Activo");
$usuario2->setNomApe("DE LA CRUZ ZAPATA JULIA");
$usuario2->setEdad(30);
$usuario2->setCorreo("julia@gmail.com");
$usuario2->setDireccion("jr. Zuñiga 403 lt 12");
$usuario2->setTelefono("945000222");

$daoUsuario->modificarUsuario($usuario2);

echo "<br><h3>Prueba de eliminar Usuario</h3>";
$daoUsuario->eliminarUsuario(88662233);
*/

$daoPre = new DAO_Prestamo();
$rspt = $daoPre->verificarPosibilidadPrestamo(53123564);
if ($rspt != null) {
    echo 'No puede realizar otro prestamo, porque ya tiene uno en estado '.$rspt;
}
?>