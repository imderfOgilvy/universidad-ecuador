<?php
include('../Session.php');
include('../App.php');
include('../Site.php');
header("Content-type: application/json; charset=utf-8");

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

        header("Location: " . $site['base_url'] . "/404/");
        die();
}


$app = new App();
$fn = null;


if(isset($_REQUEST['fn'])){
    $fn = $_REQUEST['fn'];
}

if($fn == null){

    echo json_encode([
        'status' => 'error', 
        'message' => 'Not method']);
    exit();
}

if($fn == 'login'){
    $login = $app->login();
    echo json_encode($login);
    exit();
}

if($fn == 'registrarPuntaje'){
    $usuario = null;
    $tipo = 'modulo';
    $puntaje = 0;
    $puntaje_final = 0;
    $intento = 0;
    $tiempo = 0;
    $puntaje_real = 0;
    $numero_aciertos = 0;
    
    if(isset($_REQUEST['usuario']))
        $usuario = $_REQUEST['usuario'];

    if($usuario == null && isset($_SESSION['user']['id']))
        $usuario = $_SESSION['user']['id'];

    if(isset($_REQUEST['tipo']))
        $tipo = $_REQUEST['tipo'];
    
    if(isset($_REQUEST['modulo']))
        $modulo = $_REQUEST['modulo'];

    if(isset($_REQUEST['tiempo']))
        $tiempo = $_REQUEST['tiempo'];

    if(isset($_POST['puntaje']))
        $puntaje = $_POST['puntaje'];

    if(isset($_POST['intento']))
        $intento = $_POST['intento'];

    if(isset($_POST['puntaje_real']))
        $puntaje_real = $_POST['puntajeReal'];

    if(isset($_POST['numeroAciertos']))
        $numero_aciertos = $_POST['numeroAciertos'];

    $puntajeTotal = 100;
    
    if($modulo == 7){
        $puntajeTotal = 75;
    }
    
    if($puntaje >= $puntajeTotal && $intento == 3){
        $puntaje_final = 100;
    }
    
    if($puntaje >= $puntajeTotal && $intento == 2){
        $puntaje_final = 80;
    }
    
    if($puntaje >= $puntajeTotal && $intento == 1){
        $puntaje_final = 60;
    }
        
    if($tipo == 'modulo'){
        return $app->saveResult($usuario, $modulo, $puntaje_final, $intento, 'normal', $tiempo, $puntaje, $numero_aciertos);
        // TODO Cambiar por registro en base de datos
    }

    if($tipo == 'puntos_extra'){
        return $app->saveResult($usuario, $modulo, $puntaje_final, $intento, 'extra', $tiempo, $puntaje, $numero_aciertos);
        // TODO Cambiar por registro en base de datos
    }

    echo json_encode(['status' => "success"]);
    exit();
}


if($fn == 'updatePhoto'){
    if(isset($_POST['imagen'])){
        $data = ['imagen' => $_POST['imagen']];
        $app->updatePhoto($_POST['id'], $data);
    }
}

if($fn == 'getNestleUser'){
    if(isset($_REQUEST['cedula'])){
        $app->getNestleUser($_REQUEST['cedula']);
    }
}