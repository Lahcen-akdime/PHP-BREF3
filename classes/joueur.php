<?php
namespace APEX\classes;
use APEX\classes\FinancialEngine;
use APEX\classes\dataBase;
use APEX\classes\person;
use APEX\classes\contract;
use APEX\Trait\search;
use PDO ;

class joueur extends Person
{
    private static int $P_signature = 1000000;
    private string $role;
    private int $ValeurMarcher;
    private int $contratid;
    private $Joueur;
    private $EquipeA;
    private $EquipeB;
    public function getAnnualCost($Userid,$connection)
    {
        $resault = $connection -> prepare("SELECT valeur_m FROM joueur WHERE id = :id");
        $resault->execute([':id'=>$Userid]);
        $data = $resault -> fetchAll(PDO::FETCH_NUM);
        $valeur_m = $data[0][0] ;
         return ($valeur_m * 5) + self::$P_signature ;
    }
    public function create($name, $role, $email, $nationalite, $valeur_m, $equipe_id, $connection)
    {
        $this -> nationalite = $nationalite ;
        try {
            $connection -> beginTransaction();
            $opperation = $connection->prepare("INSERT INTO joueur (name,role,email,nationalite,valeur_m,equipe_id)
                                      VALUES (:name,:role,:email,:nationalite,:valeur_m,:equipe_id)");
            $opperation -> execute(array(
                ":name" => $name,
                ":role" => $role,
                ":email" => $email,
                ":nationalite" => $this -> nationalite,
                ':valeur_m'=> $valeur_m,
                ':equipe_id' => intval($equipe_id)
            ));
            $selectid = $connection -> query("SELECT id FROM joueur WHERE name = '$name' AND email = '$email'") ;  
            $id = $selectid -> fetchAll(PDO::FETCH_ASSOC) ;
            $opperation = $connection->prepare("INSERT INTO contrat (joueur_id,equipe_id,montant)
                                      VALUES (:joueur_id,:equipe_id,:montant)");
            $opperation -> execute(array(
                ':joueur_id' => $id[0]['id'],
                ':equipe_id' => intval($equipe_id),
                ':montant' => 10
            ));
            $connection -> commit();
        } catch (\PDOException $e) {
            echo "error : ". $e -> getMessage() ;
            $connection -> rollback();
        }
    }
    use search;
    public function stocker_et_gitbudget($Joueur, $EquipeA, $EquipeB, $connection)
    {
        $this->Joueur = $Joueur;
        $this->EquipeA = $EquipeA;
        $this->EquipeB = $EquipeB;
        $opperation = $connection->prepare("SELECT budget FROM equipe WHERE id = :EquipeB");
        $opperation -> execute([":EquipeB"=>$EquipeB]);
        $budget = $opperation->fetchAll(PDO::FETCH_ASSOC);
        return $budget[0]['budget'];
    }
    public function updateJoueurTeam($connection,$equipe_b,$joueur_id){
         $operation = $connection->prepare("Update joueur SET equipe_id = :equipe_b
                                                    WHERE id = :id")->execute([':equipe_b' => $equipe_b, ':id' => $joueur_id]);
    }
}
$joueurClass = new joueur();
// $contrat = {}
