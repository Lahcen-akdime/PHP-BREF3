<?php
namespace Classes;
class Formatter {
    static public function currency($nombre){
    $op1 = $nombre * 0.01;
    return $op1 / 1000000 . "M €";
    }
}