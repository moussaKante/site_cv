<?php require("../connexion/connexion.php"); ?>
<?php 
	session_start();

	if(isset($_SESSION['connexion'])&& $_SESSION['connexion'] == 'connecté') {
		$id_utilisateur=$_SESSION['id_utilisateur'];
		$prenom=$_SESSION['prenom'];
		$nom=$_SESSION['nom'];
	}else{
		header('location:authentification.php');
	}

	if (isset($_GET['deconnect'])) {
		$_SESSION['connexion']='';
		$_SESSION['id_utilisateur']='';
		$_SESSION['prenom']='';
		$_SESSION['nom']='';

		unset($_SESSION['connexion']);

		session_destroy();

		header('location:../index.php');
	}


	 $resultat = $pdo -> query("SELECT * FROM utilisateur") ;
	 $utilisateur = $resultat->fetch();
 ?>

<!DOCTYPE html>
<html>
	<?php ('fonction.php'); ?>
	<?php $page= 'Bienvenu ' . $_SESSION['prenom'] ; ?>
	<?php require('head.php');?>
	<body>
	<?php include("menu_nav.php"); ?>

		<div>
			<?php
			echo '<div class="conteneur">';
			echo '<h1 class="title">Bienvenu à '.  $_SESSION['prenom'] .'</h1>';
				$date = date("d M Y");
				$heure = date("H:i:s");
				echo '<p class="txt">Nous sommes le '. $date . ' et il est ' . $heure .'</p>';
				echo '<p class="txt">Bonjour '. $_SESSION['prenom'] . ' ' .$_SESSION['nom'].'</p>' ;
				echo '<img alt="utilisateur_image" id="image_utilisateur" src="../img/'.$utilisateur['avatar'].'"> <br>' ;
				echo '<div class="clear"></div>';
				echo '</div>';
			?>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>