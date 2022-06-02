<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

include_once "classes/Bdd.php";

$bdd = new InformationsBdd("admin", "ryvkVDu0aJbv");
$bdd->initialiserTable();

if ($_POST["recherche"] != "undefined")
	echo $bdd->rechercherContact($_POST["recherche"]);
else
	echo $bdd->recupererContacts();