<?php require('../connexion/connexion.php'); ?>
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
<?php require('fonction.php'); ?>
<?php $page='Espace Contact' ; ?>
<?php require('head.php'); ?>
<body>
<?php include("menu_nav.php") ?>

 
<div id="conteneur">
<h1 class="espace_utilisateur">Mes Contacts</h1>
<?php require_once"suppression_contact.php"; ?>
<?php $resultat = $pdo -> query("SELECT * FROM contact") ;


		$produit .= '<div class="conteneur">';
		$produit .= '<table class="table table-striped" border="1">';
	    $produit .= '<tr>';

	    for ($i=0; $i < $resultat -> columnCount(); $i++){
	    $meta = $resultat -> getColumnMeta($i);
	    $produit .= '<th>' . $meta['name'] . '</th>';
		}

		$produit .= '<th colspan ="2">Action</th>';
		$produit .= '</tr>';


		while ($contact = $resultat -> fetch(PDO::FETCH_ASSOC)){
		// echo '<pre>';
		// print_r($contact);
		// echo '</pre>';
		    $produit .= '<tr>';
		    foreach($contact as $indice => $valeur){
		        $produit .= '<td>' .$valeur. '</td>';
		    }


		/* LIENS PICTO */

	    $produit .='<td><a class="suppression" href="?action=suppression&id_contact=' . $contact['id_contact'] . '"><img src ="../img/delete.png" />Supprimer </a></td>';

	    $produit .= '</tr>';
		}

		$produit .= '</table>';
		$produit .= '</div>';
		?>
		<?php echo $produit; ?>

</div>


</body>
</html>