<?php
session_start();
include("controller.inc.php");

//controlleur principal
// ici ont fait des test sur la variable $action pour 
//1- savoir ce que l'utilisateur attent de nous
//2- faire la requete qui convient au modele
//3- transmettre(appeller)  la bonne page/vue


//on veut se déconnecter
if(strcmp($action,'deco'))
{
	session_destroy();
	session_start();
}

//on veut s'identifier
if(strcmp($action,'identification'))
{
	//verification de la présence des variables données dans le formulaire
if(isset($_POST['username']) && isset($_POST['username']) )	
	if(identify($_POST['username'],$_POST['password'])) // appel au modele
	header("location:./template/accueil.php");//affichage de la vue 
}

if(strcmp($action,'inscription'))
{
	// rediriger vers inscription
}

//par défault !
	header("location:./template/accueil.php");

	
?>


