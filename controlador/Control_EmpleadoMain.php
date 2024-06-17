<?php

require_once "dao/DAO_Usuario.php";


    class Control_EmpleadoMain
    {
        public function getUserDataC($user_id)
        {
            $dao = new DAO_Usuario();
            $data = $dao->getUserData($user_id);
            // Inicializar una lista vacía para almacenar los resultados
            $listaDataUsuarios = [];

            // Iterar sobre los datos obtenidos
            foreach ($data as $datausuario) {
                // Agregar cada usuario a la lista
                $listaDataUsuarios[] = $datausuario;
            }

            return $listaDataUsuarios;
            
        }

        public function getLibros()
        {
            
        }


    }

?>