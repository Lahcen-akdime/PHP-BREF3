<?php
class transfert
{
    private int  $joueur_id;
    private int  $coach_id;
    private int $equipe_a;
    private int  $equipe_b;
    private string $state;
    private PDO $connection;
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
            $operation = $this->connection->prepare("Update joueur SET equipe_id = :equipe_b
                                                    WHERE id = :id")->execute([':equipe_b' => $this->equipe_b, ':id' => $this->joueur_id]);
            $newBudget = $budget - $resault;
            $operation = $this->connection->prepare("Update equipe SET budget = $newBudget
                                                   WHERE id = :id");
            $operation->execute(['id' => $this->equipe_b]);
            $operation = $this->connection->prepare("INSERT INTO contrat(joueur_id,equipe_id,montant)
             VALUES(:joueur_id,:equipe_id,:montant)");
            $operation->execute(array(
                ':joueur_id' => $this->joueur_id,
                ':equipe_id' => $this->equipe_b,

                ':montant' => $resault,

            ));
            $this->connection->commit();
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
            $this->connection->rollback();
        }
    }
    public function FinalCoachoperation($budget, $resault)
    {

        try {
            $this->connection->beginTransaction();
            $operation = $this->connection->prepare("Update coach SET equipe_id = :equipe_b
                                                    WHERE id = :id")->execute([':equipe_b' => $this->equipe_b, ':id' => $this->coach_id]);
            $newBudget = $budget - $resault;
            $operation = $this->connection->prepare("Update equipe SET budget = $newBudget
                                                   WHERE id = :id");
            $operation->execute(['id' => $this->equipe_b]);
            $operation = $this->connection->prepare("INSERT INTO contrat(coach_id,equipe_id,montant)
             VALUES(:coach_id,:equipe_id,:montant)");
            $operation->execute(array(
                ':coach_id' => $this->coach_id,
                ':equipe_id' => $this->equipe_b,
                ':montant' => $resault,

            ));
            $this->connection->commit();
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
            $this->connection->rollback();
        }
    }
}
$transfertClass = new transfert();