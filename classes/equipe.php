<?php
namespace Classes;
use Traits\traits;
use Traits\crud;
use Traits\search;
use Classes\dataBase;
require_once "../AutoLoading/autoloading.php";
// require_once "config.php";
/**
 *   @method read(): void
 */
class equipe
{
    public array $allteams ;
    public $connection ;
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
