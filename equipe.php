<?php
require_once "interface.php";
require_once "Trait/trait.php";
require_once "config.php";
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
        $operation = $this->connection->query("Update equipe SET budget = $newbudget WHERE id = $eqipeID");
    }
}
$teamClass = new equipe($connection);
$GLOBALS['teams'] = $teamClass->affichage();
