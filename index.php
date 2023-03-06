<?php
include('src/Session.php');
include('src/App.php');

$app = new App();

if(!$app::isLogged()){
    $login = $app->login();
}




$site['title'] = 'Universidad Nestlé | Inicio';

if(isset($_SESSION['user'])){
    $user_session = $_SESSION['user'];
    $perfil = $user_session['grupo'];
    $opt_in = $user_session['opt_in'];
    
    // if($perfil !== ''){
    //     $puntajes = $app->getPuntajes($perfil);
    // }
}


include('src/Site.php');

//echo $app::isLogged();


//include("src/pages/mantenimiento.php");

//exit();


if(!$app::isLogged()){
    include('src/layout/header.php');
        include("src/pages/login.php");
    include('src/layout/footer.php');
}else{
    include('src/layout/header.php');
        include("src/pages/home.php");
    include('src/layout/footer.php');
}