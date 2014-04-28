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
		else 
		{
			$_SESSION['message'] = "c'est bÍte mais vous vous etes trompÈ ! ";
			header("location:./template/MessageEtape.php");//redirection vers une page disant bravo t'as reussit \o/
			
		}
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
			return;
		}
		
		if(!isset($_POST['localisation']))
			$_POST['localisation']= null;
		
		if(!isset($_POST['gender']))
			 $_POST['gender'] = null;

		//construction de l'objet user
		$newuser= new User($_POST['pseudo'],$_POST['emailAddress'],$pass,$_POST['DoB'],$_POST['localisation'],$_POST['gender'],'','','');
		
		
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

//quandun utilisateur veut mofier son profil
function c_ModifMyProfile()
{
	$req='';
	if(isset($_SESSION['user']))
	{
		$user = unserialize($_SESSION['user']);
	}else 
		header("location:./template/inscription.php");

	
	
		$chemin = gererAjoutMedia($_FILES['profilePic']);
	
		$req="UPDATE membre SET image=\"$chemin\" WHERE Login=\"$user->login\";";
		//.. et dans lobjet user pour que ce soit pris en compte quand on le reserialisera
		$user->picture = $chemin;
		
		
		//y a t-il vraiment besoin d'expliquer... ? 
		if (isset($_POST['gender']))
			$user->sexe =$_POST['gender'];
		
		if (isset($_POST['emailAddress']))
			$user->mail = $_POST['emailAddress'];
		
		if (isset($_POST['nom']))
			$user->nom = $_POST['nom'];
	
		if (isset($_POST['DoB']))
			$user->DoB = $_POST['DoB'];
	
		if (isset($_POST['localisation']))
			$user->localisation = $_POST['localisation'];
		
		if (isset($_POST['commentaire']))
			$user->commentaire = $_POST['commentaire'];
		
		//envois de tout Áa au model pour enregistrement
		$user->update($req);
		
		
		header("location:./template/myProfile.php");
	
		
	

}


function gererAjoutMedia($file)
{
	
	// Testons si le fichier a bien √©t√© envoy√© et s'il n'y a pas d'erreur
	if (isset($file) AND $file['error'] == 0)
	{
		// Testons si le fichier n'est pas trop gros
		if ($file['size'] <= 10000000)
		{
			// Testons si l'extension est autoris√©e
			$infosfichier = pathinfo($file['name']);
			$extension_upload = $infosfichier['extension'];
			$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
			if (in_array($extension_upload, $extensions_autorisees))
			{
				// On peut valider le fichier et le stocker d√©finitivement
				move_uploaded_file($file['tmp_name'], './upload/' . basename($file['name']));
	
			}
	
		}
		//le chemin vers l'image...
		$chemin= './../upload/' . basename($file['name']);
		//que l'on met dans une requete ‡ executer...
		return $chemin;
	}
	
}

?>