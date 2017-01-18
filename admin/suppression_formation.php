
<?php 
if (isset($_GET['action']) && $_GET['action'] == 'suppression'){
     $resultat = $pdo -> prepare("SELECT * FROM formation WHERE id_formation = :id_formation");
     $resultat -> bindParam(':id_formation',$_GET['id_formation'],PDO::PARAM_INT);
     $resultat -> execute();
     // Le resultat doit apparaitre sousforme de tableau on fait un PDO::FETCH_ASSOC
      $produit_a_supprimer = $resultat -> fetch(PDO::FETCH_ASSOC);

      $resultat = $pdo -> prepare("DELETE FROM formation WHERE id_formation = :id_formation");
      $resultat -> bindParam(':id_formation',$_GET['id_formation'],PDO::PARAM_INT);
      $resultat -> execute();
      $produit .= '<div class="validation">La formation <b>'. $_GET['id_formation'] . '</b> a bien été supprimé</div>';
      //$_GET['action'] = 'affichage';
      header('location:?action=affichage');
 }
 ?>
