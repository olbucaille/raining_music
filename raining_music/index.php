<?php
session_start();
 
global $connexion;
$connexion='';
include("controller.inc.php");
//debug
//echo $action;
switch ((string)$action) {
	case '\'deco\'':
		c_Deco();
		break;
	case '\'identifiation\'':
		echo"okcase";
		c_Identify();
		break;
	case '\'inscription_utilisateur\'':
		c_RegisterUser();
		break;
	case '\'Modification_MyProfile\'':
		c_ModifMyProfile();
		break;
	case '\'creerGroupe\'':
		c_CreerGroupe();
		break;
	case '\'rejoindre_groupe\'':	
		c_RejoindreGroupe();
		break;
	default :
		header("location:./template/accueil.php");
}

?>