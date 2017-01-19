<?php
require ('../connexion/connexion.php');
require ('fonction.php');
$page = 'Espace competence';
require('head.php');
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

/* SUPPRESSION D'UN PRODUIT */

include 'suppression_competence.php';

/* ENREGISTRER UN NOUVEAU PRODUIT DANS LA BDD */

if($_POST){

	if(isset($_GET['action']) && $_GET['action'] == 'ajout'){

	$resultat = $pdo -> prepare("INSERT INTO competence(id_competence,competence,titre_competence) VALUES(:id_competence,:competence,:titre_competence)");
	}
	else{
		$resultat = $pdo -> prepare("REPLACE INTO competence(id_competence, competence, titre_competence) VALUES(:id_competence,:competence,:titre_competence)");

		$resultat -> bindParam(':id_competence',$_POST['id_competence'],PDO::PARAM_INT);
		$produit .= '<div class="validation">La competence <b>'. $_POST['titre_competence'] . '</b> a bien été modifier</div>';
	} // Message de validation lors d'un ajout

	/*print_r($_POST);*/

	$resultat -> bindParam(':id_competence',$_POST['id_competence'],PDO::PARAM_INT);
	$resultat -> bindParam(':competence',$_POST['competence'],PDO::PARAM_STR);
	$resultat -> bindParam(':titre_competence',$_POST['titre_competence'],PDO::PARAM_STR);
	$resultat -> execute();
	$produit .= '<div class="validation">La competence <b>'. $_POST['titre_competence'] . '</b> a bien été ajoute</div>';
}


	$produit .='<div class="conteneur"><br/><a href="?action=affichage" style="display:block;text-align:center;text-decoration:none;color:#fff;font-weight:bold;padding:10px;background:#343D54;border-radius:3px">Affichage des compétences </a><br/><br/>'.'<br/><a href="?action=ajout" style="display:block;text-align:center;text-decoration:none;color:#fff;font-weight:bold;padding:10px;background:#343D54;border-radius:3px">Ajout d\'une compétence </a><br/><br/></div>';

if(isset($_GET['action']) && $_GET['action'] == 'affichage'){

	$resultat = $pdo -> query("SELECT * FROM competence");
	$produit .= '<div class="conteneur">';
    $produit .= '<br><h2 style="color:#6D9A97; margin-left:10px;">Affichage de toutes les compétences</h2><br>';
    $produit .= '<table class="table table-striped" border="1">';
    $produit .= '<tr>';

    for ($i=0; $i < $resultat -> columnCount(); $i++){
    $meta = $resultat -> getColumnMeta($i);
    $produit .= '<th>' . $meta['name'] . '</th>';
	}

	$produit .= '<th colspan ="2">Action</th>';
	$produit .= '</tr>';


	while ($ligne = $resultat -> fetch(PDO::FETCH_ASSOC)){
	// echo '<pre>';
	// print_r($ligne);
	// echo '</pre>';
	    $produit .= '<tr>';
	    foreach($ligne as $indice => $valeur){
	        $produit .= '<td>' .$valeur. '</td>';
	    }


	/* LIENS PICTO */

    $produit .='<td><a class="modification" href="?action=modification&id_competence='. $ligne['id_competence'] . '"><img src ="' . RACINE_SITE .'img/edit.png" />Modifier </a></td>';
    $produit .='<td><a class="suppression" href="?action=suppression&id_competence=' . $ligne['id_competence'] . '"><img src ="' . RACINE_SITE .'img/delete.png" />Supprimer </a></td>';

    $produit .= '</tr>';
	}

	$produit .= '</table>';
	$produit .= '</div>';
}
require('menu_nav.php');
echo $produit;

$resultat = $pdo -> query("SELECT * FROM competence");
// $resultat -> bindParam(':id_salle',$_POST['id_salle'],PDO::PARAM_INT);

while($competence = $resultat -> fetch(PDO::FETCH_ASSOC)){

	$id_competence_actuelle = ''; 
	if(isset($_GET['id_competence'])){ // S'il y a un id_produit dans l'url on est dans le cadre d'une modification.

		$resultat2 = $pdo -> prepare("SELECT * FROM competence WHERE id_competence = :id_competence");
		$resultat2 -> bindParam(':id_competence', $_GET['id_competence'], PDO::PARAM_INT);
		$resultat2 -> execute();
		$competence_actuelle = $resultat2 -> fetch(PDO::FETCH_ASSOC);
		$id_competence_actuelle = $competence_actuelle['id_competence'];
	}

}

if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')){

	if(isset($_GET['id_competence'])){ // S'il y a un id_competence dans l'url on est dans le cadre d'une modification.

		$resultat = $pdo -> prepare("SELECT * FROM competence WHERE id_competence = :id_competence");
		$resultat -> bindParam(':id_competence', $_GET['id_competence'], PDO::PARAM_INT);
		$resultat -> execute();

$produit_actuel = $resultat -> fetch(PDO::FETCH_ASSOC);
}

	$id_competence = 		(isset($produit_actuel['id_competence'])) 		? $produit_actuel['id_competence'] : '';
	$competences = 		(isset($produit_actuel['competence'])) 		? $produit_actuel['competence'] : '';
	$titre_competence = 			(isset($produit_actuel['titre_competence'])) 			? $produit_actuel['titre_competence'] : '';

?>

<!-- HTML -->

<html>

<div class="conteneur">
	<form action="" method="post" enctype="">

		<input type="hidden" name="id_competence"  class="champ_texte" value="<?= $id_competence ?>" >

		<label>Competences</label>
		<textarea col="25" rows="1" style="resize:none;margin-top:12px;"   name="competence"  class="champ_texte" ><?= $competences ?></textarea>
		
		<label>Titre de la compétence</label>
		<input type="text" name="titre_competence" class="champ_texte"  value="<?= $titre_competence ?>" >
		
		<input type="submit" value="Enregistrer" id="envoyer">
		<div class="clear"></div>
	</form>
</div>
</html>

<?php
}
require_once('footer.php');
?>