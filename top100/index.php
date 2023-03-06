<?php

include('../src/Session.php');
include('../src/App.php');
include('../src/Site.php');

$app = new App();

if(!$app::isLogged()){
    header("Location: " . $site['base_url'] . "/");
    die();
}


$site['title'] = 'Universidad Nestlé | Mi Puntaje';

if(isset($_SESSION['user'])){
    $perfil = $_SESSION['user']['grupo'];
    $user_session = $_SESSION['user'];
}


include('../src/layout/header.php');

    include("../src/pages/top100.php"); 

include('../src/layout/footer.php');