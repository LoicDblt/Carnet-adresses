document.querySelector("form > div > input[type=submit]").addEventListener("click", event => {
	event.preventDefault();
	let erreurForm = false;

	// Regex
	const regexInput = /^[\S\s]{1,}$/;
	const regexEmail = /^[a-z0-9-_.]+@[a-z0-9-_.]+\.[a-z]{1,}$/;
	const regexTel = /^(\+33|0)[0-9]{9}$/;

	// Fonction de vérification
	const inputPostVerif = function(){
		if (this.value.match(regexInput) == null){
			this.classList.add("erreur");
			erreurForm = true;
		}
		else{
			this.classList.remove("erreur");
			erreurForm = false;
		}
	}

	function inputPreVerif(donnee, regex){
		if (donnee.value.match(regex) == null){
			donnee.classList.add("erreur");
			erreurForm = true;
		}
	}

	// Prénom
	let prenomInput = document.getElementById("prenom");
	inputPreVerif(prenomInput, regexInput);
	prenomInput.addEventListener("input", inputPostVerif);

	// Nom
	let nomInput = document.getElementById("nom");
	inputPreVerif(nomInput, regexInput);
	nomInput.addEventListener("input", inputPostVerif);

	// Email
	let emailInput = document.getElementById("email");
	inputPreVerif(emailInput, regexEmail);
	emailInput.addEventListener("input", function(){
		if (this.value.match(regexEmail) == null){
			this.classList.add("erreur");
			erreurForm = true;
		}
		else{
			this.classList.remove("erreur");
			erreurForm = false;
		}
	});

	// Téléphone
	let telInput = document.getElementById("tel");
	inputPreVerif(telInput, regexTel);
	telInput.addEventListener("input", function(){
		if (this.value.match(regexTel) == null){
			this.classList.add("erreur");
			this.previousElementSibling.classList.add("erreur");
			erreurForm = true;
		}
		else{
			this.classList.remove("erreur");
			this.previousElementSibling.classList.remove("erreur");
			erreurForm = false;
		}
	});

	// Si tous les tests sont validés, on envoie au back
	if (erreurForm == false)
		document.querySelector("form").submit();
})