
<?php 
if (isset($_GET['action']) && $_GET['action'] == 'suppression'){
     $resultat = $pdo -> prepare("SELECT * FROM loisir WHERE id_loisir = :id_loisir");
     $resultat -> bindParam(':id_loisir',$_GET['id_loisir'],PDO::PARAM_INT);
     $resultat -> execute();
     // Le resultat doit apparaitre sousforme de tableau on fait un PDO::FETCH_ASSOC
      $produit_a_supprimer = $resultat -> fetch(PDO::FETCH_ASSOC);

      $resultat = $pdo -> prepare("DELETE FROM loisir WHERE id_loisir = :id_loisir");
      $resultat -> bindParam(':id_loisir',$_GET['id_loisir'],PDO::PARAM_INT);
      $resultat -> execute();
      $produit .= '<div class="validation">La loisir <b>'. $_GET['id_loisir'] . '</b> a bien été supprimé</div>';
      //$_GET['action'] = 'affichage';
      header('location:?action=affichage');
 }
 ?>
