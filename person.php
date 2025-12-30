<?php
require_once "config.php";
abstract class Person {
    protected int $id ;
    protected string $name ;
    protected string $email ;
    public string $nationality ;
    public function __construct( int $id , string $name , string $email , string $nationality ){}
}