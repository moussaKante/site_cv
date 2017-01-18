
<?php 
if (isset($_GET['action']) && $_GET['action'] == 'suppression'){
     $resultat = $pdo -> prepare("SELECT * FROM competence WHERE id_competence = :id_competence");
     $resultat -> bindParam(':id_competence',$_GET['id_competence'],PDO::PARAM_INT);
     $resultat -> execute();
     // Le resultat doit apparaitre sousforme de tableau on fait un PDO::FETCH_ASSOC
      $produit_a_supprimer = $resultat -> fetch(PDO::FETCH_ASSOC);

      $resultat = $pdo -> prepare("DELETE FROM competence WHERE id_competence = :id_competence");
      $resultat -> bindParam(':id_competence',$_GET['id_competence'],PDO::PARAM_INT);
      $resultat -> execute();
      $produit .= '<div class="validation">La competence <b>'. $_GET['id_competence'] . '</b> a bien été supprimé</div>';
      //$_GET['action'] = 'affichage';
      header('location:?action=affichage');
 }
 ?>
