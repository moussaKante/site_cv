
<?php 
if (isset($_GET['action']) && $_GET['action'] == 'suppression'){
     $resultat = $pdo -> prepare("SELECT * FROM experiences WHERE id_experience = :id_experience");
     $resultat -> bindParam(':id_experience',$_GET['id_experience'],PDO::PARAM_INT);
     $resultat -> execute();
     // Le resultat doit apparaitre sousforme de tableau on fait un PDO::FETCH_ASSOC
      $produit_a_supprimer = $resultat -> fetch(PDO::FETCH_ASSOC);

      $resultat = $pdo -> prepare("DELETE FROM experiences WHERE id_experience = :id_experience");
      $resultat -> bindParam(':id_experience',$_GET['id_experience'],PDO::PARAM_INT);
      $resultat -> execute();
      $produit .= '<div class="validation">L\'exprience <b>'. $_GET['id_experience'] . '</b> a bien été supprimé</div>';
      //$_GET['action'] = 'affichage';
      header('location:?action=affichage');
 }
 ?>
