<?php

include('../src/Session.php');
include('../src/App.php');
include('../src/Admin.php');
include('../src/Site.php');

$admin = new Admin();

$username = '';
$password = '';
$status = null;
$stat = null;


if(isset($_REQUEST['status'])){
    $status = $_REQUEST['status'];
}

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];   
    $password = $_POST['password'];
    $login = $admin->login($username, $password);
    
    //var_dump($login);
    
    if($login == true){
        header("Location: /admin/");
    }else{
        header("Location: /admin/?status=error");
    }
}

if(!$admin->isLogged()){
    include('../src/pages/admin/layout/header.php');
        include("../src/pages/admin/login.php");
    include('../src/pages/admin/layout/footer.php');
    die();
}else{
    
    if(isset($_REQUEST['page'])){
        if($_REQUEST['page'] == 'search'){
            $cedula = $_REQUEST['cedula'];
            
            $stat['datos'] = $admin->getUserByCedula($cedula);
            include('../src/pages/admin/layout/header.php');
                include("../src/pages/admin/search.php");
            include('../src/pages/admin/layout/footer.php');
            die();
        }
        
    }
    
    // GENERAL
        /*$stat['general']['participaciones'] = $admin->getParticipaciones();
        $stat['general']['participantes'] = $admin->getParticipantes();
        $stat['general']['puntajes'] = $admin->getPuntajes();
        
        //var_dump($stat['general']['puntajes']);
        
        
        // MODULO 1 NORMAL
        $stat['modulo'][1]['normal']['participaciones'] = $admin->getParticipaciones(1, 'normal');
        $stat['modulo'][1]['normal']['participantes'] = $admin->getParticipantes(1, 'normal');
        
        $stat['modulo'][1]['normal']['puntaje']['100'] = $admin->getParticipaciones(1, 'normal', 100);
        $stat['modulo'][1]['normal']['puntaje']['80'] = $admin->getParticipaciones(1, 'normal', 80);
        $stat['modulo'][1]['normal']['puntaje']['60'] = $admin->getParticipaciones(1, 'normal', 60);
        
        
        // MODULO 1 EXTRA
        $stat['modulo'][1]['extra']['participaciones'] = $admin->getParticipaciones(1, 'extra');
        $stat['modulo'][1]['extra']['participantes'] = $admin->getParticipantes(1, 'extra');
        
        $stat['modulo'][1]['extra']['puntaje']['100'] = $admin->getParticipaciones(1, 'extra', 100);
        $stat['modulo'][1]['extra']['puntaje']['80'] = $admin->getParticipaciones(1, 'extra', 80);
        $stat['modulo'][1]['extra']['puntaje']['60'] = $admin->getParticipaciones(1, 'extra', 60);*/
    
    // RATING
    /*$stat['rating'] = $admin->getRating();*/

    
    $grupos = [
        "CDT",
        "Distribuidora",
        "Fuerza de Ventas DSD",
        "Mercaderistas",
        "Nestle",
        "Representante De Ventas",
        "Staff Comercial",
        "Zonales / KAM"
    ];
    
    /*foreach($grupos as $k => $v){
        
        // strip out all whitespace
        $tmp = str_replace("/", "", trim($v));
        $tmp = str_replace("  ", " ", trim($tmp));
        $_grupo = str_replace(" ", "-", trim($tmp));
        $grupo = strtolower($_grupo);
        
        
        $stat['puntaje'][$grupo]['nombre'] = $v;
        $stat['puntaje'][$grupo]['puntajes'] = $admin->getPuntajes($v);
    }*/
    
    
    // echo "<pre>";
    // print_r($stat['puntaje']);
    // echo "</pre>";    
    
    include('../src/pages/admin/layout/header.php');
        include("../src/pages/admin/dashboard.php");
    include('../src/pages/admin/layout/footer.php');
    die();
    
    
}
