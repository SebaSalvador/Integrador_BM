<?php
require_once(__DIR__ . '/../util/conexion.php');
require_once(__DIR__ . '/../modelo/Libro.php');


class DAO_Libro 
{
    var $cn;

    public function listarAutores() {
        $cn = new conexion();
        $sql = "SELECT DISTINCT tl.autor FROM tb_libro tl;";
        $conn = $cn->conecta();
        $res = mysqli_query($conn, $sql);

        if (!$res) {
            // Si hay un error en la consulta, lanzar una excepción
            throw new Exception('Error al ejecutar la consulta: ' . mysqli_error($conn));
        }
        
        $autores = [];
        
        // Verificar si se encontraron categorías
        if (mysqli_num_rows($res) > 0) {
            // Obtener todas las filas como un array asociativo
            while ($row = mysqli_fetch_assoc($res)) {
                $autores[] = $row;
            }
            // Liberar el resultado
            mysqli_free_result($res);
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conn);

        // Devolver el array de categorías, puede ser un array vacío si no se encontraron resultados
        return $autores;
    }
    
    public function listarLibros() {
        $cn = new conexion();
        $conn = $cn->conecta();
        $sql = "SELECT tl.id_lib, tl.titulo 
                FROM tb_libro tl
                INNER JOIN tb_categoria tc ON tl.id_cat = tc.id_cat";
        $res = mysqli_query($conn, $sql);
    
        if (!$res) {
            // Si hay un error en la consulta, lanzar una excepción
            throw new Exception('Error al ejecutar la consulta: ' . mysqli_error($conn));
        }
    
        $libros = [];
    
        // Verificar si se encontraron libros
        if (mysqli_num_rows($res) > 0) {
            // Obtener todas las filas como un array asociativo
            while ($row = mysqli_fetch_assoc($res)) {
                $libro = new Libro();
                $libro->setIdLib($row['id_lib']);
                $libro->setTitulo($row['titulo']);
                // Aquí puedes añadir los demás setters si necesitas más información
                $libros[] = $libro;
            }
            // Liberar el resultado
            mysqli_free_result($res);
        }
    
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    
        // Devolver el array de libros, puede ser un array vacío si no se encontraron resultados
        return $libros;
    }
    

    public function consultarLibro($id) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "
            select tl.id_lib, tl.titulo, tl.descripcion, tl.autor, tl.fec_pub, tc.nombre 
            from tb_libro tl 
            inner join tb_categoria tc on tl.id_cat = tc.id_cat 
            where tl.id_lib = ?
        ";
        $stm = $c->prepare($sql);
        $stm->bind_param("s", $id);  // "s" indica que $id es una cadena (string)
        $stm->execute();
    
        // Vincular variables de resultado
        $stm->bind_result($id_lib, $titulo, $descripcion, $autor, $fec_pub, $categoria);
    
        $libro = null;
        if ($stm->fetch()) {
            $libro = [
                'id_lib' => $id_lib,
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'autor' => $autor,
                'fec_pub' => $fec_pub,
                'categoria' => $categoria
            ];
        }
    
        $stm->close();
        $cn->desconecta();
        return $libro;
    }
    

    public function consultarLibroPorEst($id_est) {
        $cn = new conexion();
        $c = $cn->conecta();
        $libros = array();
        $sql = "select * from tb_libro where id_est=?";
        $stm = $c->prepare($sql);
        $stm->execute(array($id_est));
        if ($result = $stm->get_result()) {
            while ($row = $result->fetch_array()) {
                $libro = new Libro();
                $libro->setIdLib($row[0]);
                $libro->setIdEst($row[1]);
                $libro->setIdCat($row[2]);
                $libro->setTitulo($row[3]);
                $libro->setDescripcion($row[4]);
                $libro->setAutor($row[5]);
                $libro->setFecPub($row[6]);
                $libros[] = $libro;
            }
        }
        $cn->desconecta();   
        return $libros;
    }

    public function consultarLibroPorCat($id_cat) {
        $cn = new conexion();
        $c = $cn->conecta();
        $libros = array();
        #$sql = "select * from tb_libro as tb inner join tb_categoria as tc on tb.id_cat = tc.id_cat where tc.categoria = ?";
        $sql = "select * from tb_libro where id_cat = ?";
        $stm = $c->prepare($sql);
        $stm->execute(array($id_cat));
        if ($result = $stm->get_result()) {
            while ($row = $result->fetch_array()) {
                $libro = new Libro();
                $libro->setIdLib($row[0]);
                $libro->setIdEst($row[1]);
                $libro->setIdCat($row[2]);
                $libro->setTitulo($row[3]);
                $libro->setDescripcion($row[4]);
                $libro->setAutor($row[5]);
                $libro->setFecPub($row[6]);
                $libros[] = $libro;
            }
        }
        $cn->desconecta(); 
        return $libros;
    }
    
    public function consultarLibroPorAut($autor) {
        $cn = new conexion();
        $c = $cn->conecta();
        $libros = array();
        $sql = "select * from tb_libro where autor = ?";
        $stm = $c->prepare($sql);
        $stm->execute(array($autor));
        if ($result = $stm->get_result()) {
            while ($row = $result->fetch_array()) {
                $libro = new Libro();
                $libro->setIdLib($row[0]);
                $libro->setIdEst($row[1]);
                $libro->setIdCat($row[2]);
                $libro->setTitulo($row[3]);
                $libro->setDescripcion($row[4]);
                $libro->setAutor($row[5]);
                $libro->setFecPub($row[6]);
                $libros[] = $libro;
            }
        }
        $cn->desconecta(); 
        return $libros;
    }

    public function agregarLibro($libro) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "insert into tb_libro values (?, ?, ?, ?, ?, ?, ?)";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($libro->getIdLib(), $libro->getIdEst(), $libro->getIdCat(), $libro->getTitulo(), $libro->getDescripcion(), $libro->getAutor(), $libro->getFecPub()));
        if (!$bool) {
            echo "Error al agregar libro";
        }
        $cn->desconecta();
    }

    public function modificarLibro($libro) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "update tb_libro set id_cat=?, titulo=?, descripcion=?, autor=?, fec_pub=? where id_lib=?";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($libro->getIdCat(), $libro->getTitulo(), $libro->getDescripcion(), $libro->getAutor(), $libro->getFecPub(), $libro->getIdLib()));
        if (!$bool) {
            echo "Error al modificar libro";
        }
        $cn->desconecta();
    }

    public function eliminarLibro($id) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "delete from tb_libro where id_lib=?";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($id));
        if (!$bool) {
            echo "Error al eliminar libro";
        }
        $cn->desconecta();
    }

    public function actualizarEstado($id, $id_est) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "update tb_libro set id_est=? where id_lib=?";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($id_est, $id));
        if (!$bool) {
            echo "Error al actualizar el estado del libro";
        }
        $cn->desconecta();
    }
}
?>
