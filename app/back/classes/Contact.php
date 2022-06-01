<?php

include_once "classes/AccesBDD.php";

class Contact{
	private const VILLES_CONNUES = ["Paris", "Lyon", "Marseille"];
	private const REGEX_INPUT = "#^[\S\s]{1,}$#";
	private const REGEX_EMAIL = "#^[a-z0-9-_.]+@[a-z0-9-_.]+\.[a-z]{2,}$#";
	private const REGEX_TEL = "#^(\+33|0)[0-9]{9}$#";

	public function getPrenom() : string {
		return $this->prenom;
	}
	public function getNom() : string {
		return $this->nom;
	}
	public function getEmail() : string {
		return $this->email;
	}
	public function getTel() : string {
		return $this->tel;
	}
	public function getVille() : string {
		return $this->ville;
	}

	public function getVillesConnues() : array {
		return self::VILLES_CONNUES;
	}
	public function getRegexInput() : string {
		return self::REGEX_INPUT;
	}
	public function getRegexEmail() : string {
		return self::REGEX_EMAIL;
	}
	public function getRegexTel() : string {
		return self::REGEX_TEL;
	}

	public function setPrenom(string $prenom){
		$prenom = htmlspecialchars($prenom);
		if (preg_match(Contact::getRegexInput(), $prenom)){
			$this->prenom = $prenom;
		}
		else{
			throw new Exception("Le prénom n'a pas le bon format");
		}
	}
	public function setNom(string $nom){
		$nom = htmlspecialchars($nom);
		if (preg_match(Contact::getRegexInput(), $nom)){
			$this->nom = strtoupper($nom);
		}
		else{
			throw new Exception("Le nom n'a pas le bon format");
		}
	}
	public function setEmail(string $email){
		$email = htmlspecialchars($email);
		if (preg_match(Contact::getRegexEmail(), $email)){
			$this->email = $email;
		}
		else{
			throw new Exception("L'email n'a pas le bon format");
		}
	}
	public function setTel(string $tel){
		$tel = htmlspecialchars($tel);
		if (preg_match(Contact::getRegexTel(), $tel)){
			$this->tel = $tel;
		}
		else{
			throw new Exception("Le numéro de téléphone n'a pas le bon format");
		}
	}
	public function setVille(string $ville){
		$ville = ucwords(htmlspecialchars($ville));
		if (in_array($ville, Contact::getVillesConnues())){
			$this->ville = $ville;
		}
		else{
			throw new Exception("La ville n'est pas reconnue");
		}
	}

	public function nouveauContact(
		string $prenom,
		string $nom,
		string $email,
		string $tel,
		string $ville
	){
		try{
			$this->setPrenom($prenom);
			$this->setNom($nom);
			$this->setEmail($email);
			$this->setTel($tel);
			$this->setVille($ville);
		}catch (Exception $exception){
			$this->erreur = $exception->getMessage();
		}
	}
}