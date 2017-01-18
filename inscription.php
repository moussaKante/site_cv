<?php 
require 'connexion/connexion.php';
?>

<!DOCTYPE html>
<html>
	<title>Incription</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	<body>
		<div class="conteneur-form">
			<h2 class="title-form">Formulaire d'inscription </h2>
			<form id="form_inscription">
				<label class="nom_champs">Prenom : </label>
				<input class="champ_input" type="text" name="prenom" placeholder="Prenom">
			
				<label class="nom_champs">Nom : </label>
				<input class="champ_input" type="text" name="nom" placeholder="Nom">
			
				<label class="nom_champs">Email: </label>
				<input class="champ_input" type="email" name="email" placeholder="Email">
			
				<label class="nom_champs">Telephone : </label>
				<input class="champ_input" type="text" name="telephone" placeholder="Telephone">
			
				<label class="nom_champs">Pseudo : </label>
				<input class="champ_input" type="text" name="pseudo" placeholder="Pseudo">
			
				<label class="nom_champs">Mot de passe : </label>
				<input class="champ_input" type="password" name="mdp" placeholder="Mot de passe">
			
				<label class="nom_champs">Statut : </label>
				<input class="champ_input" type="text" name="statut" placeholder="Statut">
			
				<label class="nom_champs">Adresse : </label>
				<input class="champ_input" type="text" name="adresse" placeholder="Adresse">
			
				<label class="nom_champs">Ville : </label>
				<input class="champ_input" type="text" name="ville" placeholder="Ville">
			
				<label class="nom_champs">Pays : </label>
				<input class="champ_input" type="text" name="pays" placeholder="Pays">
			
				<label class="nom_champs">Age : </label>
				<input class="champ_input" type="text" name="age" placeholder="Age">

				<label class="nom_champs">Notes :</label>
				<input class="champ_input" type="text" name="notes" placeholder="Notes">

				<label class="nom_champs">Etat Civil : </label>
				<select id="champs_select">
					<option>M</option>
					<option>F</option>
				</select>

				<input type="submit" value="inscription" class="btn_connexion">
			</form>
		</div>
	</body>
</html>