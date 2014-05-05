<?php
include '../model/checkDataBase.php';

$objetContact=$_POST['subjectChoice'];				//Objet du contact
$emetteur=$_POST['prenomNom'];						//Nom & prenom de l'emetteur
$adresseEmail=$_POST['emailAddress'];				//Adresse e-mail de l'emetteur
$numeroDeTel=$_POST['telNum'];						//Numero de telephone de l'emetteur
$messageComment=$_POST['messageContact'];	//Message
$destinataire="rainingmusic.isep@gmail.com";		//Adresse email de RAINING MUSIC

$messageEtCoordonnees="Nom de l'emetteur du message: ".$emetteur.".\nNumero de telephone: ".$numeroDeTel."\nContenu du message:\n\n".$messageComment;
		
$headers  = 'From: <' . $adresseEmail .'>' . "\n" ;
$headers .= 'Content-Type: text/html; charset=iso-8859-15' ;
mail ($destinataire, $objetContact, $messageEtCoordonnees, $headers) ;
//mail("rainingmusic.isep@gmail.com","bonjour, ceci est un test", "ceci est un header de test, le message est le suivant: ")
?>