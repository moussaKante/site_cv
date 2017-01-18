<?php require("connexion/connexion.php"); ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Thomas Kante</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
	</head>
	<body>
	<?php include("admin/menu_nav.php"); ?>

	<h1>Espace Administrateur CV</h1>
		<div>
			<?php
				$date = date("d M Y");
				$heure = date("H:i:s");
				Print( 'Nous sommes le '. $date . ' et il est ' . $heure .'<br/>');

				 $resultat = $pdo -> query("SELECT * FROM utilisateur") ;
				 $utilisateur = $resultat->fetch();
				echo 'Bonjour '. $utilisateur['prenom'] . ' ' .$utilisateur['nom'].'<br>' ;
				echo '<img class="image" src="img/'.$utilisateur['avatar'].'" <br>' ;

			?>
		</div>
		<?php include("admin/footer.php"); ?>
	</body>
</html>