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
	case '\'Modification_MyProfile\'' :
		c_ModifMyProfile ();
		break;
	default :
		header ( "location:./template/accueil.php" );
}
function c_Deco() {
	session_destroy ();
	session_start ();
	header ( "location:./template/accueil.php" );
}
function c_Identify() {
	echo "ok function";
	if (isset ( $_POST ['username'] ) && isset ( $_POST ['password'] ))
		if (User::identify ( $_POST ['username'], $_POST ['password'] ))
			header ( "location:./template/accueil.php" );
		else {
			$_SESSION ['message'] = "c'est bête mais vous vous etes trompé ! ";
			header ( "location:./template/MessageEtape.php" ); // redirection vers une page disant bravo t'as reussit \o/
		}
}

// inscrire un utilisateur
function c_RegisterUser() {
	
	// elements mandatory present ?
	if (isset ( $_POST ['pseudo'] ) && isset ( $_POST ['password'] ) && isset ( $_POST ['password2'] ) && isset ( $_POST ['DoB'] ) && isset ( $_POST ['emailAddress'] )) {
		// password match ?
		if ($_POST ['password'] == $_POST ['password2']) {
			$pass = md5 ( $_POST ['password'] );
		} else { // redirection vers formulaire avec message
			$_SESSION ['messageErreur'] = "oups, les mots de passe sont differents";
			header ( "location:./template/inscription.php" );
			return;
		}
		
		if (! isset ( $_POST ['localisation'] ))
			$_POST ['localisation'] = null;
		
		if (! isset ( $_POST ['gender'] ))
			$_POST ['gender'] = null;
			
			// construction de l'objet user
		$newuser = new User ( $_POST ['pseudo'], $_POST ['emailAddress'], $pass, $_POST ['DoB'], $_POST ['localisation'], $_POST ['gender'], '', '', '' );
		
		// appel du model
		if (User::registerUser ( $newuser )) {
			$_SESSION ['message'] = "Merci, vous etes bien inscrit ! ";
			header ( "location:./template/MessageEtape.php" ); // redirection vers une page disant bravo t'as reussit \o/
		} else {
			$_SESSION ['messageErreur'] = "oups, an error occured";
			header ( "location:./template/inscription.php" );
		}
	} else {
		$_SESSION ['messageErreur'] = "oups, tous les champs ne sont pas remplis ;)";
		header ( "location:./template/inscription.php" );
	}
}

// quandun utilisateur veut mofier son profil
function c_ModifMyProfile() {
	$req = '';
	if (isset ( $_SESSION ['user'] )) {
		$user = unserialize ( $_SESSION ['user'] );
	}
	
	// Testons si le fichier a bien Ã©tÃ© envoyÃ© et s'il n'y a pas d'erreur
	if (isset ( $_FILES ['profilePic'] ) and $_FILES ['profilePic'] ['error'] == 0) {
		// Testons si le fichier n'est pas trop gros
		if ($_FILES ['profilePic'] ['size'] <= 10000000) {
			// Testons si l'extension est autorisÃ©e
			$infosfichier = pathinfo ( $_FILES ['profilePic'] ['name'] );
			$extension_upload = $infosfichier ['extension'];
			$extensions_autorisees = array (
					'jpg',
					'jpeg',
					'gif',
					'png' 
			);
			if (in_array ( $extension_upload, $extensions_autorisees )) {
				// On peut valider le fichier et le stocker dÃ©finitivement
				move_uploaded_file ( $_FILES ['profilePic'] ['tmp_name'], './upload/' . basename ( $_FILES ['profilePic'] ['name'] ) );
			}
		}
		// le chemin vers l'image...
		$chemin = './../upload/' . basename ( $_FILES ['profilePic'] ['name'] );
		// que l'on met dans une requete à executer...
		$req = "UPDATE membre SET image=\"$chemin\" WHERE Login=\"$user->login\";";
		// .. et dans lobjet user pour que ce soit pris en compte quand on le reserialisera
		$user->picture = $chemin;
	}
	// y a t-il vraiment besoin d'expliquer... ?
	if (isset ( $_POST ['gender'] ))
		$user->sexe = $_POST ['gender'];
	
	if (isset ( $_POST ['emailAddress'] ))
		$user->mail = $_POST ['emailAddress'];
	
	if (isset ( $_POST ['nom'] ))
		$user->nom = $_POST ['nom'];
	
	if (isset ( $_POST ['DoB'] ))
		$user->DoB = $_POST ['DoB'];
	
	if (isset ( $_POST ['localisation'] ))
		$user->localisation = $_POST ['localisation'];
	
	if (isset ( $_POST ['commentaire'] ))
		$user->commentaire = $_POST ['commentaire'];
		
		// envois de tout ça au model pour enregistrement
	$user->update ( $req );
	
	header ( "location:./template/profil.php" );
}



