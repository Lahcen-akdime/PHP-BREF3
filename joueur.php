<?php
include_once "contrat.php";
include_once "person.php";
require_once "FinancialEngine.php";
class joueur extends Person {
    private static $P_signature = 5000;
    private string $role ; 
    private int $ValeurMarcher ;
    private int $contratid ;
    private $Joueur ;
    private $EquipeA ;
    private $EquipeB ;
    public function getAnnualCost(){
    //    return (() * 12) + self::$P_signature ;
    }
    use search ;
    public function transfert($Joueur,$EquipeA,$EquipeB,$connection){
        $this -> Joueur = $Joueur;
        $this -> EquipeA = $EquipeA;
        $this -> EquipeB = $EquipeB;
        $opperation = $connection -> exec("SELECT budget FROM equipe WHERE id = $EquipeB");
        $array = $opperation -> fetchAll(PDO::FETCH_ASSOC);
        $budget = $array[0];
        return $budget ;
    }
}
$joueurClass = new joueur();
// $contrat = {}
