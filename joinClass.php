<?php
require_once "config.php";
class join{
    public PDO $connection ;
    public function __construct($connection) {
        $this-> connection = $connection ;
    }
public function equipename($tableName,$userId){
$resault = $this -> connection -> prepare("SELECT DISTINCT equipe.name FROM equipe INNER JOIN $tableName
              ON $tableName.id = $userId && equipe.id = $tableName.equipe_id") ;
$resault -> execute();
$data = $resault->fetchAll(PDO::FETCH_ASSOC);
return $data[0]["name"];}}
$joinClass = new join($connection);