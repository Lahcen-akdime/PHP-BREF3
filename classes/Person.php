<?php
namespace Classes;
use Traits\crud;
abstract class Person {
    protected int $id ;
    protected string $name ;
    protected string $email ;
    protected string $nationalite ;
    protected array $AllData ;
    public function getAnnualCost($Userid,$connection){}
    use crud;
}
