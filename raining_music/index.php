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
	case '\'creerSalle\'':
		c_CreerSalle();
		break;	
	case '\'rejoindre_groupe\'':	
		c_RejoindreGroupe();
		break;
	case '\'upload_music\'':
		c_UploadMusic();
		break;
	case '\'refuser_adhesion_membre_groupe\'':
		c_RefuserAdhsionGroupe();
		break;
	case '\'accepter_adhesion_membre_groupe\'':
		c_AccepterAdhesionGroupe();
		break;
	case '\'visualiser_User\'':
		c_visualiserUser($_GET['Nom']);
		break;
	case '\'proposer_adhesion_membre_groupe\'':
		c_proposer_adhesion_membre_groupe($_GET['user'],$_GET['groupe']);
		break;		
	default :
		header("location:./template/accueil.php");
}

?>
