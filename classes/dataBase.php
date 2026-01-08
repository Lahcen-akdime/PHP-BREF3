<?php
namespace APEX\classes;
session_start();
use PDO ;
class dataBase{
static private $connection = null ; 
// static private PDO $connection = null ;
static function getconnection():PDO{
    if(is_null(SELF::$connection)){
        SELF::$connection = new PDO("mysql:host=localhost;dbname=apex;
        port=3307;charset=utf8mb4",'root','');
    }
    return SELF::$connection ;
}
}
$database = new dataBase() ;
$connection = $database->getconnection() ;









