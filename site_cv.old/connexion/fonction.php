<?php 
 require('connexion/connexion.php');

 define("RACINE_SITE", "/site_cv/");

 $produit ='';
 $page='';
 $msg='';

function userConnecte(){
	// Cette fonction m'indique si l'utilisateur est connecté. Elle me permettra de gérer les droits d'accesibilité.

	if (isset($_SESSION['utilisateur'])) {
		return true;
	}else{
		return false;
	}
}
