<?php


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
	if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password2'])&&isset($_POST['DoB'])&&isset($_POST['emailAddress'])&&isset($_POST['departement'])&&isset($_POST['localisation'])&&isset($_POST['gender']))
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
	$newuser= new User($_POST['pseudo'],$_POST['emailAddress'],$pass,$_POST['DoB'],$_POST['localisation'],$_POST['gender'],$_POST['departement'],'','','');


	//appel du model
	if(User::registerUser($newuser))
		{
		$_SESSION['message'] = "Merci, vous etes bien inscrit ! ";
		header("location:./template/MessageEtape.php");//redirection vers une page disant bravo t'as reussit \o/
	}
	else
	{
	$_SESSION['messageErreur'] = "Oops! An error occured...";
	header("location:./template/inscription.php");
	}


	}
	else {
	$_SESSION['messageErreur'] = "Oops! Tous les champs ne sont pas remplis ;)";
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
			if($chemin == '')
				$chemin = $user->picture;
			
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

	//sert ‡ visualiser un user autre que soit mÍme
	function c_visualiserUser($Nom)
	{
		$me = unserialize($_SESSION['user']);
		$user = new user('','','','','','','','','');
		$user->getUser($Nom);
		if($user->picture == '')
			$user->picture	= './../pictures/inconnu.bmp';
				
		$_SESSION['userToShow'] = serialize($user);

		//liste des groupes auquels ont est createur
		$listeGroup[] = Group::GetAllGroupIAmCreator($me->login);
		
		
		//ajout en session des groupe auquels on est createur
		$_SESSION['listeGroup'] = $listeGroup;
		//dans le fichier cible  -> appel ‡ index pour ajout dans groupe + alerte groupe/membre cible 
		
		header('location:./template/Profil.php');

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