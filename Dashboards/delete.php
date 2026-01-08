<?php
require_once "equipe.php";
require_once "joueur.php";
require_once "coach.php";
require_once "config.php";
$rowid = $_GET['id'];
$tableName = $_GET['table'];
if ($_GET['table']=="equipe") {
   $teamClass->delete($rowid,$tableName,$connection);
}
elseif ($_GET['table']=="joueur") {
   $joueurClass->delete($rowid,$tableName,$connection);
}
elseif ($_GET['table']=="coach") {
   $coachClass->delete($rowid,$tableName,$connection);
}
// header("location:admindashboard.php");