<?php
$tab= array('error' => true);
if (isset($_POST)) {
	$pdo = new PDO('mysql:host=localhost;dbname=ajaxthomas','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
	$login= ((!isset($_POST['login'])) || empty($_POST['login']))?"":$_POST['login'];
	$password= ((!isset($_POST['password'])) || empty($_POST['password']))?"":$_POST['password'];

	$requet = $pdo->prepare("SELECT * FROM user WHERE email like :mail");// je porepare une requete sql 
	$requet->bindParam(":mail",$login);
	$requet->execute();

}else{
	$tab["message"] = "No data requet";
}
echo json_encode($tab);
