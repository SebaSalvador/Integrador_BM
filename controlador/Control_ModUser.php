<?php

require_once '../dao/DAO_Login.php';


function handleGetRequest() {
    
    $data = json_decode($string, true);
    //echo var_dump($data);
    if (isset($data['action'])) {
        switch ($data['action']) {
            case '':
                break;
            default:
                echo json_encode(['error' => 'Acción no reconocida']);
        }
    } else {
        echo json_encode(['error' => 'No se especificó ninguna acción']);
    }
}

function handlePostRequest() {
    
    $string = file_get_contents('php://input'); //solo para POST  y not available for enctype="multipart/form-data"
    //echo "Input: ".$string;
    $data = json_decode($string, true);
    //echo var_dump($data);
    if (isset($data['action'])) {
        switch ($data['action']) {
            case 'autenticar':
                autenticar();
                break;
            case 'traerUsuario':
                traerUsuario();
                break;
            default:
                echo json_encode(['error' => 'Acción no reconocida']);
        }
    } else {
        echo json_encode(['error' => 'No se especificó ninguna acción ']);
    }
}


function routeRequest() {
    $method = $_SERVER['REQUEST_METHOD'];
    
    switch ($method) {
        case 'GET':
            handleGetRequest();
            break;
        case 'POST':
            handlePostRequest();
            break;
        default:
            echo json_encode(['error' => 'Método HTTP no soportado']);
    }
}


function autenticar() {
    $string = file_get_contents('php://input');
    $data = json_decode($string, true);
    $email = $data['email'];
    $pass = $data['pass'];
    $daolog = new DAO_Login();
    $bool = $daolog->validarLogin($email, $pass);
    $jsonstring = json_encode($bool);
    
    echo $jsonstring; 
}

function traerUsuario() {
    $string = file_get_contents('php://input');
    //echo "Input: ".$string;
    $data = json_decode($string, true);
    $email = $data['email'];
    $pass = $data['pass'];
    $daolog = new DAO_Login();
    $array = $daolog->traerUsuario($email, $pass);
    $jsonstring = json_encode($array);
    echo $jsonstring; 
}

function saveData() {
    
    echo json_encode(['message' => 'Datos guardados correctamente']);
}


// Ejecutar la función de enrutamiento
routeRequest();
?>