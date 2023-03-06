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

$id = null;
$hasNotPerfectScore = true;

if(isset($_REQUEST['id']))
    $id = $_REQUEST['id'];
    
if(isset($_SESSION['user'])){
    $user_session = $_SESSION['user'];
    $perfil = $user_session['grupo'];
    $opt_in = $user_session['opt_in'];
}
    

if(isset($_SESSION['user']['id'])){
    $hasNotPerfectScore = $app::getLastChance($_SESSION['user']['id'], $id, 'normal');
}

//var_dump($hasNotPerfectScore);

$intento = $user['intentos'][$id]['normal'];

$recurso = $app->getRecursos($id);

include('../src/layout/header.php');

    include("../src/pages/modulo.php");

include('../src/layout/footer.php');