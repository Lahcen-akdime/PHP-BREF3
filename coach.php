<?php
class coach extends Person {
    private string $style_coach ;
    private string $annee_experience ;
    public $P_deplacement = 3000;
     public function getAnnualCost(){
    // return $this -> salaire * 12 + $this -> P_deplacement  ;
    }
}
