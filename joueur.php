<?php
include_once "contrat.php";
class joueur extends Person {
    private static $P_signature = 5000;
    public function __construct(protected string $name,
                                protected string $email,protected string $nationality,
                                protected string $role,protected int $ValeurMarcher ,
                                protected int $contratid )
                                {}
    public function getAnnualCost(){
    //    return (() * 12) + self::$P_signature ;
    }
}



// $contrat = {}
//  Le Joueur coûte : (Salaire mensuel * 12) + Prime de signature.
// - Le Coach coûte : (Salaire mensuel * 12) + Frais de déplacement.