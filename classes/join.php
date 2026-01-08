<?php
namespace APEX\classes;
use  APEX\classes\dataBase ;
use PDO ;

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
return $data[0]["name"];}
public function allTeamPlayers($id){
   $resault = $this -> connection -> prepare("SELECT DISTINCT joueur.name ,joueur.email,joueur.role FROM joueur INNER JOIN equipe
              ON joueur.equipe_id = $id") ;
$resault -> execute();
$data = $resault->fetchAll(PDO::FETCH_ASSOC);
return $data ;
}



}
$joinClass = new join($connection);