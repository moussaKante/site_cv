<?php require '../connexion/connexion.php';?>
<?php 

session_start();// à mettre dans toutes les pages Session et identifiaction 

if (isset($_POST['connexion'])) {
	
	$pseudo=addslashes($_POST['pseudo']);
	$mdp=addslashes($_POST['mdp']);

		$resultat = $pdo->prepare("SELECT * FROM utilisateur WHERE pseudo='$pseudo' AND mdp='$mdp' ");
		$resultat->execute();
		$nbr_utilisateur=$resultat->rowCount();

		if($nbr_utilisateur==0){
			$msg_connexion_err="Erreur d'authentification !";
		}else{
			$utilisateur = $resultat->fetch();
			echo $pseudo;
			$_SESSION['connexion']='connecté';
			$_SESSION['id_utilisateur']=$utilisateur['id_utilisateur'];
			$_SESSION['prenom']=$utilisateur['prenom'];
			$_SESSION['nom']=$utilisateur['nom'];

			header('location:index.php');

		}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
</head>
<!-- <header>
	<nav class="menu">
	<a id="logo" href="index.php">Thomas <span>Kante</span></a>
		<table class="tableau_connexion">
			<tbody>
				<tr>
					<td class="tableRow" class="tableRow1">
						<label class="nom_champs_connexion">Pseudo : </label>
					</td>
					<td class="tableRow" id="tableRow2">
						<label class="nom_champs_connexion">Mot de passe : </label>
					</td>
				</tr>
				<tr>
					<td class="tableRow" id="tableRow3">
						<input class="nom_champs_login" type="text" name="pseudo" placeholder="Pseudo" required>
					</td>
					<td class="tableRow">
						<input class="nom_champs_login" type="password" name="mdp" placeholder="Mot de passe" required>
					</td>
					<td class="tableRow">
					<button class="btn_connexion">connexion</button>
					</td>
				</tr>
				<tr>
					<td class="tableRow" id="tableRow4">
						<a href="" id="mdp_oublie">Mot de passe oublié</a>
					</td>
				</tr>
			</tbody>
		</table>
			<div class="clear"></div>
	</nav>
</header> -->
<body>
	<div class="conteneur-form">
	<?php //require ('inscription.php'); ?>
		<h2 class="title-form">Formulaire de connexion </h2>
		<p style="text-align: center;color:#343D54;padding: 5px;">Bonjour, veuillez vous identifier pour acceder à votre espace admin</p>
		<form id="form_connexion" method="post">
			<label class="nom_champs">Pseudo </label>
			<input class="champ_input" type="text" name="pseudo" placeholder="Pseudo" required>
			<label class="nom_champs">Mot de passe </label>
			<input class="champ_input" type="password" name="mdp" placeholder="Mot de passe" required>
			<input type="reset" class="btn_connexion" value="Effacer">
			<input type="submit" name="connexion" value="Connexion" class="btn_connexion" >
			<a href="#" id="mdp_oublie">Mot de passe oublié</a>
			</form>
		</div>
</body>
</html>