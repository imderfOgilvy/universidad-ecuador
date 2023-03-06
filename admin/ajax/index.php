<?php
session_start();

if(!isset($_SESSION['admin']['user'])){
    echo json_encode(["Bad request error."]);
    exit();
}

if(isset($_SESSION['admin']['user'])){
    
require("../../src/Database.php");
require("../../src/Admin.php");

$admin = new Admin();
$fn = null;

$post = file_get_contents('php://input');
$data = json_decode($post, true);

if(isset($data['fn'])){
    $fn = $data['fn'];
}else{
    echo json_encode(["Bad function error."]);
    exit();
}

if($fn == 'getUser'){
    $cedula = null;
    if(isset($data['cedula'])){
        $cedula = $data['cedula'];
    }else{
        echo json_encode(["result" => null]);
        exit();
    }
    $usuario = $admin->getUser($cedula);
    
    echo json_encode(["result" => $usuario]);
}

if($fn == 'updateIntentos'){
    if(isset($data['id']) && intval($data['intentos']) >= 0){
        $intentos = $admin->updateIntentos($data['id'], $data['intentos']);
        echo json_encode(["result" => $intentos, "message" => "updated"]);
        exit();
    }else{
        echo json_encode(["result" => null, "message" => "no values"]);
        exit();
    }
    
    echo json_encode(["result" => null, "message" => "unknow error"]);
}

}