<?php
require_once(__DIR__ . '/../dao/DAO_Observacion.php');
require_once(__DIR__ . '/../dao/DAO_Libro.php');
require_once(__DIR__ . '/../dao/DAO_Usuario.php');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        handleGetRequest();
        break;
    case 'POST':
        handlePostRequest();
        break;
    default:
        echo json_encode(['error' => 'Metodo HTTP no soportado']);
        break;
}

function handleGetRequest() {
    $action = $_GET['action'];
    
    if (isset($action)) {
        switch ($action) {
            case 'getUserData':
                getUserData();
                break;
            case 'getObs':
                getObservacion();
                break;
            case 'existeLib':
                existeLibro();
                break;
            case 'puedeInsObs':
                puedeInsertarObs();
                break;
            case 'listarlib':
                listarLibros();
                break;
            case 'consultarLib':
                consultarLibro();
                break;
            case 'consultarEst':
                consultarObsEstado();
                break;
            default:
                echo json_encode(['error' => 'Acción no soportada']);
                break;
        }
    } 
}

function handlePostRequest() {
    $action = $_POST['action'];

    if (isset($action)) {
        switch ($action) {
            case 'agregarObs':
                agregarObservacion();
                break;
            case 'actualizarEst':
                actualizarEstado();
                break;
            default:
                echo json_encode(['error' => 'Acción no soportada']);
                break;
        }
    } 


}

