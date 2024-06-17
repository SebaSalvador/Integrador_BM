<?php

require_once "dao/DAO_Usuario.php";
require_once "dao/DAO_Libro.php";
require_once "dao/DAO_Categoria.php";


    class Control_ClienteMain
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

        public function getCategorias() {
            $daoC = new DAO_Categoria();
            $dataC = $daoC->listarCategorias();
            // Inicializar una lista vacía para almacenar los resultados
            $listaDataCategorias = [];
            // Iterar sobre los datos obtenidos
            foreach ($dataC as $datacategoria) { // Asegúrate de usar $dataC correctamente
                // Agregar cada categoria a la lista
                $listaDataCategorias[] = $datacategoria;
            }
            return $listaDataCategorias;
        }

        


    }

?>