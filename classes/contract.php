<?php
namespace APEX\classes;
use APEX\Trait\crud;
class contract {
   use crud ;
   public function create($connection,$joueur_id,$equipe_b,$resault){
       $operation = $connection->prepare("INSERT INTO contrat(joueur_id,equipe_id,montant)
             VALUES(:joueur_id,:equipe_id,:montant)");
            $operation->execute(array(
                ':joueur_id' => $joueur_id,
                ':equipe_id' => $equipe_b,
                ':montant' => $resault,
            ));
   }
}
$contratClass = new contract();