//Funciones GET
function getUserData() {
    $userId = $_GET['userId'];

    if (!empty($userId)) {
        $daoUsu = new DAO_Usuario();
        $array = $daoUsu->getUserData($userId);
        $json = array(
            'nomApe' => $array['nom_ape'],
            'rango' => $array['rango']
        );
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else {
        echo json_encode(['error' => 'El id de usuario esta vacio']);
    }
}

function getObservacion() {
    $daoObs = new DAO_Observacion();
    $array = $daoObs->listarObservaciones();
    $json = [];

    foreach($array as $obs) {
        if ($obs['estado'] != 'Recuperado') {
            $idLib = $obs['id_lib'];
            $daoLib = new DAO_Libro();
            $libro = $daoLib->consultarLibro($idLib);
            $titulo = $libro['titulo'];
            $jsonItem['id_obs'] = $obs['id_obs'];
            $jsonItem['titulo'] = $titulo;
            $jsonItem['razon'] = $obs['descripcion'];
            $jsonItem['fec_obs'] = $obs['fec_obs'];
            $jsonItem['fec_sol'] = $obs['fec_sol'];
            $jsonItem['estado'] = $obs['estado'];
            $json[] = $jsonItem;
        }
        
    }
    /*
    $response = array(
        ['id_obs' => '101', 'fec_obs' => '01/03/2024', 'titulo' => 'El principito', 'razon' => 'Manipulado', 'estado' => 'Inutilizable'],
        ['id_obs' => '102', 'fec_obs' => '23/04/2024', 'titulo' => 'El perfume', 'razon' => 'Extraviado', 'estado' => 'Recuperado']
    );
    */
    echo json_encode($json);
}

function existeLibro() {
    $idLib = $_GET['idLib'];
    $daoLib = new DAO_Libro();
    $resp = $daoLib->consultarLibro($idLib);
    if ($resp == null) {
        echo json_encode(['resp' => false]);
    } else {
        echo json_encode(['resp' => true]);
    }
}

function puedeInsertarObs() {
    $idLib = $_GET['idLib'];
    $daoObs = new DAO_Observacion();
    $resp = $daoObs->consultarObservacionPorLib($idLib);
    $num = 1;
    if (!empty($resp)) {
        foreach($resp as $obs) {
            if ($obs['estado'] == 'Inutilizable' || $obs['estado'] == 'En solucion') {
                $num = -1;
            }       
        }

        if ($num<0)
            echo json_encode(['resp' => false]);
        else
            echo json_encode(['resp' => true]);

    } else {
        echo json_encode(['resp' => true]);
    }

}

function listarLibros() {
    $daoLib = new DAO_Libro();
    $array = $daoLib->listarLibrosAsoc();
    echo json_encode($array);
}

function consultarLibro() {
    $idLib = (int)$_GET['idLib'];
    $daoObs = new DAO_Observacion();
    $array = $daoObs->consultarObservacionPorLib($idLib);
    $json = [];

    foreach($array as $obs) {
            $idLib = $obs['id_lib'];
            $daoLib = new DAO_Libro();
            $libro = $daoLib->consultarLibro($idLib);
            $titulo = $libro['titulo'];
            $jsonItem['id_obs'] = $obs['id_obs'];
            $jsonItem['titulo'] = $titulo;
            $jsonItem['razon'] = $obs['descripcion'];
            $jsonItem['fec_obs'] = $obs['fec_obs'];
            $jsonItem['fec_sol'] = $obs['fec_sol'];
            $jsonItem['estado'] = $obs['estado'];
            $json[] = $jsonItem;
    }
    echo json_encode($json);
}

function consultarObsEstado() {
    $estado = $_GET['estado'];
    $daoObs = new DAO_Observacion();
    $array = $daoObs->listarObservaciones();
    $json = [];
    foreach($array as $obs) {
        $idLib = $obs['id_lib'];
        $daoLib = new DAO_Libro();
        $libro = $daoLib->consultarLibro($idLib);
        $titulo = $libro['titulo'];
        $jsonItem['id_obs'] = $obs['id_obs'];
        $jsonItem['titulo'] = $titulo;
        $jsonItem['razon'] = $obs['descripcion'];
        $jsonItem['fec_obs'] = $obs['fec_obs'];
        $jsonItem['fec_sol'] = $obs['fec_sol'];
        $jsonItem['estado'] = $obs['estado'];
        
        if ($estado == "No Recuperado") {
            if($jsonItem['estado'] != 'Recuperado') {
                $json[] = $jsonItem;
            }
        } else {
            if ($jsonItem['estado'] == $estado) {
                $json[] = $jsonItem;
            }  
        }  
    }
    echo json_encode($json);
}

//Funciones POST
function agregarObservacion() {
    $fecAct = $_POST['fecAct'];
    $idLib = $_POST['idLibro'];
    $razon = $_POST['razon'];
    $array = ['id_lib' => $idLib, 'descripcion' => $razon, 'fec_obs' => $fecAct];
    $daoObs = new DAO_Observacion();
    $daoObs->agregarObservacion($array);
    //actualizar estado de libro a No disponible
    $daoLib = new DAO_Libro();
    $daoLib->actualizarEstado($idLib, 0);

    echo json_encode($array);
}

function actualizarEstado() {
    $estado = $_POST['estado'];
    $idObs = $_POST['idObs'];
    
    if ($estado == 'Ensolucion') 
        $estado = "En solucion";
    $daoObs = new DAO_Observacion();
    $daoObs->actualizarEstado($idObs, $estado);
    
    if ($estado == "Recuperado") {
        $fecha_actual = date("Y-m-d");
        $daoObs->actualizarFecSol($idObs, $fecha_actual);
        //$daoLib = new DAO_Libro();
        //$daoLib->actualizarEstado() actualizar libro a disponible
    }
        
    echo "Datos enviados correctamente";
}

/*
$userId = $_GET['userId'];

if (!empty($userId)) {
    $daoUsu = new DAO_Usuario();
    $array = $daoUsu->getUserData($userId);
    $json = array(
        'nomApe' => $array['nom_ape'],
        'rango' => $array['rango']
    );
    $jsonstring = json_encode($json);
    echo $jsonstring;
} else {
    echo json_encode(['error' => 'El id de usuario esta vacio']);
}

$action = $_GET['action'];

if ($action == 'getObs') {
    $response = array(
                    ['id_obs' => '101', 'fec_obs' => '01/03/2024', 'titulo' => 'El principito', 'razon' => 'Manipulado'],
                    ['id_obs' => '102', 'fec_obs' => '23/04/2024', 'titulo' => 'El perfume', 'razon' => 'Extraviado']
                );
    echo json_encode($response);
}
*/
?>