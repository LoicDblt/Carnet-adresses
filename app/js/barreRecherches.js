document.querySelector("#champsRecherche > input").addEventListener("input", () => {
	recupererEtAfficherContacts(document.querySelector("#champsRecherche > input").value);
});