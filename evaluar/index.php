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

$modulo = null;
$rating = null;
$intentos = 0;
$usuario = 0;

if(isset($_REQUEST['modulo']))
    $modulo = $_REQUEST['modulo'];

if(isset($_SESSION['user']['id']))
    $usuario = $_SESSION['user']['id'];


if( isset($_POST['rating']) && !$app->isRated($usuario, $modulo)){
    
    $ratingA = 0;
    $ratingB = 0;
    $ratingC = 0;

    if(isset($_POST['ratingA'])) $ratingA = $_POST['ratingA'];
    if(isset($_POST['ratingB'])) $ratingB = $_POST['ratingB'];
    if(isset($_POST['ratingC'])) $ratingC = $_POST['ratingC'];

    $app->rating($usuario, $modulo, "{" . $ratingA . "," . $ratingB . "," . $ratingC . "}");
}

include('../src/layout/header.php');
    
    include("../src/pages/evaluar.php");


include('../src/layout/footer.php');