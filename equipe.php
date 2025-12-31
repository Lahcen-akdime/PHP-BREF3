<?php
require_once "interface.php";
class equipe implements crud {
    public function __construct(public $connection){}
    public function create($name,$managername,$budget){
        $operation = $this -> connection -> prepare("INSERT INTO equipe(name,manager_name,budget)
        VALUES(:name,:manager_name,:budget)");
        $operation -> execute(array(':name'=>$name,':manager_name'=>$managername,':budget'=>$budget));
    }
}