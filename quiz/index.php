<?php

include('../src/Session.php');
include('../src/App.php');
include('../src/Site.php');

$app = new App();

if(!$app::isLogged()){
    header("Location: " . $site['base_url'] . "/");
    die();
}


$site['title'] = 'Universidad Nestlé | Mi Perfil';

//VARIABLES
$tipo = 'modulo';
$modulo = null;
$usuario = null;
$intento = 0;
$intentos = 0;
$state = 'check';
$typeName = null;

$hasNotPerfectScore = true;

//VERIFICACION POST
if(isset($_REQUEST['tipo']))
    $tipo = $_REQUEST['tipo'];

if(isset($_REQUEST['modulo']))
    $modulo = $_REQUEST['modulo'];
    
if(isset($_REQUEST['state']))
    $state = $_REQUEST['state'];



//REGISTRO DE TIPOS
if($tipo == 'modulo')
    $typeName = 'normal';
if($tipo == 'puntos_extra')
    $typeName = 'extra';


if(isset($_SESSION['user']['id'])){
    $usuario = $_SESSION['user']['id'];
    $perfil = $_SESSION['user']['grupo'];
    $hasNotPerfectScore = $app::getLastChance($usuario, $modulo, $typeName);
}

//var_dump($hasNotPerfectScore);

//VERIFICAION DE SESSION
if(isset($user['intentos'][$modulo][$typeName]))
    $intento = $user['intentos'][$modulo][$typeName];

//NORMALIZANDO INTENTOS
$intentos = $intento - 1;

//OBTENIENDO PREGUNTAS
$setPreguntas = $app::getPreguntas($modulo, $tipo, $perfil);

//var_dump($modulo, $tipo, $perfil);

include('../src/layout/header.php');


    if($state == 'check'){
        if($hasNotPerfectScore){
            include("../src/pages/check_quiz.php");
        }else{
            include("../src/pages/conpuntaje.php");
        }
    }

    if($state == 'ready'){

        if($intento > 0){
            $app->restarIntento($usuario,$modulo,$typeName,$intento);
            include("../src/pages/quiz.php");
        }else{
            include("../src/pages/cerointentos.php");
        }
        

    }

include('../src/layout/footer.php');