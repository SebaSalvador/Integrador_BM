<?php

require_once "dao/DAO_Usuario.php";
require_once "dao/DAO_Categoria.php";
require_once "dao/DAO_Libro.php";


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

        public function getAutores() {
            $dao = new DAO_Libro();
            $data = $dao->listarAutores();
            // Inicializar una lista vacía para almacenar los resultados
            $listaAutores = [];
            // Iterar sobre los datos obtenidos
            foreach ($data as $autor) { // Asegúrate de usar $dataC correctamente
                // Agregar cada categoria a la lista
                $listaAutores[] = $autor;
            }
            return $listaAutores;


        }

        public function getLibros() {
            $dao = new DAO_Libro();
            $data = $dao->listarLibros();
            // Inicializar una lista vacía para almacenar los resultados
            $listaLibros = [];
            // Iterar sobre los datos obtenidos
            foreach ($data as $libro) { // Asegúrate de usar $dataC correctamente
                // Agregar cada categoria a la lista
                $listaLibros[] = $libro;
            }
            return $listaLibros;
        }

        public function colorEstado($idEst) {
            $color = "";
            switch ($idEst) {
                case 0: $color = "text-danger"; break;
                case 1: $color = "text-success"; break;
                default: $color = "text-warning"; break;
            }
            return $color;
        }

        public function getLibroDetalle($id) {
            $dao = new DAO_Libro();
            $libro = $dao->consultarLibro($id);
            return $libro;
        }

        public function obtenertodosEmpleados() {
            $dao = new DAO_Usuario();

            // Agregar el préstamo usando el DAO
            $res = $dao->obtenertodosEmpleadosDAO();

            return $res;
        }

    }

?>