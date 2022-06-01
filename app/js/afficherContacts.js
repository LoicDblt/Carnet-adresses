function afficherContacts(jsonContacts){
	for (var personne of jsonContacts){
		let ul = document.getElementById("listeContacts");
		let li = document.createElement("li");
		li.appendChild(document.createTextNode(personne.prenom + " " + personne.nom));
		ul.appendChild(li);
	}
}

function erreurContacts(idCible, messageErreur){
	let ul = document.getElementById(idCible);
	let p = document.createElement("p");
	p.appendChild(document.createTextNode(messageErreur));
	ul.appendChild(p);
}

function afficherFormMasquerP(){
	$(document.querySelector("#colonneDroite > form")).css("display", "flex");
	$(document.querySelector("#colonneDroite > p")).hide();
}

function masquerFormAfficherP(){
	$(document.querySelector("#colonneDroite > form")).hide();
	$(document.querySelector("#colonneDroite > p")).show();
}

function recupererEtAfficherContacts(valeurRecherche){
	if (valeurRecherche != undefined)
		document.getElementById("listeContacts").innerHTML = "";

	let messageErreur = "Oups ! Il semble il y avoir une erreur de notre côté... 🤨";
	let idCible = "listeContacts";
	let fichierBackRecupContacts = "recupererListeContacts.php";
	fetch("/back/" + fichierBackRecupContacts, {
		method: "POST",
		headers: {
			"Content-Type": "application/json; charset=UTF-8"
		},
		body: JSON.stringify({recherche: valeurRecherche}),
	})
	.then(reponse => {
		reponse.json()
			.then(jsonContacts => {
				let nombreContacts = Object.keys(jsonContacts).length;
				if (nombreContacts === 0)
					erreurContacts(idCible, "Il n'y a aucun contact... mais n'hésitez pas à en ajouter ! 😉");
				else{
					afficherContacts(jsonContacts);
				}
			})
			.catch(erreur => {
				erreurContacts(idCible, messageErreur);
				console.log(fichierBackRecupContacts, ":" , erreur)
			})
	})
	.catch(erreur => {
		erreurContacts(idCible, messageErreur);
		console.log(fichierBackRecupContacts, ":" , erreur)
	})
}

function recupererInfosContact(prenom, nom){
	let messageErreur = "Oups ! Il semble il y avoir une erreur de notre côté... 🤨";
	let fichierBackRecupInfos = "recupererInfosContact.php";
	var formData = new FormData();
	formData.append("prenom", prenom);
	formData.append("nom", nom);

	fetch("/back/" + fichierBackRecupInfos, {method: "POST", body: formData})
	.then(reponse => {
		reponse.json()
			.then(jsonInfos => {
				afficherFormMasquerP();
				for (var infos of jsonInfos){
					document.getElementById("prenom").value = infos.prenom;
					document.getElementById("nom").value = infos.nom;
					document.getElementById("email").value = infos.email;
					document.getElementById("tel").value = infos.tel;
					document.getElementById("ville").value = infos.ville.toLowerCase();
					document.getElementById("id").value = infos.id;
				}
			})
			.catch(erreur => {
				masquerFormAfficherP();
				document.querySelector("#colonneDroite > p:nth-child(2)").innerText = messageErreur;
				console.log(fichierBackRecupInfos, ":" , erreur)
			})
	})
	.catch(erreur => {
		masquerFormAfficherP();
		document.querySelector("#colonneDroite > p:nth-child(2)").innerText = messageErreur;
		console.log(fichierBackRecupInfos, ":" , erreur)
	})
}


document.getElementById("listeContacts").addEventListener("click", event => {
	var tableauPrenomNom = event.target.innerText.split(" ");
	if (event.target && event.target.matches("li"))
		recupererInfosContact(tableauPrenomNom[0], tableauPrenomNom[1]);
});

document.getElementById("ajouterContact").addEventListener("click", () => {
	afficherFormMasquerP();
	document.querySelector("#colonneDroite > form").reset(); 
});

document.querySelector("input[type=reset]").addEventListener("click", () => {
	document.querySelector("#colonneDroite > p:nth-child(2)").innerText = "💡Sélectionnez un contact pour afficher ses information";
	masquerFormAfficherP();
});