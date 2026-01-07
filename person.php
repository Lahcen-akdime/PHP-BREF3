<?php
require_once "Trait/trait.php";
abstract class Person {
    protected int $id ;
    protected string $name ;
    protected string $email ;
    protected string $nationalite ;
    protected array $AllData ;
    public function getAnnualCost($Userid,$connection){}
    use crud;
}
