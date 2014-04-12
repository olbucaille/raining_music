<?php
session_start();

global $connexion;
$connexion='';
include("controller.inc.php");

//echo $action;
switch ((string)$action) {
	case '\'deco\'':
		c_Deco();
		break;
	case '\'identifiation\'':
		c_Identify();
		break;
	case '\'inscription_utilisateur\'':	
		c_RegisterUser();
		break;
	default : 
		header("location:./template/accueil.php");
}


function c_Deco()
{
	session_destroy();
	session_start();
	header("location:./template/accueil.php");
}

function c_Identify()
{
	if(isset($_POST['username']) && isset($_POST['password']) )
		if(user::identify($_POST['username'],$_POST['password']))
		header("location:./template/accueil.php");
}

function c_RegisterUser()
{
//	echo"ok function";
	if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password2'])&&isset($_POST['DoB'])&&isset($_POST['localisation'])&&isset($_POST['pseudo']) && isset($_POST['gender']))
	{
		if(registerUser($_POST['pseudo'],$_POST['password'],$_POST['password2'],$_POST['DoB'],$_POST['localisation'],$_POST['pseudo'],$_POST['gender']));
		 header("location:./template/accueil.php");
	}
}



?>


