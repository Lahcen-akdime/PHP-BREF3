<?php
trait crud {
    public function read($name,$connection){
        $operation = $connection -> query("SELECT * FROM $name");
         return $operation -> fetchAll(PDO::FETCH_ASSOC);
    }
     public function update($a , $c){
     }
     public function delete($id,$tableName,$connection){
        $connection -> query("DELETE FROM $tableName WHERE id = $id");
        header("location:admindashboard.php");
     }
     
}
trait search {
    public function search($tableName,$id,$connection){
        $resault = $connection -> prepare("SELECT id FROM $tableName WHERE id = :id");
        $resault->execute([':id'=>$id]);
        $data = $resault -> fetchAll(PDO::FETCH_NUM);
        if($data){
            //  $all = $resault -> fetchAll(PDO::FETCH_ASSOC);
             return $data[0];
        }
        else{
            return false ;
        }

    }
}