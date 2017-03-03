<?php
require_once"../../connexion/connexion.php";
if($_POST){
    $resultat = $pdo -> prepare("INSERT INTO contact (prenom,email,telephone,message) VALUES(:prenom,:email,:telephone,:message)");
    
    $resultat -> bindParam(':prenom',$_POST['prenom'],PDO::PARAM_STR);
    $resultat -> bindParam(':email',$_POST['email'],PDO::PARAM_STR);
    $resultat -> bindParam(':telephone',$_POST['telephone'],PDO::PARAM_INT);
    $resultat -> bindParam(':message',$_POST['message'],PDO::PARAM_STR);
    $resultat -> execute();
}  
// Check for empty fields
if(empty($_POST['prenom'])      ||
   empty($_POST['email'])     ||
   empty($_POST['telephone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "Aucun argument fourni!";
   return false;
   }
   
$name = strip_tags(htmlspecialchars($_POST['prenom']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['telephone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
   
// Create the email and send the message
$to = 'thomas.kante@lepoles.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Tkante.ma6tvacoder.org:  $name";
$email_body = "Vous avez reçu un message de la part de .\n\n"."Voici les details:\n\nPrenom,Nom: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "De: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Repondre à: $email_address";   
mail($to,$email_subject,$email_body,$headers);
return true;   
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="" method="POST">
		<input type="text" name="prenom">
		<input type="text" name="email">
		<input type="text" name="telephone">
		<input type="text" name="message">

		<input type="submit">
	</form>
</body>
</html>