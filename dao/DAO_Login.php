<?php
require_once "util/conexion.php";

class DAO_Login
{
    // LOGIN DE USUARIO
    function validarLogin($user_id, $password_u)
    {
        $cn = new conexion();
        $sql = "SELECT validarLogin('$user_id', '$password_u') AS resultado";
        $res = mysqli_query($cn->conecta(), $sql) or die(mysqli_error($cn->conecta()));
        $row = mysqli_fetch_assoc($res);
        $resultado = $row['resultado'];
        return $resultado === '1';
    }

    function registrarUsuario($dni, $nombre, $edad, $correo, $direccion, $telefono, $tipo_usuario, $contraseña, $estado)
    {
        $cn = new conexion();
        $sql = "CALL registrarUsuario('$dni', '$nombre', '$edad', '$correo', '$direccion', '$telefono', '$tipo_usuario', '$contraseña', '$estado')";
        
        // Ejecutar la consulta
        $res = mysqli_query($cn->conecta(), $sql);
        
        if (!$res) {
            // Si hay un error en la consulta, manejarlo adecuadamente
            die('Error al ejecutar la consulta: ' . mysqli_error($cn->conecta()));
        }
        
        // Verificar si el procedimiento almacenado afectó alguna fila (por ejemplo, INSERT, UPDATE, DELETE)
        if (mysqli_affected_rows($cn->conecta()) > 0) {
            return "Usuario registrado correctamente.";
        } else {
            return "Hubo un problema al registrar el usuario.";
        }
    }

    //TRAER USUARIO
    function traerUsuario($correo_u, $password_u)
    {
        $cn = new conexion();
        $sql = "CALL traerUsuario('$correo_u', '$password_u')";
        $res = mysqli_query($cn->conecta(), $sql);
        if (!$res) {
            // Si hay un error en la consulta, manejarlo adecuadamente
            die('Error al ejecutar la consulta: ' . mysqli_error($cn->conecta()));
        }
        
        // Verificar si se encontró un usuario válido
        if (mysqli_num_rows($res) > 0) {
            // Obtener los datos del usuario
            $usuario = mysqli_fetch_assoc($res);
            // Liberar el resultado
            mysqli_free_result($res);
            // Devolver los datos del usuario encontrado
            return $usuario;
        } else {
            // Si no se encontró ningún usuario válido, devolver null o false
            return null; // o false, dependiendo de tu preferencia
        }
    }



}
?>