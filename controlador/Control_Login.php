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

    public function registrarUsuarioC($dni, $nombre, $edad, $correo, $direccion, $telefono, $tipo_usuario, $contraseña, $estado)
    {
        // Intentar autenticar al usuario utilizando el DAO
        $esValido = $this->dao->registrarUsuario($dni, $nombre, $edad, $correo, $direccion, $telefono, $tipo_usuario, $contraseña, $estado);

        return $esValido;
    }

    public function traerUsuarioC($correo_u, $password_u)
    {
        // Intentar autenticar al usuario utilizando el DAO
        $data = $this->dao->traerUsuario($correo_u, $password_u);

        // Inicializar una lista vacía para almacenar los resultados
        $listaUsuarios = [];

        // Iterar sobre los datos obtenidos
        foreach ($data as $usuario) {
            // Agregar cada usuario a la lista
            $listaUsuarios[] = $usuario;
        }

        // Devolver la lista de usuarios
        return $listaUsuarios;
    }

}
?>

