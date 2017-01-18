
<?php 
if (isset($_GET['action']) && $_GET['action'] == 'suppression'){
     $resultat = $pdo -> prepare("SELECT * FROM titre WHERE id_titre = :id_titre");
     $resultat -> bindParam(':id_titre',$_GET['id_titre'],PDO::PARAM_INT);
     $resultat -> execute();
     // Le resultat doit apparaitre sousforme de tableau on fait un PDO::FETCH_ASSOC
      $produit_a_supprimer = $resultat -> fetch(PDO::FETCH_ASSOC);

      $resultat = $pdo -> prepare("DELETE FROM titre WHERE id_titre = :id_titre");
      $resultat -> bindParam(':id_titre',$_GET['id_titre'],PDO::PARAM_INT);
      $resultat -> execute();
      $produit .= '<div class="validation">Le titre <b>'. $_GET['id_titre'] . '</b> a bien été supprimé</div>';
      //$_GET['action'] = 'affichage';
      header('location:?action=affichage');
 }
 ?>
