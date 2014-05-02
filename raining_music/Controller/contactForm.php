<?php
include '../model/checkDataBase.php';

$objetContact=$_POST['SubjectChoice'];				//Objet du contact
$emetteur=$_POST['prenomNom'];						//Nom & prenom de l'emetteur
$adresseEmail=$_POST['emailAddress'];				//Adresse e-mail de l'emetteur
$numeroDeTel=$_POST['telNum'];						//Numero de telephone de l'emetteur
$messageComment=n12br($_POST['messageContact']);	//Message
$destinataire="rainingmusic.isep@gmail.com";		//Adresse email de RAINING MUSIC

$messageEtCoordonnees="Nom de l'emetteur du message:".$emetteur.".\n";
		
$headers  = 'From: <' . $adresseEmail .'>' . "\n" ;
$headers .= 'Content-Type: text/html; charset=iso-8859-15' ;
mail ($destinataire, $objetContact, $messageComment, $headers) ;
?>