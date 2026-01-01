<?php
require_once "equipe.php";
require_once "config.php";
if ($_GET['id']) {
   $teamid = $_GET['id'];
   $teamClass->delete($teamid,"equipe",$connection);
}