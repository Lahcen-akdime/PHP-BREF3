<?php
abstract class Person {
    protected int $id ;
    protected string $name ;
    protected string $email ;
    protected string $nationalite ;
    public function getAnnualCost($Userid,$connection){}
}