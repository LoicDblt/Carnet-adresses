// N'active pas le service worker sur Firefox bureau -> problème de perfs
if (
	"serviceWorker" in navigator &&
	(window.navigator.userAgent.toLowerCase().indexOf("firefox") === -1 ||
	window.navigator.userAgent.toLowerCase().indexOf("mobile") > -1)
){
	navigator.serviceWorker.register("../service_worker.js")
	.then({})
	.catch(function(erreur){
		console.log("Service worker - enregistrement echoué :", erreur);
	})
}

recupererEtAfficherContacts();