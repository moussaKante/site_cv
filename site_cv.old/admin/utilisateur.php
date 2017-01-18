<?php require("../connexion/connexion.php"); ?>

<!DOCTYPE html>
<html>
<?php ('fonction.php'); ?>
<?php $page='Espace Utilisateur' ; ?>
<?php require('head.php'); ?>
<body>
<?php include("menu_nav.php") ?>

 
<div id="conteneur">
<h1 class="espace_utilisateur">Mon espace utilisateur</h1>
<?php $resultat = $pdo -> query("SELECT * FROM utilisateur") ;
	$utilisateur = $resultat->fetch();

		echo '<img class="image" src="../img/'.$utilisateur['avatar'].'" <br>' ;
		
?>
	<table width="500px" border="1">
		<caption>Tableau des données de l'utilisateur <?php echo $utilisateur['prenom'] ?></caption> 
		<thead>
			<th>Nom,prenom,email...</th>
			<th>Etat civils,sexe...</th>
		</thead>
			<tr>
				<td>
					<?php 
						echo 'Prenom : ' . $utilisateur['prenom'].'<br>';
						echo 'Nom : ' .$utilisateur['nom'].'<br>' ;
						echo 'Email : ' .$utilisateur['email'] ;
					?>
				</td>
				<td>
					<?php
						/*echo '<img class="image" src="../img/'.$utilisateur['avatar'].'"'.'<br>' ;*/
						echo 'Age : ' . $utilisateur['age'].' ans'.'<br>' ;
						echo $utilisateur['sexe'].'<br>' ;
						echo $utilisateur['etat_civil'].'<br>' ;
					?>
				</td>
			</tr>
			<tr>
				<td>
				<?php
						echo 'Tel : ' .$utilisateur['tel'].'<br>' ;
						echo 'Mpd : ' .$utilisateur['mdp'] .'<br>';
						echo 'Pseudo : ' .$utilisateur['pseudo'] ;

					?>
				</td>
				<td>
					<?php
						echo $utilisateur['statut'].'<br>' ;
						echo $utilisateur['adresse'] .'<br>';
						echo $utilisateur['code_postal'].'<br>' ;
						echo $utilisateur['ville'].'<br>' ;
						echo $utilisateur['pays'].'<br>' ;
						echo $utilisateur['notes'] .'<br>';
					?>
				</td>
			</tr>
	</table>
</div>


</body>
</html>
