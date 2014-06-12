<?php
include '../model/checkDataBase.php';
include './smtp.php';

$objetContact="Signaler un abus";				//Objet du contact

if (isset($_POST['login']))
$emetteur=$_POST['login'];						//Login de l'emetteur - "Visiteur" si non connecté
//test
else $emetteur="void";



if (isset($_POST['nomSignale'])) 
$personneSignalee=$_POST['nomSignale'];				//Nom de la personne/groupe/salle signalé(e)

$messageComment=$_POST['messageContact'];			//Message
$destinataire="rainingmusic.isep@gmail.com";		//Adresse email de RAINING MUSIC

$messageEtCoordonnees="Login l'emetteur du message: ".$emetteur.".\nEntite signalee: ".$personneSignalee."\nContenu du message:\n\n".$messageComment;

//$headers  = 'From: <' . $adresseEmail .'>' ;
//$headers .= 'Content-Type: text/html; charset=iso-8859-15' ;
if(mail ($destinataire, $objetContact, $messageEtCoordonnees, 'From: <'.$emetteur.'>')){
	$_SESSION['message']="Votre signalement a bien été envoyé. Nous faisons au plus vite pour résoudre le problème signalé. Merci encore de nous aider à modérer notre site.";
}else{
	$_SESSION['message']="Une erreur s'est produite lors de l'envoi du signalement. Veuillez réessayer ultérieurement.";
}

//mail("rainingmusic.isep@gmail.com","bonjour, ceci est un test", "ceci est un header de test, le message est le suivant: ")
include '../template/signalerAbus.php';
//header("location:../template/ContactPage.php");
//return;
?>