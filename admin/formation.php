<?php
require ('../connexion/connexion.php');
require ('fonction.php');
$page = 'Espace formation';
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

include 'suppression_formation.php';

/* ENREGISTRER UN NOUVEAU PRODUIT DANS LA BDD */

if($_POST){

	if(isset($_GET['action']) && $_GET['action'] == 'ajout'){

	$resultat = $pdo -> prepare("INSERT INTO formation(id_formation,titre_formation,sous_titre_formation,dates_formation,description_formation) VALUES(:id_formation,:titre_formation,:sous_titre_formation,:dates_formation,:description_formation)");
	}
	else{
		$resultat = $pdo -> prepare("REPLACE INTO formation(id_formation,titre_formation,sous_titre_formation,dates_formation,description_formation) VALUES(:id_formation,:titre_formation,:sous_titre_formation,:dates_formation,:description_formation)");

		$resultat -> bindParam(':id_formation',$_POST['id_formation'],PDO::PARAM_INT);
		$produit .= '<div class="validation">La formation <b>'. $_POST['titre_formation'] . '</b> a bien été modifier</div>';
	} // Message de validation lors d'un ajout

	/*print_r($_POST);*/

	$resultat -> bindParam(':id_formation',$_POST['id_formation'],PDO::PARAM_INT);
	$resultat -> bindParam(':titre_formation',$_POST['titre_formation'],PDO::PARAM_STR);
	$resultat -> bindParam(':sous_titre_formation',$_POST['sous_titre_formation'],PDO::PARAM_STR);
	$resultat -> bindParam(':dates_formation',$_POST['dates_formation'],PDO::PARAM_STR);
	$resultat -> bindParam(':description_formation',$_POST['description_formation'],PDO::PARAM_STR);
	$resultat -> execute();
	$produit .= '<div class="validation">La formation <b>'. $_POST['titre_formation'] . '</b> a bien été ajoute</div>';
}


	$produit .='<div class="conteneur"><br/><a href="?action=affichage" style="display:block;text-align:center;text-decoration:none;color:#fff;font-weight:bold;padding:10px;background:#343D54;border-radius:3px">Affichage des formations </a><br/><br/>'.'<br/><a href="?action=ajout" style="display:block;text-align:center;text-decoration:none;color:#fff;font-weight:bold;padding:10px;background:#343D54;border-radius:3px">Ajout d\'une formation </a><br/><br/></div>';

if(isset($_GET['action']) && $_GET['action'] == 'affichage'){

	$resultat = $pdo -> query("SELECT * FROM formation");
	$produit .= '<div class="conteneur">';
    $produit .= '<br><h2 style="color:#6D9A97; margin-left:10px;">Affichage de toutes les formations</h2><br>';
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

    $produit .='<td><a class="modification" href="?action=modification&id_formation='. $ligne['id_formation'] . '"><img src ="' . RACINE_SITE .'img/edit.png" />Modifier </a></td>';
    $produit .='<td><a class="suppression" href="?action=suppression&id_formation=' . $ligne['id_formation'] . '"><img src ="' . RACINE_SITE .'img/delete.png" />Supprimer </a></td>';

    $produit .= '</tr>';
	}

	$produit .= '</table>';
	$produit .= '</div>';
}
require('menu_nav.php');
echo $produit;

$resultat = $pdo -> query("SELECT * FROM formation");
// $resultat -> bindParam(':id_salle',$_POST['id_salle'],PDO::PARAM_INT);

while($formation = $resultat -> fetch(PDO::FETCH_ASSOC)){

	$id_formation_actuelle = ''; 
	if(isset($_GET['id_formation'])){ // S'il y a un id_produit dans l'url on est dans le cadre d'une modification.

		$resultat2 = $pdo -> prepare("SELECT * FROM formation WHERE id_formation = :id_formation");
		$resultat2 -> bindParam(':id_formation', $_GET['id_formation'], PDO::PARAM_INT);
		$resultat2 -> execute();
		$formation_actuelle = $resultat2 -> fetch(PDO::FETCH_ASSOC);
		$id_formation_actuelle = $formation_actuelle['id_formation'];
	}

}

if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')){

	if(isset($_GET['id_formation'])){ // S'il y a un id_formation dans l'url on est dans le cadre d'une modification.

		$resultat = $pdo -> prepare("SELECT * FROM formation WHERE id_formation = :id_formation");
		$resultat -> bindParam(':id_formation', $_GET['id_formation'], PDO::PARAM_INT);
		$resultat -> execute();

$produit_actuel = $resultat -> fetch(PDO::FETCH_ASSOC);
}

	$id_formation = 		(isset($produit_actuel['id_formation'])) 		? $produit_actuel['id_formation'] : '';
	$titre_formation = 			(isset($produit_actuel['titre_formation'])) 			? $produit_actuel['titre_formation'] : '';
	$sous_titre_formation = 		(isset($produit_actuel['sous_titre_formation'])) 		? $produit_actuel['sous_titre_formation'] : '';
	$dates_formation = 		(isset($produit_actuel['dates_formation'])) 		? $produit_actuel['dates_formation'] : '';
	$description_formation = 		(isset($produit_actuel['description_formation'])) 		? $produit_actuel['description_formation'] : '';

?>

<!-- HTML -->

<html>

<div class="conteneur">
	<form action="" method="post" enctype="">
	<table class="tableau_connexion">
		<thead>
			<tr>
				<td class="tableRow"><input type="hidden" name="id_formation"  class="champ_texte" value="<?= $id_formation ?>" ></td>
			</tr>
			<tr>
				<th class="Thead">Description de la formations</th>
				<td class="tableRow" ><textarea col="25" rows="1" style="resize:none;margin-top:12px;" id="editor1"  name="description_formation"  class="champ_texte" ><?= $description_formation ?></textarea>
				<script>
					CKEDITOR.replace('editor1');
				</script></td>
			</tr>
			<tr>
				<th class="Thead">Titre de la compétence</th>
				<td class="tableRow"><input type="text" name="titre_formation" class="champ_texte"  value="<?= $titre_formation ?>" ></td>
			</tr>
			<tr>
				<th class="Thead">Sous titre de la compétence</th>
				<td class="tableRow"><input type="text" name="sous_titre_formation" class="champ_texte"  value="<?= $sous_titre_formation ?>" ></td>
			</tr>
			<tr>
				<th class="Thead">Dates de la compétence</th>
				<td class="tableRow"><input type="text" name="dates_formation" class="champ_texte"  value="<?= $dates_formation ?>" ></td>
			</tr>
		</thead>
		<tr>
			<td class="tableRow"><input  type="submit" class="btn_connexion" value="Enregistrer" id="envoyer"></td>
		</tr>
	</table>
		<div class="clear"></div>
	</form>
</div>
</html>

<?php
}
require_once('footer.php');
?>