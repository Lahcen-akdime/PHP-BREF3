<?php
trait crud {
    public function read($name,$connection){
        $operation = $connection -> prepare("SELECT * FROM $name");
        $operation -> execute();
         return $operation -> fetchAll(PDO::FETCH_ASSOC);
    }
     public function update($a , $c){
     }
}