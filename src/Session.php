<?php
ini_set('session.cookie_samesite', 'None');
ini_set('session.cookie_lifetime', 0 );
ini_set('session.cookie_secure', 1 );
session_cache_limiter('nocache');
if(session_status() == PHP_SESSION_NONE){
    header('P3P: CP="CAO PSA OUR"');
    session_start();
}