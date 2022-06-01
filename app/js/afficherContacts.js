function afficherContacts(jsonContacts){
	for (var personne of jsonContacts){
		let ul = document.getElementById("listeContacts");
		let li = document.createElement("li");
		li.appendChild(document.createTextNode(personne.prenom + " " + personne.nom));
		ul.appendChild(li);
	}
}

function erreurContacts(messageErreur){
	let ul = document.getElementById("listeContacts");
	let p = document.createElement("p");
	p.appendChild(document.createTextNode(messageErreur));
	ul.appendChild(p);
}

function recupererEtAfficherContacts(){
	let messageErreur = "Oups ! Il semble il y avoir une erreur de notre côté... 🤨";
	let fichierBackRecupContacts = "recupererListeContacts.php";
	fetch("/back/" + fichierBackRecupContacts)
	.then(reponse => {
		reponse.json()
			.then(jsonContacts => {
				let nombreContacts = Object.keys(jsonContacts).length;
				if (nombreContacts === 0){
					erreurContacts("Il n'y a aucun contact... mais n'hésitez pas à en ajouter ! 😉");
				}
				else
					afficherContacts(jsonContacts);
			})
			.catch(erreur => {
				erreurContacts(messageErreur);
				console.log(fichierBackRecupContacts, ":" ,erreur)
			})
	})
	.catch(erreur => {
		erreurContacts(messageErreur);
		console.log(fichierBackRecupContacts, ":" ,erreur)
	})
}


document.getElementById("listeContacts").addEventListener("click", event => {
	if (event.target && event.target.matches("li")){
		console.log(event.target.innerText);
	}
});

document.getElementById("ajouterContact").addEventListener("click", () => {
	$(document.querySelector("form")).css("display", "flex");
	$(document.querySelector("#colonneDroite > p")).hide();
});

document.querySelector("input[type=reset]").addEventListener("click", () => {
	$(document.querySelector("form")).hide();
	$(document.querySelector("#colonneDroite > p")).show();
});