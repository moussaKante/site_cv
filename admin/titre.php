<?php
require ('../connexion/connexion.php');
require ('fonction.php');
$page = 'Espace titres';
require('head.php');

	session_start();

	if (isset($_SESSION['connexion'])&& $_SESSION['connexion'] == 'connecté') {
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

/* SUPPRESSION D'UN PRODUIT */

include 'suppression_titre.php';

/* ENREGISTRER UN NOUVEAU PRODUIT DANS LA BDD */

if($_POST){

	if(isset($_GET['action']) && $_GET['action'] == 'ajout'){

	$resultat = $pdo -> prepare("INSERT INTO titre(id_titre,titre_cv,accroche,logo) VALUES(:id_titre,:titre_cv,:accroche,:logo)");

	}else{

		$resultat = $pdo -> prepare("REPLACE INTO titre(id_titre, titre_cv, accroche,logo) VALUES(:id_titre,:titre_cv,:accroche,:logo)");

		$resultat -> bindParam(':id_titre',$_POST['id_titre'],PDO::PARAM_INT);
		$produit .= '<div class="validation">Le titre <b>'. $_POST['titre_cv'] . '</b> a bien été modifier</div>';
	}
	
	/*print_r($_POST);*/

	$resultat -> bindParam(':id_titre',$_POST['id_titre'],PDO::PARAM_INT);
	$resultat -> bindParam(':titre_cv',$_POST['titre_cv'],PDO::PARAM_STR);
	$resultat -> bindParam(':accroche',$_POST['accroche'],PDO::PARAM_STR);
	$resultat -> bindParam(':logo',$_POST['logo'],PDO::PARAM_STR);
	$resultat -> execute();
	$produit .= '<div class="validation">Le titre <b>'. $_POST['titre_cv'] . '</b> a bien été ajoute</div>';
}


	$produit .='<div class="conteneur"><br/><a href="?action=affichage" style="display:block;text-align:center;text-decoration:none;color:#fff;font-weight:bold;padding:10px;background:#343D54;border-radius:3px">Affichage des titres </a><br/><br/>'.'<br/><a href="?action=ajout" style="display:block;text-align:center;text-decoration:none;color:#fff;font-weight:bold;padding:10px;background:#343D54;border-radius:3px">Ajout d\'un titre </a><br/><br/></div>';

if(isset($_GET['action']) && $_GET['action'] == 'affichage'){

	$resultat = $pdo -> query("SELECT * FROM titre");
	$produit .= '<div class="conteneur">';
    $produit .= '<br><h2 style="color:#6D9A97; margin-left:10px;">Affichage de toutes les titres </h2><br>';
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

    $produit .='<td><a class="modification" href="?action=modification&id_titre='. $ligne['id_titre'] . '"><img src ="' . RACINE_SITE .'img/edit.png" />Modifier </a></td>';
    $produit .='<td><a class="suppression" href="?action=suppression&id_titre=' . $ligne['id_titre'] . '"><img src ="' . RACINE_SITE .'img/delete.png" />Supprimer </a></td>';

    $produit .= '</tr>';
	}

	$produit .= '</table>';
	$produit .= '</div>';
}
require('menu_nav.php');
echo $produit;

$resultat = $pdo -> query("SELECT * FROM titre");
// $resultat -> bindParam(':id_salle',$_POST['id_salle'],PDO::PARAM_INT);

while($titre = $resultat -> fetch(PDO::FETCH_ASSOC)){

	$id_titre_actuelle = ''; 
	if(isset($_GET['id_titre'])){ // S'il y a un id_produit dans l'url on est dans le cadre d'une modification.

		$resultat2 = $pdo -> prepare("SELECT * FROM titre WHERE id_titre = :id_titre");
		$resultat2 -> bindParam(':id_titre', $_GET['id_titre'], PDO::PARAM_INT);
		$resultat2 -> execute();
		$titre_actuelle = $resultat2 -> fetch(PDO::FETCH_ASSOC);
		$id_titre_actuelle = $titre_actuelle['id_titre'];
	}

}

if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')){

	if(isset($_GET['id_titre'])){ // S'il y a un id_titre dans l'url on est dans le cadre d'une modification.

		$resultat = $pdo -> prepare("SELECT * FROM titre WHERE id_titre = :id_titre");
		$resultat -> bindParam(':id_titre', $_GET['id_titre'], PDO::PARAM_INT);
		$resultat -> execute();

$produit_actuel = $resultat -> fetch(PDO::FETCH_ASSOC);
}

	$id_titre = 		(isset($produit_actuel['id_titre'])) 		? $produit_actuel['id_titre'] : '';
	$titre_cv = 		(isset($produit_actuel['titre_cv'])) 		? $produit_actuel['titre_cv'] : '';
	$accroche = 			(isset($produit_actuel['accroche'])) 			? $produit_actuel['accroche'] : '';
	$logo = 			(isset($produit_actuel['logo'])) 			? $produit_actuel['logo'] : '';


?>

<!-- HTML -->

<html>

<div class="conteneur">
	<form action="" method="post" enctype="multipart/form-data">

		<input type="hidden" name="id_titre"  class="champ_texte" value="<?= $id_titre ?>" >

		<label>Titre du CV </label>
		<input type="text" name="titre_cv"  class="champ_texte" value="<?= $titre_cv ?>" >
		
		<label>Accroche</label>
		<input type="text" name="accroche" class="champ_texte"  value="<?= $accroche ?>" >

		<label>Logo</label>
		<input type="text" name="logo" class="champ_texte" value="<?= $logo ?>" >
		
		<input type="submit" value="Enregistrer" id="envoyer">
		<div class="clear"></div>
	</form>
</div>
</html>

<?php
}
require_once('footer.php');
?>