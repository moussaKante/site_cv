<?php
require ('../connexion/connexion.php');
require ('fonction.php');
$page = 'Espaces experiences';
require('head.php');

/* SUPPRESSION D'UN PRODUIT */

include 'suppression_experience.php';

/* ENREGISTRER UN NOUVEAU PRODUIT DANS LA BDD */

if($_POST){

	if(isset($_GET['action']) && $_GET['action'] == 'ajout'){

	$resultat = $pdo -> prepare("INSERT INTO experiences(id_experience,titre_exp,sous_titre_exp,dates,description) VALUES(:id_experience,:titre_exp,:sous_titre_exp,:dates,:description)");
	}
	else{
		$resultat = $pdo -> prepare("REPLACE INTO experiences(id_experience,titre_exp,sous_titre_exp,dates,description) VALUES(:id_experience,:titre_exp,:sous_titre_exp,:dates,:description)");

		$resultat -> bindParam(':id_experience',$_POST['id_experience'],PDO::PARAM_INT);
		$produit .= '<div class="validation">L\' experience <b>'. $_POST['titre_exp'] . '</b> a bien été modifier</div>';
	} // Message de validation lors d'un ajout

	/*print_r($_POST);*/

	$resultat -> bindParam(':id_experience',$_POST['id_experience'],PDO::PARAM_INT);
	$resultat -> bindParam(':titre_exp',$_POST['titre_exp'],PDO::PARAM_STR);
	$resultat -> bindParam(':sous_titre_exp',$_POST['sous_titre_exp'],PDO::PARAM_STR);
	$resultat -> bindParam(':dates',$_POST['dates'],PDO::PARAM_INT);
	$resultat -> bindParam(':description',$_POST['description'],PDO::PARAM_STR);
	/*$resultat -> bindParam(':id_competence',$_POST['id_competence'],PDO::PARAM_INT);*/
	$resultat -> execute();
	$produit .= '<div class="validation">L\' experience <b>'. $_POST['titre_exp'] . '</b> a bien été ajoute</div>';
}


	$produit .='<div class="conteneur"><br/><a href="?action=affichage" style="display:block;text-align:center;text-decoration:none;color:#fff;font-weight:bold;padding:10px;background:#343D54;border-radius:3px">Affichage des expériences </a><br/><br/>'.'<br/><a href="?action=ajout" style="display:block;text-align:center;text-decoration:none;color:#fff;font-weight:bold;padding:10px;background:#343D54;border-radius:3px">Ajout d\'une expérience </a><br/><br/></div>';

if(isset($_GET['action']) && $_GET['action'] == 'affichage'){

	$resultat = $pdo -> query("SELECT * FROM experiences");
	$produit .= '<div class="conteneur">';
    $produit .= '<br><h2 style="color:#6D9A97; margin-left:10px;">Affichage de toutes les expériences</h2><br>';
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

    $produit .='<td><a class="modification" href="?action=modification&id_experience='. $ligne['id_experience'] . '"><img src ="' . RACINE_SITE .'img/edit.png" />Modifier </a></td>';
    $produit .='<td><a class="suppression" href="?action=suppression&id_experience=' . $ligne['id_experience'] . '"><img src ="' . RACINE_SITE .'img/delete.png" />Supprimer </a></td>';

    $produit .= '</tr>';
	}

	$produit .= '</table>';
	$produit .= '</div>';
}
require('menu_nav.php');
echo $produit;

$resultat = $pdo -> query("SELECT * FROM experiences");
// $resultat -> bindParam(':id_salle',$_POST['id_salle'],PDO::PARAM_INT);

while($experience = $resultat -> fetch(PDO::FETCH_ASSOC)){

	$id_experience_actuelle = ''; 
	if(isset($_GET['id_experience'])){ // S'il y a un id_produit dans l'url on est dans le cadre d'une modification.

		$resultat2 = $pdo -> prepare("SELECT * FROM experiences WHERE id_experience = :id_experience");
		$resultat2 -> bindParam(':id_experience', $_GET['id_experience'], PDO::PARAM_INT);
		$resultat2 -> execute();
		$experience_actuelle = $resultat2 -> fetch(PDO::FETCH_ASSOC);
		$id_experience_actuelle = $experience_actuelle['id_experience'];
	}

}

if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')){

	if(isset($_GET['id_experience'])){ // S'il y a un id_experience dans l'url on est dans le cadre d'une modification.

		$resultat = $pdo -> prepare("SELECT * FROM experiences WHERE id_experience = :id_experience");
		$resultat -> bindParam(':id_experience', $_GET['id_experience'], PDO::PARAM_INT);
		$resultat -> execute();

$produit_actuel = $resultat -> fetch(PDO::FETCH_ASSOC);
}

	$id_experience = 			(isset($produit_actuel['id_experience'])) 		? $produit_actuel['id_experience'] : '';
	$titre_exp = 				(isset($produit_actuel['titre_exp'])) 		? $produit_actuel['titre_exp'] : '';
	$sous_titre_exp = 			(isset($produit_actuel['sous_titre_exp'])) 			? $produit_actuel['sous_titre_exp'] : '';
	$dates = 					(isset($produit_actuel['dates'])) 			? $produit_actuel['dates'] : '';
	$description = 				(isset($produit_actuel['description'])) 			? $produit_actuel['description'] : '';
	/*$id_competence = 			(isset($produit_actuel['id_competence'])) 			? $produit_actuel['id_competence'] : '';*/
?>

<!-- HTML -->

<html>
<div class="conteneur">
	<form class ="form_exp" action="" method="post" enctype="">

		<input type="hidden" name="id_experience"  class="champ_texte" value="<?= $id_experience ?>" >

		

		<label>Titre de l'experiences :</label>
		<input type="text" name="titre_exp"  class="champ_texte" value="<?= $titre_exp ?>" >
		
		<label>Sous titre de l'experience : </label>
		<input type="text" name="sous_titre_exp" class="champ_texte"  value="<?= $sous_titre_exp ?>" >

		<label>Dates :</label>
		<input type="text" name="dates" class="champ_texte"  value="<?= $dates ?>" >

		<label>Description :</label>
		<textarea col="25" rows="1" style="resize:none;margin-top:12px;" id="editor1" name="description" class="champ_texte" ><?= $description ?></textarea>
		<script>
			CKEDITOR.replace('editor1');
		</script>
		
		<input type="submit" value="Enregistrer" id="send">
		<div class="clear"></div>
	</form>
</div>
</html>

<?php
}
require_once('footer.php');
?>