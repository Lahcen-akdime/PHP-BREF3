<?php
namespace Classes;
use Classes\contract;
use Classes\joueur;
use Classes\equipe;
use Classes\coach;
use Traits\search;
use Traits\crud;
use PDO ;

class transfert
{
    private int  $joueur_id;
    private int  $coach_id;
    private int $equipe_a;
    private int  $equipe_b;
    private joueur $joueurClass ;
    private $coachClass ;
    private $contratClass ;
    private $teamClass ;
    private readonly string $state;
    private PDO $connection;
    public function __construct($joueurClass,$coachClass,$contratClass,$teamClass)
    {
        $this -> joueurClass = $joueurClass ;
        $this -> coachClass = $coachClass ;
        $this -> contratClass = $contratClass ;
        $this -> teamClass = $teamClass ;
    }
    public function Playerinsertion($joueur_id, $equipe_a, $equipe_b, $state, $connection)
    {
        $this->joueur_id = $joueur_id;
        $this->equipe_a = $equipe_a;
        $this->equipe_b = $equipe_b;
        $this->state = $state;
        $this->connection = $connection;
        $operation = $connection->prepare("INSERT INTO transfert(joueur_id,equipe_a,equipe_b,state)
        VALUES(:joueur_id,:equipe_a,:equipe_b,:state)");
        $operation->execute(array(
            ':joueur_id' => $this->joueur_id,
            ':equipe_a' =>  $this->equipe_a,
            ':equipe_b' =>  $this->equipe_b,
            ':state' =>  $this->state
        ));
    }
    use crud ;
    use search ;
     public function CoachInsertion($coach_id, $equipe_a, $equipe_b, $state, $connection)
    {
        $this->coach_id = $coach_id;
        $this->equipe_a = $equipe_a;
        $this->equipe_b = $equipe_b;
        $this->state = $state;
        $this->connection = $connection;
        $operation = $connection->prepare("INSERT INTO transfert(coach_id,equipe_a,equipe_b,state)
        VALUES(:coach_id,:equipe_a,:equipe_b,:state)");
        $operation->execute(array(
            ':coach_id' => $this->coach_id,
            ':equipe_a' =>  $this->equipe_a,
            ':equipe_b' =>  $this->equipe_b,
            ':state' =>  $this->state
        ));
    }
    public function FinalPlayerOperation($budget, $resault)
    {
        try {
            $this->connection->beginTransaction();
            // update the team of player -> to the new team
            $this -> joueurClass -> updateJoueurTeam($this -> connection,$this -> equipe_b,$this -> joueur_id);
            // calculation of the new budget resault
            $newBudget = $budget - $resault;
            // update the team budget
            $this -> teamClass -> updatebudget($newBudget, $this->equipe_b);
            // insert to contrat 
            $this -> contratClass -> create($this -> connection,$this->joueur_id,$this->equipe_b,$resault);
            $this->connection->commit();
        } catch (\PDOException $e) {
            echo "Error : " . $e->getMessage();
            $this->connection->rollback();
        }
    }
    public function FinalCoachoperation($budget, $resault)
    {
        try {
            // start the transaction
            $this->connection->beginTransaction();
            // update the team of coach -> to the new team
            $this -> coachClass -> updateCoachTeam($this -> connection,$this -> equipe_b,$this -> coach_id);
            // calculation of the new budget resault           
            $newBudget = $budget - $resault;
            // update the team budget
            $this -> teamClass -> updatebudget($newBudget, $this->equipe_b);
            // insert to contrat 
            $this -> contratClass -> create($this -> connection,$this->coach_id,$this->equipe_b,$resault);
            // the end of transaction
            $this->connection->commit();
        } catch (\PDOException $e) {
            echo "Error : " . $e->getMessage();
            $this->connection->rollback();
        }
    }
}