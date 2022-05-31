<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8"/>
	<title>Carnet d'adresses</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta name="robots" content="noindex, nofollow"/>
	<meta name="color-scheme" content="light dark"/>
	<meta name="theme-color" content="#f9f9fb" media="(prefers-color-scheme: light)"/>
	<meta name="theme-color" content="#010101" media="(prefers-color-scheme: dark)"/>
	<meta name="description" content="Carnet d'adresses - Projet entretien"/>
	<link rel="manifest" href="meteor.webmanifest"/>
	<link rel="icon" type="image/webp" href="img/icons/meteor_favicon.webp"/>
	<link rel="apple-touch-icon" href="img/icons/meteor_apple_touch.webp"/>
	<link rel="stylesheet" type="text/css" href="style/index.css"/>
</head>
<body>
<header>
	<div id="boxCentre">
		<img draggable="false" src="img/nav/meteor.webp" alt="Logo du site MeteoR"/>
	</div>
</header>
<section>
	<section>
		<h1>Mes contacts</h1>
		<div id="tableauContacts">
			<input id="champsRecherche" placeholder="&#128269; Rechercher un contact.."/>
			<section id="colonneGauche">
				<h2>Liste des contacts</h2>
				<ul>
					<li>Patrick</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
					<li>Quentin</li>
				</ul>
				<button>Ajouter un contact</button>
			</section>
			<section id="colonneDroite">
				<h2>Informations du contact</h2>
				<form action="http://127.0.0.1/back/ajoutContact.php" method="POST" accept-charset="utf-8">
					<div>
						<label for="prenom">Prénom</label>
						<input type="text" id="prenom" name="prenom" maxlength="100" placeholder="Prénom"/>
					</div>
					<div>
						<label for="nom">Nom</label>
						<input type="text" id="nom" name="nom" maxlength="100" placeholder="Nom"/>
					</div>
					<div>
						<label for="email">Adresse email</label>
						<input type="email" id="email" name="email" maxlength="100" placeholder="Adresse email"/>
					</div>
					<div>
						<label for="tel">Numéro de téléphone</label>
						<input id="tel" name="tel" placeholder="Numéro de téléphone"></input>
					</div>
					<div>
						<label for="ville">Ville</label>
						<select id="ville" name="ville">
							<option value="">-- Veuillez sélectionner une ville --</option>
							<option value="paris">Paris</option>
							<option value="lyon">Lyon</option>
							<option value="marseille">Marseille</option>
						</select>
					</div>
					<div>
						<input type="reset" value="Annuler"/>
						<input type="submit" value="Enregistrer"/>
					</div>
				</form>
			</section>
		</div>
	</section>
</section>
<script src="js/index.js"></script>
<script src="js/verifFormulaire.js"></script>
</body>
</html>