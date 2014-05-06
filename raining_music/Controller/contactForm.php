<?php
include '../model/checkDataBase.php';
include './smtp.php';

$objetContact=$_POST['subjectChoice'];				//Objet du contact
$emetteur=$_POST['prenomNom'];						//Nom & prenom de l'emetteur
$adresseEmail=$_POST['emailAddress'];				//Adresse e-mail de l'emetteur
$numeroDeTel=$_POST['telNum'];						//Numero de telephone de l'emetteur
$messageComment=$_POST['messageContact'];			//Message
$destinataire="rainingmusic.isep@gmail.com";		//Adresse email de RAINING MUSIC

session_start();
$messageEtCoordonnees="Nom de l'emetteur du message: ".$emetteur.".\nNumero de telephone: ".$numeroDeTel."\nContenu du message:\n\n".$messageComment;
//$headers  = 'From: <' . $adresseEmail .'>' ;
//$headers .= 'Content-Type: text/html; charset=iso-8859-15' ;
if(mail ($destinataire, $objetContact, $messageEtCoordonnees, 'From: <'.$adresseEmail.'>')){
	$_SESSION['message']="Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.";
}else{
	$_SESSION['message']="Une erreur s'est produite lors de l'envoi du message. Veuillez réessayer ultérieurement.";
}

//mail("rainingmusic.isep@gmail.com","bonjour, ceci est un test", "ceci est un header de test, le message est le suivant: ")
include '../template/ContactPage.php';
//header("location:../template/ContactPage.php");
//return;
?>