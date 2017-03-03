<?php 
if (isset($_GET['action']) && $_GET['action'] == 'suppression'){
     $resultat = $pdo -> prepare("SELECT * FROM contact WHERE id_contact = :id_contact");
     $resultat -> bindParam(':id_contact',$_GET['id_contact'],PDO::PARAM_INT);
     $resultat -> execute();
     // Le resultat doit apparaitre sousforme de tableau on fait un PDO::FETCH_ASSOC
      $produit_a_supprimer = $resultat -> fetch(PDO::FETCH_ASSOC);

      $resultat = $pdo -> prepare("DELETE FROM contact WHERE id_contact = :id_contact");
      $resultat -> bindParam(':id_contact',$_GET['id_contact'],PDO::PARAM_INT);
      $resultat -> execute();
      $produit .= '<div class="validation">Le contact <b>'. $_GET['id_contact'] . '</b> a bien été supprimé</div>';
      //$_GET['action'] = 'affichage';
      header('location:?action=affichage');
 }
 ?>
