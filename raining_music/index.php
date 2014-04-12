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
	echo"ok function";
	if(isset($_POST['username']) && isset($_POST['password']) )
		if(User::identify($_POST['username'],$_POST['password']))
		header("location:./template/accueil.php");
}

//inscrire un utilisateur
function c_RegisterUser()
{
	//elements mandatory present ? 
	if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password2'])&&isset($_POST['DoB'])&&isset($_POST['emailAddress']))
	{
		//password match ?
		if($_POST['password']==$_POST['password2'])
		{
			$pass = md5($_POST['password']);
				
		}
		else {//redirection vers formulaire avec message
			$_SESSION['messageErreur'] = "oups, les mots de passes sont differents";
			header("location:./template/inscription.php");
		}
		
		if(!isset($_POST['localisation']))
			$_POST['localisation']= null;
		
		if(!isset($_POST['gender']))
			 $_POST['gender'] = null;

		//construction de l'objet user
		$newuser= new User($_POST['pseudo'],$_POST['emailAddress'],$pass,$_POST['DoB'],$_POST['localisation'],$_POST['gender']);
		
		
			//appel du model
		if(User::registerUser($newuser))
		{
			$_SESSION['message'] = "merci, vous etes bien inscrit ! ";
			header("location:./template/MessageEtape.php");//redirection vers une page disant bravo t'as reussit \o/
		}
		else
		{
			$_SESSION['messageErreur'] = "oups, an error occured";
			header("location:./template/inscription.php");
		}


	}
	else {
		$_SESSION['messageErreur'] = "oups, tous les champs ne sont pas remplis ;)";
		header("location:./template/inscription.php");
	}
	
}



?>


