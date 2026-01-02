<?php
class transfert
{
    private $joueur_id;
    private $equipe_a;
    private $equipe_b;
    private $state;
    private $connection;
    public function Playerinsertion($joueur_id, $equipe_a, $equipe_b, $state, $connection)
    {
        $this->joueur_id;
        $this->equipe_a;
        $this->equipe_b;
        $this->state;
        $this->connection;
        $operation = $connection->prepare("INSERT INTO transfert(joueur_id,equipe_a,equipe_b,state)
        VALUES(:joueur_id,:equipe_a,:equipe_b,:state)");
        $operation->execute(array(
            ':joueur_id' => $joueur_id,
            ':equipe_a' => $equipe_a,
            ':equipe_b' => $equipe_b,
            ':state' => $state
        ));
    }
    public function Alloperation($budget, $resault)
    {
        try {
            $this->connection->beginTransaction(PDO::ATTR_ERRMODE);
            $operation = $this->connection->query("Update joueur SET equipe_id =$this -> equipe_b
                                                    WHERE id = $this -> joueur_id");
            $newBudget = $budget - $resault;
            $operation = $this->connection->query("Update equipe SET budget = $newBudget
                                                   WHERE id = $this -> equipe_b");
            $operation = $this->connection->prepare("INSERT INTO contrat(:joueur_id,:equipe_id,:montant)
             VALUES(:joueur_id,:equipe_a,:equipe_b,:state)");
            $operation->execute(array(
                ':joueur_id' => $this->joueur_id,
                ':equipe_id' => $this->equipe_a,
                ':montant' => $resault
            ));
            $this->connection->commit();
        } catch (Exception $e) {
            $this -> connection -> rollback();
            echo "Error : ". $e -> getMessage();
        }
    }
}
$transfertClass = new transfert();
