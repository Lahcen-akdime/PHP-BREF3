<?php
require_once "config.php";
abstract class Person {
    protected int $id ;
    protected string $name ;
    protected string $email ;
    public string $nationality ;
    abstract public function getAnnualCost();
}