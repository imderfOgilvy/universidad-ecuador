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
$avatar = null;

if(isset($_SESSION['user']['id']))
$id = $_SESSION['user']['id'];

$avatar = $app->getPhoto($id);

include('../src/layout/header.php');

    include("../src/pages/perfil.php");

include('../src/layout/footer.php');