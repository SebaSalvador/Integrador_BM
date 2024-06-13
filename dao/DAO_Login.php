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

}
?>