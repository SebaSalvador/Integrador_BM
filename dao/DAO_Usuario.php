<?php
require_once "util/conexion.php";
require_once "modelo/Usuario.php";

class DAO_Usuario 
{
    var $cn;

    //agregar usuario (listo)
    //validar login (en DAO_Login)
    //loguear usuario (en DAO_Login)

    public function listarUsuarios() {
        
        $cn = new conexion();
        $c = $cn->conecta();
        $usuarios = array();
        $sql = "select tu.id_per, tu.id_tipo, tu.pass, tu.estado, tp.nom_ape,"+
        " tp.edad, tp.correo, tp.direccion, tp.telefono from tb_Persona as tp"+
        " inner join tb_Usuario as tu on tp.id_per=tu.id_per";
        if ($result = $c->query($sql)) {
            while ($row = $result->fetch_array()) {
                $usuario = new Usuario();
                $usuario->setIdPer($row[0]);
                $usuario->setIdTipo($row[1]);
                $usuario->setPass($row[2]);
                $usuario->setEstado($row[3]);
                $usuario->setNomApe($row[4]);
                $usuario->setEdad($row[5]);
                $usuario->setCorreo($row[6]);
                $usuario->setDireccion($row[7]);
                $usuario->setTelefono($row[8]);
                $usuarios[] = $usuario;
            }
        }
        $cn->desconecta();
        return $usuarios;
    }
    
    public function consultarUsuario($id) {
        $usuario = new Usuario();
        return $usuario;

    }

    public function consultarUsuarioPorTipo($id_tipo) {
        $usuarios = array();
        return $usuarios;

    }

    public function agregarUsuario($usuario) {

    }
    
    public function modificarUsuario($usuario) {

    }

    public function eliminarUsuario($id) {

    }

    public function actualizarEstado($id, $estado) {

    }

    public function cambiarPass($id, $pass) {

    }
    
} 

?>