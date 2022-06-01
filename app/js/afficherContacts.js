function afficherFormMasquerP(){
	$(document.querySelector("#colonneDroite > form")).css("display", "flex");
	$(document.querySelector("#colonneDroite > p")).hide();
}
function masquerFormAfficherP(){
	$(document.querySelector("#colonneDroite > form")).hide();
	$(document.querySelector("#colonneDroite > p")).show();
}

function afficherContacts(jsonContacts){
	for (var personne of jsonContacts){
		let ul = document.getElementById("listeContacts");
		let li = document.createElement("li");
		li.appendChild(document.createTextNode(personne.prenom + " " +
			personne.nom));
		ul.appendChild(li);
	}
}
function messageErreurContact(idCible, messageErreur){
	let ul = document.getElementById(idCible);
	let p = document.createElement("p");
	p.appendChild(document.createTextNode(messageErreur));
	ul.appendChild(p);
}

function recupererEtAfficherContacts(valeurRecherche){
	if (valeurRecherche != undefined)
		document.getElementById("listeContacts").innerHTML = "";

	let messageErreur = "Oups ! Il semble il y avoir une erreur de notre côté" +
		"... 🤨";
	let idCible = "listeContacts";
	let fichierBackendRecupContacts = "recupererListeContacts.php";

	let donneesPost = new FormData();
	donneesPost.append("recherche", valeurRecherche);

	fetch("/backend/" + fichierBackendRecupContacts, {
		method: "POST",
		body: donneesPost
	})
	.then(reponse => {
		reponse.json()
			.then(jsonContacts => {
				let nombreContacts = Object.keys(jsonContacts).length;
				if (nombreContacts === 0)
					messageErreurContact(idCible, "Il n'y a aucun contact... " +
						"mais n'hésitez pas à en ajouter ! 😉");
				else
					afficherContacts(jsonContacts);
			})
			.catch(erreur => {
				messageErreurContact(idCible, messageErreur);
				console.log(fichierBackendRecupContacts, ":" , erreur)
			})
	})
	.catch(erreur => {
		messageErreurContact(idCible, messageErreur);
		console.log(fichierBackendRecupContacts, ":" , erreur)
	})
}

function recupererInfosContact(prenom, nom){
	let messageErreur = "Oups ! Il semble il y avoir une erreur de notre côté" +
		" ... 🤨";
	let fichierBackendRecupInfos = "recupererInfosContact.php";

	let donneesPost = new FormData();
	donneesPost.append("prenom", prenom);
	donneesPost.append("nom", nom);

	fetch("/backend/" + fichierBackendRecupInfos, {
		method: "POST",
		body: donneesPost
	})
	.then(reponse => {
		reponse.json()
			.then(jsonInfos => {
				afficherFormMasquerP();
				for (var infos of jsonInfos){
					document.getElementById("prenom").value = infos.prenom;
					document.getElementById("nom").value = infos.nom;
					document.getElementById("email").value = infos.email;
					document.getElementById("tel").value = infos.tel;
					document.getElementById("ville").value = infos.ville
						.toLowerCase();
					document.getElementById("id").value = infos.id;
				}
			})
			.catch(erreur => {
				masquerFormAfficherP();
				document.querySelector("#colonneDroite > p:nth-child(2)")
					.innerText = messageErreur;
				console.log(fichierBackendRecupInfos, ":" , erreur);
			})
	})
	.catch(erreur => {
		masquerFormAfficherP();
		document.querySelector("#colonneDroite > p:nth-child(2)")
			.innerText = messageErreur;
		console.log(fichierBackendRecupInfos, ":" , erreur);
	})
}

document.getElementById("listeContacts").addEventListener("click", event => {
	var tableauPrenomNom = event.target.innerText.split(" ");
	if (event.target && event.target.matches("li"))
		recupererInfosContact(tableauPrenomNom[0], tableauPrenomNom[1]);
});
document.querySelector("#champsRecherche > input").addEventListener("input",
() => {
	recupererEtAfficherContacts(
		document.querySelector("#champsRecherche > input").value
	);
});

document.getElementById("ajouterContact").addEventListener("click", () => {
	afficherFormMasquerP();
	document.querySelector("#colonneDroite > form").reset(); 
});
document.querySelector("input[type=reset]").addEventListener("click", () => {
	document.querySelector("#colonneDroite > p:nth-child(2)").innerText = 
		"💡Sélectionnez un contact pour afficher ses information";
	masquerFormAfficherP();
});