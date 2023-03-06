<?php
/*
*
* Class Databse
*
*/


define("DB_HOST", "localhost");
define("DB_DATABASE", "husdyhmy_universidad");
define("DB_USER", "husdyhmy_universidad");
define("DB_PASS", "c}.*i+TdGg_C?=^-Hx%d1k9EYQ+jtSE6");
define("DB_PORT", "3306");


class Database{

    public function __construct(){}

    public static function getDB(){
        try {
            //code...
            $con = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_DATABASE, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $con;
        } catch (\Throwable $th) {
            return null;
            //throw $th;
        }
    }

}