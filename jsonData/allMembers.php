<?php
require_once "../joueur.php";
require_once "../coach.php";
require_once "../config.php";
require_once "../formatter.php";
require_once "../joinClass.php";
$query = $_GET['query'];
$Alljoueurs = $joueurClass -> read("joueur",$connection);
$Allcoaches = $coachClass -> read("coach",$connection) ;
$resault = [];
foreach ($Alljoueurs as $key ) {
    if (str_starts_with($key['name'],$query)) {
    $key['valeur_m'] = $formatterClass->currency($key['valeur_m']);
    $key['coute'] = $formatterClass->currency($joueurClass->getAnnualCost($key['id'], $connection)) ;
    $key['equipeName'] = $joinClass->equipename("joueur", $key['id']);
    array_push($resault,$key);
    // $key['coute'],$key['eqiupeName']);
    }
}
foreach ($Allcoaches as $key ) {
    if (str_starts_with($key['name'],$query)) {
    $key['coute'] = $formatterClass->currency($coachClass->getAnnualCost($key['id'], $connection)) ;
    $key['equipeName'] = $joinClass->equipename("coach", $key['id']);
    array_push($resault,$key);
    // $key['coute'],$key['eqiupeName']);
    }
}
echo json_encode($resault);
// echo $Alljoueurs;
?>
