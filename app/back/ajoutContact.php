<?php
include_once "classes/AccesBDD.php";

$bdd = new AccesBdd("admin", "ryvkVDu0aJbv");
$bdd->initialiserTable();

$erreur = $bdd->insererContact(
	$_POST["prenom"],
	$_POST["nom"],
	$_POST["email"],
	$_POST["tel"],
	$_POST["ville"]
);

if ($erreur != null){
	var_dump($erreur);
	die();
}

header("Location: http://127.0.0.1/");