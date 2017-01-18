<?php require("../connexion/connexion.php"); ?>
<?php 

	 $resultat = $pdo -> query("SELECT * FROM utilisateur") ;
	 $utilisateur = $resultat->fetch();
 ?>

<!DOCTYPE html>
<html>
	<?php ('fonction.php'); ?>
	<?php $page= 'Bienvenu ' . $utilisateur['prenom'] ; ?>
	<?php require('head.php');?>
	<body>
	<?php include("menu_nav.php"); ?>

		<div>
			<?php
			echo '<div class="conteneur">';
			echo '<h1 class="title">Bienvenu à '.  $utilisateur['prenom'] .'</h1>';
				$date = date("d M Y");
				$heure = date("H:i:s");
				echo '<p class="txt">Nous sommes le '. $date . ' et il est ' . $heure .'</p>';
				echo '<p class="txt">Bonjour '. $utilisateur['prenom'] . ' ' .$utilisateur['nom'].'</p>' ;
				echo '<img id="image_utilisateur" src="../img/'.$utilisateur['avatar'].'"> <br>' ;
				echo '<div class="clear"></div>';
				echo '</div>';
			?>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>