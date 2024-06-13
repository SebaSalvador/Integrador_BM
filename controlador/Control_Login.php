<?php
require_once "dao/DAO_Login.php";

class Control_Login
{
    private $dao;

    public function __construct()
    {
        $this->dao = new DAO_Login();
    }

    public function autenticarUsuario($user_id, $password_u)
    {
        // Validar entradas (opcional pero recomendado)
        if (empty($user_id) || empty($password_u)) {
            return "Los campos de usuario y contraseña no pueden estar vacíos.";
        }

        // Intentar autenticar al usuario utilizando el DAO
        $esValido = $this->dao->validarLogin($user_id, $password_u);

        return $esValido;
    }
}
?>

