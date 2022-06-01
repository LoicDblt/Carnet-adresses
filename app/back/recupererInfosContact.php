<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

include_once "classes/AccesBDD.php";

$bdd = new AccesBdd("admin", "ryvkVDu0aJbv");
$bdd->initialiserTable();

echo $bdd->recupererInfos($_POST["prenom"], $_POST["nom"]);