function search() { // on verifie que l'utilisateur ait choisi entre les options : salle, groupe ou concert
	$connexion= mysql_connect('localhost', 'root', '') OR die('Ereur de connexion');
	mysql_select_db('bd_raining_music') OR die ('Erreur de sélection de la base de données');
	
	
	if (! isset ( $_POST ['kindOfObject'] )) {
		$_SESSION ['messageErreur'] = "Veuillez choisir le type de recherche que vous souhaitez effectuer";
		header ( "location:./template/RechercheAvancee.php" );
	} else {
		// barre de recherche non vide à l'envoi
		// donc envoi de la requete a la bdd
		if (isset ( $_POST ['motcleSearch'] ) && ($_POST ['motcleSearch'] != null) && ($_POST ['motcleSearch'] != "")) {
			$_SESSION ['message'] = "Les resultats de la recherche seront affiches quand on saura les afficher...";
			header ( "location:./template/RechercheAvancee.php" );
			
			
			
				
				
				
				
				
				
				
				
				
				/*// On crée la requête SQL pour la modification d'une table existante.
				// Ici, on index des colonnes en fonction des options choisies
				$sql = 'ALTER TABLE membre ADD FULLTEXT INDEX searchProfil (Login, Mail, Localisation)';
				// On envoie la requête
				$req = mysql_query ( $sql ) or die ( 'Erreur SQL !<br>' . $sql . '<br>' . mysql_error () );
			
				$searchWord = $_POST ['motcleSearch'];
				
				// On crée la requête SQL qui va nous permettre de récupérer les résultats de la recherche
				$sql = 'SELECT * FROM membre WHERE MATCH(Login, Mail, Localisation) AGAINST ($searchWord)';
				// On envoie la requête
				$req = mysql_query ( $sql ) or die ( 'Erreur SQL !<br>' . $sql . '<br>' . mysql_error () );
				
				// on fait une boucle qui va faire un tour pour chaque enregistrement
				while (isset( $data)== mysql_fetch_assoc ( $req ) ){
					// on affiche les informations de l'enregistrement en cours
					//echo '<b>' . $data ['Login'] . '</b> (' . $data ['Mail'] . ')';
					echo " $data ['Login'] .(' . $data ['Mail'] .')'";
					
					echo ' <i>Localisation : ' . $data ['Localisation'] . '</i><br>';
					
					
				}*/
			
			} else {
				$_SESSION ['messageErreur'] = "Veuillez remplir le champ de recherche avec un/plusierus mot(s) clé(s)";
				header ( "location:./template/RechercheAvancee.php" );
				
				
				if ($_POST ['kindOfObject'] == 3) 			// 0=salle 1=concert 2=groupe 3=Profil
				{
					header ( "location:./template/RechercheAvancee.php" );
					$_SESSION ['messageErreur'] = "La valeur de kindOfObject est 3";
				
					$requeteChecherLogin=mysql_query('SELECT Login, Mail FROM membre') or die ('Erreur de la requête MySQL');
						
					while($resultat=mysql_fetch_array($requeteChecherLogin)){
						echo '<p>Login:' .$resultat .'. Mail :'.$resultat.'</p>';
					}
			}
		}
	}
}


?>