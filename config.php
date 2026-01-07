<?php
session_start();

class dataBase{
static private $connection = null ; 
// static private PDO $connection = null ;
static function getconnection():PDO{
    if(is_null(SELF::$connection)){
        SELF::$connection = new PDO("mysql:host=localhost;dbname=apex;
        port=3307;charset=utf8mb4",'root','');
        // echo "hi";
    }
    return SELF::$connection ;
}
}
$database = new dataBase() ;
$connection = $database->getconnection() ;









