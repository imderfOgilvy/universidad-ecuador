<?php
include('Route.php');

// Add base route (startpage)
// Route::add('/',function(){
//     global $app;
//     global $site;
    
//     if(!$app::isLogged()){
//         include("pages/login.php");
//         return false;    
//     }else{
//         include("pages/home.php");
//     }   

// });

// // Page Login
// Route::add('/login/',function(){
//     global $app;
//     global $site;
    
//     include("pages/login.php");
// });

// // Page Registro
// Route::add('/registro/',function(){
//     global $app;
//     global $site;
    
//     include("pages/registro.php");
// });

// // Function for not Fount Page
// Route::pathNotFound(function(){
//     echo 'Lo sentimos, no encontramos lo que está buscando.';
// });

// // Function for not Allowed Method
// Route::methodNotAllowed(function(){
//     echo 'Lo sentimos, no encontramos lo que está buscando.';
// });