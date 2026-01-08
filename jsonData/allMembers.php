<?php
require_once "../joueur.php";
require_once "../coach.php";
require_once "../config.php";
require_once "../formatter.php";
require_once "../joinClass.php";
$Allcoaches = $coachClass -> read("coach",$connection) ;
$Alljoueurs = $joueurClass -> read("joueur",$connection);
// _____________________ Search __________________________ //
if(isset($_GET['query'])){
    $query = $_GET['query'] ;
$resault = [];
foreach ($Alljoueurs as $key ) {
    if (str_starts_with($key['name'],$query)) {
    $key['valeur_m'] = $formatterClass->currency($key['valeur_m']);
    $key['coute'] = $formatterClass->currency($joueurClass->getAnnualCost($key['id'], $connection)) ;
    $key['equipeName'] = $joinClass->equipename("joueur", $key['id']);
    array_push($resault,$key);
    }
}
foreach ($Allcoaches as $key ) {
    if (str_starts_with($key['name'],$query)) {
    $key['coute'] = $formatterClass->currency($coachClass->getAnnualCost($key['id'], $connection)) ;
    $key['equipeName'] = $joinClass->equipename("coach", $key['id']);
    array_push($resault,$key);
    }
}
echo json_encode($resault);
}
// _________________________ filter ___________________________ //
if(isset($_GET['equipeName'])){
    $equipeName = $_GET['equipeName'];
$resault = [];
 if($equipeName=="all"){
            foreach ($Alljoueurs as $key ) {
            $key['valeur_m'] = $formatterClass->currency($key['valeur_m']);
            $key['coute'] = $formatterClass->currency($joueurClass->getAnnualCost($key['id'], $connection)) ;
            $key['equipeName'] = $joinClass->equipename("joueur", $key['id']);
            array_push($resault,$key);
            }
             foreach ($Allcoaches as $key ) {
            $key['coute'] = $formatterClass->currency($coachClass->getAnnualCost($key['id'], $connection)) ;
            $key['equipeName'] = $joinClass->equipename("coach", $key['id']);
            array_push($resault,$key);
            }
        }
        else{
foreach ($Alljoueurs as $key ) {
    $key['equipeName'] = $joinClass->equipename("joueur", $key['id']);
    if ($key['equipeName'] == $equipeName) {
        $key['valeur_m'] = $formatterClass->currency($key['valeur_m']);
        $key['coute'] = $formatterClass->currency($joueurClass->getAnnualCost($key['id'], $connection)) ;
        $key['equipeName'] = $joinClass->equipename("joueur", $key['id']);
        array_push($resault,$key);
    }}
    foreach ($Allcoaches as $key ) {
        $key['equipeName'] = $joinClass->equipename("coach", $key['id']);
        if ($key['equipeName'] == $equipeName) {
            $key['coute'] = $formatterClass->currency($coachClass->getAnnualCost($key['id'], $connection)) ;
            $key['equipeName'] = $joinClass->equipename("coach", $key['id']);
            array_push($resault,$key);
        }}}
echo json_encode($resault);
}

?>
