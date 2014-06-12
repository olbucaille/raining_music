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
$extension  = substr($nom_file,-3); // R�cup�ration de l'extension


//---------------------------
//  SCRIPT D'UPLOAD
//---------------------------

if($_POST['posted'])
{

  if($erreur > 0) {       
    switch($erreur) {
      case 1: // R�glages du serveur
      case 2: // R�glages du formulaire
        echo "Fichier trop grand !";
        break;
      case 3:
        echo "Le serveur n'a pas re�u un fichier complet !";
        break;
      case 4:
        echo "Votre fichier est vide !";
        break;
      default:
        echo "Erreur inconnue.";
        break;
    }
  }
  // On v�rifie si le champ est rempli
  elseif($_FILES['fichier']['name']) 
  {
  	// On v�rifie l'extension du fichier
  	if(in_array(strtolower($extension),$extensions_ok))
  	{
  	
  		// On v�rifie les dimensions et taille 
  	
  		if(($taille <= $max_size))
  		{
  			// Si c'est OK, on teste l'upload
  			if (file_exists($chemin))
  			{
  				echo $_FILES["fichier"]["name"] . " already exists. ";
  			}
  			elseif(move_uploaded_file($tmp,$chemin))
  			{  				// Si upload OK alors on affiche le message de r�ussite
  				echo '<p>Fichier upload� avec succ�s !</p>';
  				echo '<ul><li>Fichier : '.$_FILES['fichier']['name'].'</li>';
  				echo '<li>Taille : '.$_FILES['fichier']['size'].' Octets</li>';
  				echo '<li>Sauvegard� dans: '. $chemin.'</li>';	
  				
  				echo '<p align=center><b> Redirection dans 3 secondes </b> </p>';

  				$nom_fichier=explode(".",$nom_file);
  				$nom_groupe = $_POST['groupe'];
  				$nom_album  = $_POST['album'];
  				$req="INSERT INTO piste(Nom,Album,Groupe) VALUES(\"$nom_fichier[0]\", \"$nom_album\", \"$nom_groupe\")";
  				
  				//.. et dans lobjet user pour que ce soit pris en compte quand on le reserialisera
  				$connexion = connect();
  				$requete= $connexion->prepare($req); //preparation requete
  				$requete->execute();//execution(pas de verification securit� a faire => automatique)
  				header("Refresh: 3; URL=./template/Redirection.php");

  			}
  			else
  			{
  	
  				// Sinon on affiche une erreur syst�me
  				echo '<p>Probl�me lors de l\'upload !</p>';
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
  				echo "Le fichier $fichier a �t� supprim� avec succ�s";
  				$req="DELETE FROM piste WHERE Nom = \"".$_POST['chansons']."\"";
  			  				
  			//.. et dans lobjet user pour que ce soit pris en compte quand on le reserialisera
  			$connexion = connect();
  			$requete= $connexion->prepare($req); //preparation requete
  			$requete->execute();//execution(pas de verification securit� a faire => automatique)
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
  	

 