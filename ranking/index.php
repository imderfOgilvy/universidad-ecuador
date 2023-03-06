<?php
include('../src/Session.php');
include('../src/App.php');

$app = new App();

if(!$app::isLogged()){
    $login = $app->login();
}

$rankingAdministrativos = array(

1 => array(
  array("posicion" => 1, "nombre" => "Steven Estuardo Paguay Lopez", "normal" => 100, "extra" => 100),
  array("posicion" => 2, "nombre" => "Segundo Vinicio Cabascango Inlago", "normal" => 100, "extra" => 100),
  array("posicion" => 3, "nombre" => "Gonzalo Fernando Acosta Guamaninga", "normal" => 100, "extra" => 100),
  array("posicion" => 4, "nombre" => "Jhonatan Vinicio Teran Andrade", "normal" => 100, "extra" => 100),
  array("posicion" => 5, "nombre" => "Lorena Estefania Sisalema Toledo", "normal" => 100, "extra" => 100),
  array("posicion" => 6, "nombre" => "Wilson Fernando Arias", "normal" => 100, "extra" => 100),
  array("posicion" => 7, "nombre" => "Lucia Raquel Yandun Patiño", "normal" => 100, "extra" => 100),
  array("posicion" => 8, "nombre" => "Estefania Alexandra Tello Maila", "normal" => 100, "extra" => 100),
  array("posicion" => 9, "nombre" => "Lorena Catalina Villalba Miranda", "normal" => 100, "extra" => 100),
  array("posicion" => 10, "nombre" => "Lizeth Peña Suarez", "normal" => 100, "extra" => 100),
),
2 => array(
  array("posicion" => 1, "nombre" => "Dennys Fernando Maldonado Guaman", "normal" => 100, "extra" => 100),
  array("posicion" => 2, "nombre" => "Ana Patricia Folleco Padilla", "normal" => 100, "extra" => 100),
  array("posicion" => 3, "nombre" => "Luis Daniel Machado Rodriguez", "normal" => 100, "extra" => 100),
  array("posicion" => 4, "nombre" => "Nancy Victoria Rosero Valdiviezo", "normal" => 100, "extra" => 100),
  array("posicion" => 5, "nombre" => "Marco Guillermo Tapia Mena", "normal" => 100, "extra" => 100),
  array("posicion" => 6, "nombre" => "Ronny Vicente Cotto Calderon", "normal" => 100, "extra" => 100),
  array("posicion" => 7, "nombre" => "Maria Auxiliadora Ludeña Moreira", "normal" => 100, "extra" => 100),
  array("posicion" => 8, "nombre" => "Camila Andrea Loaiza Torres", "normal" => 100, "extra" => 100),
  array("posicion" => 9, "nombre" => "Ricardo Alejandro Arguello Ochoa", "normal" => 100, "extra" => 100),
  array("posicion" => 10, "nombre" => "Camila Alejandra Paz Neumane", "normal" => 100, "extra" => 100),
),
3 => array(
  array("posicion" => 1, "nombre" => "Jhonatan Vinicio Teran Andrade", "normal" => 100, "extra" => 100),
  array("posicion" => 2, "nombre" => "Lia Nathaly Lopez Castillo", "normal" => 100, "extra" => 100),
  array("posicion" => 3, "nombre" => "Luis Daniel Machado Rodriguez", "normal" => 100, "extra" => 100),
  array("posicion" => 4, "nombre" => "Lucia Raquel Yandun Patiño", "normal" => 100, "extra" => 100),
  array("posicion" => 5, "nombre" => "Jose Miguel Abreu Hernandez", "normal" => 100, "extra" => 100),
  array("posicion" => 6, "nombre" => "Guillermo Jose Paz Castillo", "normal" => 100, "extra" => 100),
  array("posicion" => 7, "nombre" => "Maria Auxiliadora Ludeña Moreira", "normal" => 100, "extra" => 100),
  array("posicion" => 8, "nombre" => "Ana Maria Lomas Beltran", "normal" => 100, "extra" => 100),
  array("posicion" => 9, "nombre" => "Maria Fernanda Aguiñaga Martillo", "normal" => 100, "extra" => 100),
  array("posicion" => 10, "nombre" => "Ricardo Alejandro Arguello Ochoa", "normal" => 100, "extra" => 100),
),
4 => array(
  array("posicion" => 1, "nombre" => "Luis Daniel Machado Rodriguez", "normal" => 100, "extra" => 100),
  array("posicion" => 2, "nombre" => "Marcela Johanna Cabezas Molina", "normal" => 100, "extra" => 100),
  array("posicion" => 3, "nombre" => "Steven Estuardo Paguay Lopez", "normal" => 100, "extra" => 100),
  array("posicion" => 4, "nombre" => "Jonathan Dario Conde Vega", "normal" => 100, "extra" => 100),
  array("posicion" => 5, "nombre" => "Ana Maria Lomas Beltran", "normal" => 100, "extra" => 100),
  array("posicion" => 6, "nombre" => "Jose Miguel Abreu Hernandez", "normal" => 100, "extra" => 100),
  array("posicion" => 7, "nombre" => "Camila Andrea Loaiza Torres", "normal" => 100, "extra" => 100),
  array("posicion" => 8, "nombre" => "Cristina Elizabeth Cerda Ocaña", "normal" => 100, "extra" => 100),
  array("posicion" => 9, "nombre" => "Monica Cristina Arroba Narvaez", "normal" => 100, "extra" => 100),
  array("posicion" => 10, "nombre" => "Luis Alberto Pintado Lopez", "normal" => 100, "extra" => 100),
),
);


$site['title'] = 'Universidad Nestlé | Noticias';
$modulo = 1;

if(isset($_SESSION['user'])){
    $perfil = $_SESSION['user']['grupo'];
    $cargo = $_SESSION['user']['cargo'];
    
    $puntajes = $app->getRankingByModule($perfil, $_GET['id'], $cargo);
    
    /*$app->formatDump($perfil);
    $app->formatDump($_GET['id']);
    $app->formatDump($cargo);*/
}

if(isset($_GET['id'])){
    $modulo = $_GET['id'];
}


include('../src/Site.php');

if(!$app::isLogged()){
    include('../src/layout/header.php');
        include("../src/pages/login.php");
    include('../src/layout/footer.php');
}else{
    include('../src/layout/header.php');
        include("../src/pages/ranking.php");
    include('../src/layout/footer.php');
}