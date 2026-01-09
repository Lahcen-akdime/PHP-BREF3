<?php
namespace Traits;
trait crud {
    public function read($name,$connection){
        $operation = $connection -> query("SELECT * FROM $name");
         return $operation -> fetchAll(\PDO::FETCH_ASSOC);
    }
     public function delete($id,$tableName,$connection){
        $connection -> query("DELETE FROM $tableName WHERE id = $id");
        header("location:admindashboard.php");
     }
}
