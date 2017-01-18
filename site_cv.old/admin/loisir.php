<?php
require ('../connexion/connexion.php');
require ('fonction.php');
$page = 'Espaces loisirs';
require('head.php');

/* SUPPRESSION D'UN PRODUIT */

include 'suppression_loisir.php';

/* ENREGISTRER UN NOUVEAU PRODUIT DANS LA BDD */

if($_POST){

	if(isset($_GET['action']) && $_GET['action'] == 'ajout'){

	$resultat = $pdo -> prepare("INSERT INTO loisir(id_loisir,loisir,titre_loisir) VALUES(:id_loisir,:loisir,:titre_loisir)");
	}
	else{
		$resultat = $pdo -> prepare("REPLACE INTO loisir(id_loisir, loisir, titre_loisir) VALUES(:id_loisir,:loisir,:titre_loisir)");

		$resultat -> bindParam(':id_loisir',$_POST['id_loisir'],PDO::PARAM_INT);
		$produit .= '<div class="validation">La loisir <b>'. $_POST['titre_loisir'] . '</b> a bien été modifier</div>';
	} // Message de validation lors d'un ajout

	/*print_r($_POST);*/

	$resultat -> bindParam(':id_loisir',$_POST['id_loisir'],PDO::PARAM_INT);
	$resultat -> bindParam(':loisir',$_POST['loisir'],PDO::PARAM_STR);
	$resultat -> bindParam(':titre_loisir',$_POST['titre_loisir'],PDO::PARAM_STR);
	$resultat -> execute();
	$produit .= '<div class="validation">La loisir <b>'. $_POST['titre_loisir'] . '</b> a bien été ajoute</div>';
}


	$produit .='<div class="conteneur"><br/><a href="?action=affichage" style="display:block;text-align:center;text-decoration:none;color:#fff;font-weight:bold;padding:10px;background:#343D54;border-radius:3px">Affichage des loisirs </a><br/><br/>'.'<br/><a href="?action=ajout" style="display:block;text-align:center;text-decoration:none;color:#fff;font-weight:bold;padding:10px;background:#343D54;border-radius:3px">Ajout d\'un loisir </a><br/><br/></div>';

if(isset($_GET['action']) && $_GET['action'] == 'affichage'){

	$resultat = $pdo -> query("SELECT * FROM loisir");
	$produit .= '<div class="conteneur">';
    $produit .= '<br><h2 style="color:#6D9A97; margin-left:10px;">Affichage de toutes les loisirs</h2><br>';
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

    $produit .='<td><a class="modification" href="?action=modification&id_loisir='. $ligne['id_loisir'] . '"><img src ="' . RACINE_SITE .'img/edit.png" />Modifier </a></td>';
    $produit .='<td><a class="suppression" href="?action=suppression&id_loisir=' . $ligne['id_loisir'] . '"><img src ="' . RACINE_SITE .'img/delete.png" />Supprimer </a></td>';

    $produit .= '</tr>';
	}

	$produit .= '</table>';
	$produit .= '</div>';
}
require('menu_nav.php');
echo $produit;

$resultat = $pdo -> query("SELECT * FROM loisir");
// $resultat -> bindParam(':id_salle',$_POST['id_salle'],PDO::PARAM_INT);

while($loisir = $resultat -> fetch(PDO::FETCH_ASSOC)){

	$id_loisir_actuelle = ''; 
	if(isset($_GET['id_loisir'])){ // S'il y a un id_produit dans l'url on est dans le cadre d'une modification.

		$resultat2 = $pdo -> prepare("SELECT * FROM loisir WHERE id_loisir = :id_loisir");
		$resultat2 -> bindParam(':id_loisir', $_GET['id_loisir'], PDO::PARAM_INT);
		$resultat2 -> execute();
		$loisir_actuelle = $resultat2 -> fetch(PDO::FETCH_ASSOC);
		$id_loisir_actuelle = $loisir_actuelle['id_loisir'];
	}

}

if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')){

	if(isset($_GET['id_loisir'])){ // S'il y a un id_loisir dans l'url on est dans le cadre d'une modification.

		$resultat = $pdo -> prepare("SELECT * FROM loisir WHERE id_loisir = :id_loisir");
		$resultat -> bindParam(':id_loisir', $_GET['id_loisir'], PDO::PARAM_INT);
		$resultat -> execute();

$produit_actuel = $resultat -> fetch(PDO::FETCH_ASSOC);
}

	$id_loisir = 		(isset($produit_actuel['id_loisir'])) 		? $produit_actuel['id_loisir'] : '';
	$loisirs = 		(isset($produit_actuel['loisir'])) 		? $produit_actuel['loisir'] : '';
	$titre_loisir = 			(isset($produit_actuel['titre_loisir'])) 			? $produit_actuel['titre_loisir'] : '';

?>

<!-- HTML -->

<html>

<div class="conteneur">
	<form action="" method="post" enctype="">

		<input type="hidden" name="id_loisir"  class="champ_texte" value="<?= $id_loisir ?>" >

		<label>Loisir</label>
		<input type="text" name="loisir"  class="champ_texte" value="<?= $loisirs ?>" >
		
		<label>Titre du loisir</label>
		<input type="text" name="titre_loisir" class="champ_texte"  value="<?= $titre_loisir ?>" >
		
		<input type="submit" value="Enregistrer" id="envoyer_loisir">
		<div class="clear"></div>
	</form>
</div>
</html>

<?php
}
require_once('footer.php');
?>