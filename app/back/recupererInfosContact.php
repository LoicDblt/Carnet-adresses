<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

include_once "classes/Bdd.php";

$bdd = new RecupererInfos("admin", "ryvkVDu0aJbv");

echo $bdd->recupererInfos($_POST["prenom"], $_POST["nom"]);