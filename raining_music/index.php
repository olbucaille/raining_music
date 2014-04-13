<?php
session_start ();

global $connexion;
$connexion = '';
include ("controller.inc.php");
// debug
// echo $action;
switch (( string ) $action) {
	case '\'deco\'' :
		c_Deco ();
		break;
	case '\'identifiation\'' :
		echo "okcase";
		c_Identify ();
		break;
	case '\'inscription_utilisateur\'' :
		c_RegisterUser ();
		break;
	case '\'recherche_avancee\'' :
		search ();
		break;
	default :
		header ( "location:./template/accueil.php" );
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
			$_SESSION['message'] = "c'est bête mais vous vous etes trompé ! ";
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
			$_SESSION['messageErreur'] = "oups, les mots de passe sont differents";
			header("location:./template/inscription.php");
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
			$_SESSION['message'] = "Merci, vous etes bien inscrit ! ";
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



function search()
{	//on verifie que l'utilisateur ait choisi entre les options : salle, groupe ou concert
	if(!isset($_POST['kindOfObject']))
	{
		$_SESSION['messageErreur']="Veuillez choisir le type de recherche que vous souhaitez effectuer";
		header("location:./template/RechercheAvancee.php");
	}
	else {
		//barre de recherche non vide à l'envoi
		//donc envoi de la requete a la bdd
		if(isset($_POST['motcleSearch'])&&($_POST['motcleSearch']!=null)&&($_POST['motcleSearch']!="") )
		{
			$_SESSION['message'] = "Les resultats de la recherche seront affiches quand on saura les afficher...";
			header("location:./template/RechercheAvancee.php");
			
			if($_POST['kindOfObject']==3) //0=salle 1=concert 2=groupe 3=Profil
			{
				// On crée la requête SQL pour la modification d'une table existante. 
				// Ici, on index des colonnes en fonction des options choisies
			$sql = 'ALTER TABLE Membre ADD FULLTEXT INDEX searchProfil (Login, Mail, Localisation)';
				// On envoie la requête
			$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			
			$searchWord=$_POST['motcleSearch'];
			
			// On crée la requête SQL qui va nous permettre de récupérer les résultats de la recherche
			$sql = 'SELECT * FROM Membre WHERE MATCH(Login, Mail) AGAINST ($searchWord)';
			// On envoie la requête
			$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			}
			
			/*----------------------------------------------------------------------
			 * // on fait une boucle qui va faire un tour pour chaque enregistrement
			while($data = mysql_fetch_assoc($req))
			{
				// on affiche les informations de l'enregistrement en cours
				echo '<b>'.$data['nom'].' '.$data['prenom'].'</b> ('.$data['statut'].')';
				echo ' <i>date de naissance : '.$data['date'].'</i><br>';
			}*/
		
		
		
		
		
			
		
		
		
		
		
		}
		else {
			$_SESSION['messageErreur'] = "Veuillez remplir le champ de recherche avec un/plusierus mot(s) clé(s)";
			header("location:./template/RechercheAvancee.php");
		}
	}
	


}
/*// on crée la requête SQL
		$sql = 'SELECT * FROM faq WHERE MATCH(permalien, titre) AGAINST (tutoriel mysql)';
		
		// on envoie la requête
		$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		
		// on fait une boucle qui va faire un tour pour chaque enregistrement
		while($data = mysql_fetch_assoc($req))
		{
			// on affiche les informations de l'enregistrement en cours
			echo '<b>'.$data['nom'].' '.$data['prenom'].'</b> ('.$data['statut'].')';
			echo ' <i>date de naissance : '.$data['date'].'</i><br>';
		}*/

?>


