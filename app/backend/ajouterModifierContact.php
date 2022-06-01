<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

include_once "classes/Bdd.php";

$bdd = new ModificationsBdd("admin", "ryvkVDu0aJbv");

if (is_numeric($_POST["id"])){
	try{
		$bdd->modifierContact(
			$_POST["prenom"],
			$_POST["nom"],
			$_POST["email"],
			$_POST["tel"],
			$_POST["ville"],
			$_POST["id"]
		);
	}catch (Exception $exception){
		var_dump($this->$erreur);
		die();
	}
}
else{
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
}

header("Location: ../");