<?php

include_once "classes/Contact.php";

class Bdd{
	public function __construct(
		string $username,
		string $password
	){
		try{
			$this->pdo = new PDO("mysql:host=localhost;dbname=contacts",
				$username, $password);
			$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
				PDO::FETCH_ASSOC);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (PDOExcexption $exception){
			$this->erreur = $exception->getMessage();
		}
	}

	public function initialiserTable(){
		$this->pdo->query(
			"CREATE TABLE IF NOT EXISTS informations (
				id SERIAL PRIMARY KEY,
				prenom TEXT NOT NULL,
				nom TEXT NOT NULL,
				email TEXT NOT NULL,
				tel VARCHAR(12) NOT NULL,
				ville VARCHAR(9) NOT NULL
			)"
		);
	}
}

class ModificationsBdd extends Bdd{
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
			$statement = $this->pdo->prepare(
				"INSERT INTO informations (prenom, nom, email, tel, ville)
				VALUES (:prenom, :nom, :email, :tel, :ville)"
			);
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

	public function modifierContact(
		string $prenom,
		string $nom,
		string $email,
		string $tel,
		string $ville,
		int $idContact
	){
		$contact = new Contact();
		try{
			$contact->nouveauContact($prenom, $nom, $email, $tel, $ville);
			$statement = $this->pdo->prepare(
				"UPDATE informations
				SET prenom = :prenom,
					nom = :nom,
					email = :email,
					tel = :tel,
					ville = :ville
				WHERE id = :idContact"
			);
			$statement->bindValue("prenom", $contact->getPrenom());
			$statement->bindValue("nom", $contact->getNom());
			$statement->bindValue("email", $contact->getEmail());
			$statement->bindValue("tel", $contact->getTel());
			$statement->bindValue("ville", $contact->getVille());
			$statement->bindValue("idContact", $idContact);
			$statement->execute();
		}catch (Exception $exception){
			$this->erreur = $exception->getMessage();
		}
	}
}

class InformationsBdd extends Bdd{
	public function recupererContacts(){
		try{
			$statement = $this->pdo->prepare(
				"SELECT prenom, nom
				FROM informations"
			);
			$statement->execute();
			return json_encode($statement->fetchAll());
		}catch (Exception $exception){
			$this->erreur = $exception->getMessage();
		}
	}

	public function recupererInfosContact(string $prenom, string $nom){
		$contact = new Contact();
		try{
			$contact->nouveauContactRecherche($prenom, $nom);
			$statement = $this->pdo->prepare(
				"SELECT *
				FROM informations
				WHERE
					prenom = :prenom AND
					nom = :nom"
			);
			$statement->bindValue("prenom", $contact->getPrenom());
			$statement->bindValue("nom", $contact->getNom());
			$statement->execute();
			return json_encode($statement->fetchAll());
		}catch (Exception $exception){
			$this->erreur = $exception->getMessage();
		}
	}

	public function rechercherContact(string $valeurRecherche){
		try{
			$statement = $this->pdo->prepare(
				"SELECT prenom, nom
				FROM informations
				WHERE
					prenom LIKE CONCAT('%', :valeurRecherche, '%') OR
					nom LIKE CONCAT('%', :valeurRecherche, '%') OR
					email LIKE CONCAT('%', :valeurRecherche, '%') OR
					tel LIKE CONCAT('%', :valeurRecherche, '%') OR
					ville LIKE CONCAT('%', :valeurRecherche, '%')"
			);
			$statement->bindValue("valeurRecherche", $valeurRecherche);
			$statement->execute();
			return json_encode($statement->fetchAll());
		}catch (Exception $exception){
			$this->erreur = $exception->getMessage();
		}
	}
}