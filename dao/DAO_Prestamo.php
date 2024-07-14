<?php
require_once(__DIR__ . '/../util/conexion.php');
require_once(__DIR__ . '/../modelo/Prestamo.php');

class DAO_Prestamo
{
    var $cn;

    public function consultarPrestamoPorUsuario($idUsuario)
    {
        $cn = new conexion();
        $conn = $cn->conecta();
        $sql = "SELECT * FROM tb_prestamo tpr 
                INNER JOIN tb_persona tpe ON tpr.id_per = tpe.id_per 
                WHERE tpe.id_per = ?";

        $prestamos = [];

        // Preparar la sentencia
        if ($stmt = $conn->prepare($sql)) {
            // Vincular parámetros
            $stmt->bind_param("i", $idUsuario);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener el resultado
            $result = $stmt->get_result();

            // Verificar si se encontraron resultados
            if ($result->num_rows > 0) {
                // Obtener todas las filas como un array asociativo
                while ($row = $result->fetch_assoc()) {
                    $prestamo = new Prestamo();
                    $prestamo->setIdPre($row['id_pre']);
                    $prestamo->setIdPer($row['id_per']);
                    $prestamo->setIdLib($row['id_lib']);
                    $prestamo->setFecPre($row['fec_pre']);
                    $prestamo->setHorPre($row['hor_pre']);
                    $prestamo->setFecDev($row['fec_dev']);
                    $prestamo->setHorDev($row['hor_dev']);
                    $prestamo->setEstado($row['estado']);
                    $prestamos[] = $prestamo;
                }
                // Liberar el resultado
                $stmt->free_result();
            }

            // Cerrar la sentencia
            $stmt->close();
        } else {
            // Si hay un error en la preparación de la consulta, lanzar una excepción
            throw new Exception('Error al preparar la consulta: ' . $conn->error);
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conn);

        // Devolver el array de préstamos, puede ser un array vacío si no se encontraron resultados
        return $prestamos;
    }


    public function consultarPrestamo($id)
    {
        $cn = new conexion();
        $c = $cn->conecta();
        $prestamo = new Prestamo();
        $sql = "select * from tb_prestamo where id_pre=?";
        $stm = $c->prepare($sql);
        $stm->execute(array($id));
        if ($result = $stm->get_result()) {
            if ($row = $result->fetch_array()) {
                $prestamo->setIdPre($row[0]);
                $prestamo->setIdPer($row[1]);
                $prestamo->setIdLib($row[2]);
                $prestamo->setFecPre($row[3]);
                $prestamo->setHorPre($row[4]);
                $prestamo->setFecDev($row[5]);
                $prestamo->setHorDev($row[6]);
                $prestamo->setEstado($row[7]);
            }
        }
        $cn->desconecta();
        return $prestamo;
    }

    public function consultarPrestamoPorEst($estado)
    {
        $cn = new conexion();
        $c = $cn->conecta();
        $prestamos = array();
        $sql = "select * from tb_prestamo where estado=?";
        $stm = $c->prepare($sql);
        $stm->execute(array($estado));
        if ($result = $stm->get_result()) {
            while ($row = $result->fetch_array()) {
                $prestamo = new Prestamo();
                $prestamo->setIdPre($row[0]);
                $prestamo->setIdPer($row[1]);
                $prestamo->setIdLib($row[2]);
                $prestamo->setFecPre($row[3]);
                $prestamo->setHorPre($row[4]);
                $prestamo->setFecDev($row[5]);
                $prestamo->setHorDev($row[6]);
                $prestamo->setEstado($row[7]);
                $prestamos[] = $prestamo;
            }
        }
        $cn->desconecta();
        return $prestamos;
    }

    public function obtenertodosPrestamos($estado)
    {
        if ($estado != "") {
            $consulta_estado = " WHERE p.estado = ?";
        } else {
            $consulta_estado = "";
        }
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "SELECT
                p.id_pre AS id,
                l.titulo AS titulo,
                pe.nom_ape AS nombre_apellido,
                p.fec_pre AS fecha_prestamo,
                p.fec_dev AS fecha_devolucion,
                p.estado AS estado
                FROM tb_prestamo p
                INNER JOIN tb_libro l ON p.id_lib = l.id_lib
                INNER JOIN tb_persona pe ON p.id_per = pe.id_per $consulta_estado";
        $stm = $c->prepare($sql);
        if ($estado != "") {
            $stm->execute([$estado]);
        } else {
            $stm->execute();
        }

        // Obtener los resultados
        $result = $stm->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $cn->desconecta();
        return $data;
    }


    public function verificarPosibilidadPrestamo($idPer)
    {
        $cn = new conexion();
        $c = $cn->conecta();
        $estado = null;
        #verificamos si el usuario a realizado algun prestamo
        $sql1 = "select * from tb_prestamo";
        $stm1 = $c->prepare($sql1);
        $stm1->execute();
        $result1 = $stm1->get_result();
        if ($row = $result1->fetch_array()) {
            #verificamos si el usuario tine algun prestamo con estado diferente a Finalizado
            $sql2 = "select estado from tb_prestamo where id_per=? and estado !='Finalizado'";
            $stm2 = $c->prepare($sql2);
            $stm2->bind_param("i", $idPer);
            $stm2->execute();
            if ($result2 = $stm2->get_result()) {
                if ($row = $result2->fetch_array())
                    $estado = $row[0];
            }
        }

        $cn->desconecta();
        return $estado;
    }

    public function agregarPrestamo($prestamo)
    {
        // Verificar que todos los campos del objeto $prestamo estén llenos
        if (
            empty($prestamo->getIdPer()) ||
            empty($prestamo->getIdLib()) ||
            empty($prestamo->getFecPre()) ||
            empty($prestamo->getHorPre()) ||
            empty($prestamo->getFecDev()) ||
            empty($prestamo->getHorDev()) ||
            empty($prestamo->getEstado())
        ) {

            // Manejo de error si algún campo está vacío
            echo "Error: Todos los campos deben estar llenos.";
            return false;
        }

        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "INSERT INTO tb_prestamo (id_per, id_lib, fec_pre, hor_pre, fec_dev, hor_dev, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stm = $c->prepare($sql);

        // Obtener los valores del objeto $prestamo
        $id_per = $prestamo->getIdPer();
        $id_lib = $prestamo->getIdLib();
        $fec_pre = $prestamo->getFecPre();
        $hor_pre = $prestamo->getHorPre();
        $fec_dev = $prestamo->getFecDev();
        $hor_dev = $prestamo->getHorDev();
        $estado = $prestamo->getEstado();

        // Vincular parámetros
        $stm->bind_param(
            "iisssss",
            $id_per,
            $id_lib,
            $fec_pre,
            $hor_pre,
            $fec_dev,
            $hor_dev,
            $estado
        );

        // Ejecutar la sentencia preparada
        $bool = $stm->execute();

        if ($bool === false) {
            // Manejo de error si la ejecución falla
            echo "Error al agregar el préstamo: " . $stm->error;
        } else {
            echo "Préstamo agregado correctamente.";
        }

        $stm->close();
        $cn->desconecta();

        return $bool;
    }



    public function actualizarEstado($id, $estado)
    {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "update tb_prestamo set estado=? where id_pre=?";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($estado, $id));
        if (!$bool) {
            echo "Error al actualizar el estado del prestamo";
        }
        $cn->desconecta();
    }
}
