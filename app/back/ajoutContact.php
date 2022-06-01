<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

include_once "classes/AccesBDD.php";

$bdd = new AccesBdd("admin", "ryvkVDu0aJbv");
$bdd->initialiserTable();

try{
	$bdd->insererContact(
		$_POST["prenom"],
		$_POST["nom"],
		$_POST["email"],
		$_POST["tel"],
		$_POST["ville"]
	);
}catch (Exception $exception){
	var_dump($this->$erreur);
	die();
}

header("Location: ../");