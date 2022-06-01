document.querySelector("#colonneDroite > form > div > input[type=submit]")
.addEventListener("click", event => {
	event.preventDefault();

	var erreurForm = false;

	const regexTexte = /^[\S\s]{1,}$/;
	const regexEmail = /^[a-z0-9-_.]+@[a-z0-9-_.]+\.[a-z]{1,}$/;
	const regexTel = /^(\+33|0)[0-9]{9}$/;
	const villes_connues = ["paris", "lyon", "marseille"]

	const inputPostVerifTexte = function(){
		if (this.value.match(regexTexte) == null){
			this.classList.add("erreur");
			erreurForm = true;
		}
		else{
			this.classList.remove("erreur");
			erreurForm = false;
		}
	}
	const inputPostVerifEmail = function(){
		if (this.value.match(regexEmail) == null){
			this.classList.add("erreur");
			erreurForm = true;
		}
		else{
			this.classList.remove("erreur");
			erreurForm = false;
		}
	}
	const inputPostVerifTel = function(){
		if (this.value.match(regexTel) == null){
			this.classList.add("erreur");
			erreurForm = true;
		}
		else{
			this.classList.remove("erreur");
			erreurForm = false;
		}
	}
	const inputPostVerifVille = function(){
		if (!villes_connues.includes(this.value)){
			this.classList.add("erreur");
			this.previousElementSibling.classList.add("erreur");
			erreurForm = true;
		}
		else{
			this.classList.remove("erreur");
			this.previousElementSibling.classList.remove("erreur");
			erreurForm = false;
		}
	}

	function inputPreVerifRegex(champs, regex){
		if (champs.value.match(regex) == null){
			champs.classList.add("erreur");
			erreurForm = true;
		}
	}
	function inputPreVerifTableau(champs, tableau){
		if (!tableau.includes(champs.value)){
			champs.classList.add("erreur");
			erreurForm = true;
		}
	}

	// Prénom
	let prenomInput = document.getElementById("prenom");
	inputPreVerifRegex(prenomInput, regexTexte);
	prenomInput.addEventListener("input", inputPostVerifTexte);

	// Nom
	let nomInput = document.getElementById("nom");
	inputPreVerifRegex(nomInput, regexTexte);
	nomInput.addEventListener("input", inputPostVerifTexte);

	// Email
	let emailInput = document.getElementById("email");
	inputPreVerifRegex(emailInput, regexEmail);
	emailInput.addEventListener("input", inputPostVerifEmail);

	// Téléphone
	let telInput = document.getElementById("tel");
	inputPreVerifRegex(telInput, regexTel);
	telInput.addEventListener("input", inputPostVerifTel);

	// Ville
	let villeInput = document.getElementById("ville");
	inputPreVerifTableau(villeInput, villes_connues);
	villeInput.addEventListener("change", inputPostVerifVille);

	if (erreurForm == false)
		document.querySelector("#colonneDroite > form").submit();
});