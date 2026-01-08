<?php
namespace APEX\classes;
use APEX\Trait\crud;
use APEX\Trait\search;
use APEX\classes\dataBase;
// require_once "config.php";
/**
 *   @method read(): void
 */
class equipe
{
    public $connection;
    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    use crud;
    public function create($name, $managername, $budget, $connection)
    {
        $operation = $connection->prepare("INSERT INTO equipe(name,manager_name,budget)
        VALUES(:name,:manager_name,:budget)");
        $operation->execute(array(':name' => $name, ':manager_name' => $managername, ':budget' => $budget));
    }
    public function affichage()
    {
        return $this->read("equipe", $this->connection);
    }
    public function updatebudget($newbudget, $eqipeID)
    {
        $this->connection->query("Update equipe SET budget = $newbudget WHERE id = $eqipeID");
    }
        use search ;
    public function getSumBudget(){
        $operation = $this -> connection  -> prepare("SELECT SUM(budget) as sum FROM equipe") ;
         $operation -> execute();
        $data = $operation -> fetchAll(\PDO::FETCH_NUM);
        return $data[0][0];
    }
        
}
$teamClass = new equipe($connection);
$GLOBALS['teams'] = $teamClass->affichage();
