<?php
namespace Traits;
trait search {
    public function search($tableName,$id,$connection){
        $resault = $connection -> prepare("SELECT id FROM $tableName WHERE id = :id");
        $resault->execute([':id'=>$id]);
        $data = $resault -> fetchAll(\PDO::FETCH_NUM);
        if($data){
            //  $all = $resault -> fetchAll(PDO::FETCH_ASSOC);
             return $data[0];
        }
        else{
            return false ;
        }

    }
}