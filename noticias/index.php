<?php
include('../src/Session.php');
include('../src/App.php');

$app = new App();

if(!$app::isLogged()){
    $login = $app->login();
}


$site['title'] = 'Universidad Nestlé | Noticias';


if(isset($_SESSION['user'])){
    $perfil = $_SESSION['user']['grupo'];
    
    $puntajes = $app->getRanking($perfil);
    
    //$app->formatDump($perfil);
}


include('../src/Site.php');

if(!$app::isLogged()){
    include('../src/layout/header.php');
        include("../src/pages/login.php");
    include('../src/layout/footer.php');
}else{
    include('../src/layout/header.php');
        include("../src/pages/noticias.php");
    include('../src/layout/footer.php');
}