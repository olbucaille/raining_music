<?php
 function c_UploadMusic() {
 

//--------------------------------------
//  DEFINITION DES VARIABLES
//--------------------------------------

$target     = "./media/";  // Repertoire cible          
$max_size   = 10000000*1024;     // Taille max en octets du fichier


$extensions_ok = array("mp3");                    


//------------------------------------------------------------
//  DEFINITION DES VARIABLES LIEES AU FICHIER
//------------------------------------------------------------

$erreur     = $_FILES['fichier']['error'];
$nom_file   = $_FILES['fichier']['name'];
$taille     = $_FILES['fichier']['size'];
$tmp        = $_FILES['fichier']['tmp_name'];
$chemin     = $target.$_FILES['fichier']['name'];
$extension  = substr($nom_file,-3); // Récupération de l'extension


//---------------------------
//  SCRIPT D'UPLOAD
//---------------------------

if($_POST['posted'])
{

  if($erreur > 0) {       
    switch($erreur) {
      case 1: // Réglages du serveur
      case 2: // Réglages du formulaire
        echo "Fichier trop grand !";
        break;
      case 3:
        echo "Le serveur n'a pas reçu un fichier complet !";
        break;
      case 4:
        echo "Votre fichier est vide !";
        break;
      default:
        echo "Erreur inconnue.";
        break;
    }
  }
  // On vérifie si le champ est rempli
  elseif($_FILES['fichier']['name']) 
  {
  	// On vérifie l'extension du fichier
  	if(in_array(strtolower($extension),$extensions_ok))
  	{
  	
  		// On vérifie les dimensions et taille 
  	
  		if(($taille <= $max_size))
  		{
  			// Si c'est OK, on teste l'upload
  			if (file_exists($chemin))
  			{
  				echo $_FILES["fichier"]["name"] . " already exists. ";
  			}
  			elseif(move_uploaded_file($tmp,$chemin))
  			{  				// Si upload OK alors on affiche le message de réussite
  				echo '<p>Fichier uploadé avec succès !</p>';
  				echo '<ul><li>Fichier : '.$_FILES['fichier']['name'].'</li>';
  				echo '<li>Taille : '.$_FILES['fichier']['size'].' Octets</li>';
  				echo '<li>Sauvegardé dans: '. $chemin.'</li>';	
  				
  				echo '<p align=center><b> Redirection dans 3 secondes </b> </p>';

  				$nom_fichier=explode(".",$nom_file);
  				$nom_groupe = $_POST['groupe'];
  				$nom_album  = $_POST['album'];
  				$req="INSERT INTO piste(Nom,Album,Groupe) VALUES(\"$nom_fichier[0]\", \"$nom_album\", \"$nom_groupe\")";
  				
  				//.. et dans lobjet user pour que ce soit pris en compte quand on le reserialisera
  				$connexion = connect();
  				$requete= $connexion->prepare($req); //preparation requete
  				$requete->execute();//execution(pas de verification securité a faire => automatique)
  				header("Refresh: 3; URL=./template/Redirection.php");

  			}
  			else
  			{
  	
  				// Sinon on affiche une erreur système
  				echo '<p>Problème lors de l\'upload !</p>';
  			}
  		}
  		else
  		{
  	
  			// Sinon erreur sur les dimensions et taille de l'image
  			echo '<p>Erreur dans la taille du fichier !</p>';
  		}
  	}
  	else
  	{  	
  		// Sinon on affiche une erreur pour l'extension
  		echo '<p>Votre fichier ne comporte pas une extension valide !</p>';
  	
  	}
  	}
  	else
  	{  	
  		// Sinon on affiche une erreur pour le champ vide
  		echo '<p>Le champ du formulaire est vide !</p>';
  	}
  	}
 }
  function c_DeleteMusic(){
  	$chemin= "./media/";
  	if(isset($_POST['posted'])) {
  		$nomfichier = $_POST['chansons']. ".mp3";
  		$fichier = $chemin. $nomfichier;
  		
  		if(file_exists($fichier))
  		{
  			
  			if(unlink($fichier)){
  				echo "Le fichier $fichier a été supprimé avec succès";
  				$req="DELETE FROM piste WHERE Nom = \"".$_POST['chansons']."\"";
  			  				
  			//.. et dans lobjet user pour que ce soit pris en compte quand on le reserialisera
  			$connexion = connect();
  			$requete= $connexion->prepare($req); //preparation requete
  			$requete->execute();//execution(pas de verification securité a faire => automatique)
  			echo '<p align=center><b> Redirection dans 3 secondes </b> </p>';
  			header("Refresh: 3; URL=./template/Redirection.php");
  			}	
  			else
  			echo "Erreur lors de la suppression du fichier $fichier";
  		}
  		else
  		echo "Le fichier $fichier n'existe pas";
  	}
  }
  	
  	?>
  	

 