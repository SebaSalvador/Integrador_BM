<?php
require_once(__DIR__ . '/../util/conexion.php');
require_once(__DIR__ . '/../modelo/Usuario.php');

class DAO_Usuario 
{
    var $cn;

    //agregar usuario (listo)
    //validar login (en DAO_Login)
    //loguear usuario (en DAO_Login)

    public function getUserData($user_id) {
        $cn = new conexion();
        $sql = "select tp.nom_ape, tt.rango from tb_persona tp inner join tb_usuario tu on tu.id_per =tp.id_per inner join tb_tipousuario tt on tu.id_tipo =tt.id_tipo where tp.id_per = $user_id";
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

    public function listarUsuarios() {
        
        $cn = new conexion();
        $c = $cn->conecta();
        $usuarios = array();
        $sql = "select tu.id_per, tu.id_tipo, tu.pass, tu.estado, tp.nom_ape,".
        " tp.edad, tp.correo, tp.direccion, tp.telefono from tb_Persona as tp".
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
        $cn = new conexion();
        $c = $cn->conecta();
        $usuario = new Usuario();
        $sql = "select tu.id_per, tu.id_tipo, tu.pass, tu.estado, tp.nom_ape,".
        " tp.edad, tp.correo, tp.direccion, tp.telefono from tb_Persona as tp".
        " inner join tb_Usuario as tu on tp.id_per=tu.id_per where id_per=?";
        $stm = $c->prepare($sql);
        $stm->execute(array($id));
        $result = $stm->get_result();
        if ($row = $result->fetch_array()) {
            $usuario->setIdPer($row[0]);
            $usuario->setIdTipo($row[1]);
            $usuario->setPass($row[2]);
            $usuario->setEstado($row[3]);
            $usuario->setNomApe($row[4]);
            $usuario->setEdad($row[5]);
            $usuario->setCorreo($row[6]);
            $usuario->setDireccion($row[7]);
            $usuario->setTelefono($row[8]);
        }
        $cn->desconecta();
        return $usuario;

    }

    public function consultarUsuarioPorTipo($id_tipo) {
        
        $cn = new conexion();
        $c = $cn->conecta();
        $usuarios = array();
        $sql = "select tu.id_per, tu.id_tipo, tu.pass, tu.estado, tp.nom_ape,".
        " tp.edad, tp.correo, tp.direccion, tp.telefono from tb_Persona as tp".
        " inner join tb_Usuario as tu on tp.id_per=tu.id_per where id_tipo=?";
        $stm = $c->prepare($sql);
        $stm->execute(array($id_tipo));
        if ($result = $stm->get_result()) {
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

    public function agregarUsuario($usuario) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql1 = "insert into tb_persona values (?, ?, ?, ?, ?, ?)";
        $stm1 = $c->prepare($sql1);
        $bool1 = $stm1->execute(array($usuario->getIdPer(),$usuario->getNomApe(),$usuario->getEdad(),
                $usuario->getCorreo(),$usuario->getDireccion(),$usuario->getTelefono()));

        $sql2 = "insert into tb_usuario values (?, ?, ?, ?)";
        $stm2 = $c->prepare($sql2);
        $bool2 = $stm2->execute(array($usuario->getIdPer(),
        $usuario->getIdTipo(),$usuario->getPass(),$usuario->getEstado()));
        
        if (!$bool1 || !$bool2) {
            echo "Error al agregar usuario";
        }
        $cn->desconecta();
    }
    
    public function modificarUsuario($usuario) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "update tb_Persona set nom_ape=?, edad=?, correo=?, direccion=?, telefono=? where id_per=?";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($usuario->getNomApe(),$usuario->getEdad(),$usuario->getCorreo(),$usuario->getDireccion(),$usuario->getTelefono(),$usuario->getIdPer()));
        if (!$bool) {
            echo "Error al modificar usuario";
        }
        $cn->desconecta();
    }

    public function eliminarUsuario($id) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql1 = "delete from tb_usuario where id_per=?";
        $stm1 = $c->prepare($sql1);
        $bool1 = $stm1->execute(array($id));

        $sql2 = "delete from tb_persona where id_per=?";
        $stm2 = $c->prepare($sql2);
        $bool2 = $stm2->execute(array($id));

        if (!$bool1 || !$bool2) {
            echo "Error al eliminar usuario";
        }
        $cn->desconecta();
    }

    public function actualizarEstado($id, $estado) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "update tb_Usuario set estado=? where id_per=?";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($estado, $id));
        if (!$bool) {
            echo "Error al actualizar el estado del usuario";
        }
        $cn->desconecta();
    }

    public function cambiarPass($id, $pass) {
        $cn = new conexion();
        $c = $cn->conecta();
        $sql = "update tb_Usuario set pass=? where id_per=?";
        $stm = $c->prepare($sql);
        $bool = $stm->execute(array($pass, $id));
        if (!$bool) {
            echo "Error al cambiar la contraseña";
        }
        $cn->desconecta();
    }
    
} 

?>