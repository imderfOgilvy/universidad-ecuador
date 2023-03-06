<?php

include('../src/Session.php');
include('../src/App.php');
include('../src/Site.php');

$app = new App();

$site['title'] = 'Universidad Nestlé | Registro';


include('../src/layout/header.php');
    
    if(isset($_POST) && count($_POST)){
        $result = $app->registrar($_POST);
        //var_dump($result);
        
        if($result){
            include("../src/pages/registro_exitoso.php");
        }else{
            include("../src/pages/registro_fallido.php");
        }
    }else{
        include("../src/pages/registro.php");
    }

include('../src/layout/footer.php');