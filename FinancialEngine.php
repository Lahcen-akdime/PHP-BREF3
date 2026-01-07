<?php
final class FinancialEngine {
    private float $commision ;
    private float $Solvabilite ;
    static private float $transfertTaxe = 0.05 ;
    private float $total ;
    public function  checkSolvabilité($budget,$couteJoueur){
         $this -> commision = $couteJoueur / 2 ;
        $this -> total = (($couteJoueur + $this->commision) * (self::$transfertTaxe));
        $this -> Solvabilite = $budget - ($this->total);
        if($this -> Solvabilite > 0){
            return $this->total ;
        }
        else {
            return false ;
        }}}
$finalClass = new FinancialEngine();






















