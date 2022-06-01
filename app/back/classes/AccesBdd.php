<?php

include_once "classes/Contact.php";

class AccesBdd{
	public function __construct(
		string $username,
		string $password
	){
		try{
			$this->pdo = new PDO("mysql:host=localhost;dbname=contacts", $username, $password);
			$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (PDOExcexption $exception){
			$this->erreur = $exception->getMessage();
		}
	}

	public function initialiserTable(){
		$this->pdo->query("CREATE TABLE IF NOT EXISTS informations (
			id SERIAL PRIMARY KEY,
			prenom TEXT NOT NULL,
			nom TEXT NOT NULL,
			email TEXT NOT NULL,
			tel VARCHAR(10) NOT NULL,
			ville VARCHAR(10) NOT NULL
		)");
	}

	public function insererContact(
		string $prenom,
		string $nom,
		string $email,
		string $tel,
		string $ville
	){
		$contact = new Contact();
		try{
			$contact->nouveauContact($prenom, $nom, $email, $tel, $ville);
			$statement = $this->pdo->prepare("INSERT INTO informations (prenom, nom, email, tel, ville) VALUES (:prenom, :nom, :email, :tel, :ville)");
			$statement->bindValue("prenom", $contact->getPrenom());
			$statement->bindValue("nom", $contact->getNom());
			$statement->bindValue("email", $contact->getEmail());
			$statement->bindValue("tel", $contact->getTel());
			$statement->bindValue("ville", $contact->getVille());
			$statement->execute();
		}catch (Exception $exception){
			$this->erreur = $exception->getMessage();
		}
	}

	public function recupererContacts(){
		try{
			$statement = $this->pdo->prepare("SELECT prenom, nom FROM informations");
			$statement->execute();
			return json_encode($statement->fetchAll());
		}catch (Exception $exception){
			$this->erreur = $exception->getMessage();
		}
	}

	public function recupererInfos(string $prenom, string $nom){
		$contact = new Contact();
		try{
			$contact->contactTemporaire($prenom, $nom);
			$statement = $this->pdo->prepare("SELECT prenom, nom, email, tel, ville  FROM informations WHERE prenom = :prenom AND nom = :nom");
			$statement->bindValue("prenom", $contact->getPrenom());
			$statement->bindValue("nom", $contact->getNom());
			$statement->execute();
			return json_encode($statement->fetchAll());
		}catch (Exception $exception){
			$this->erreur = $exception->getMessage();
		}
	}
}