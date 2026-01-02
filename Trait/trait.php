<?php
trait crud {
    public function read($name,$connection){
        $operation = $connection -> prepare("SELECT * FROM $name");
        $operation -> execute();
         return $operation -> fetchAll(PDO::FETCH_ASSOC);
    }
     public function update($a , $c){
     }
     public function delete($teadmId,$tableName,$connection){
        $connection -> query("DELETE FROM $tableName WHERE id = $teadmId");
        header("location:admindashboard.php");
     }
}
trait search {
    public function search($tableName,$id,$connection){
        $resault = $connection -> exec("SELECT 1 FROM $tableName WHERE id = $id");
        if($resault){
             $all = $resault -> fetchAll(PDO::FETCH_ASSOC);
             return $all[0];
        }
        else{
            return false ;
        }

    }
}