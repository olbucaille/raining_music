<?php
	session_start();
	include("./../model/salle2.php");
	include("./../model/alert.php");
	require_once("./../model/user.php");
	require_once("/../db_connect.inc.php");
 

	connectMS();	
	$nom=isset($_POST['nom'])?$_POST['nom']:"";
	$date=isset($_POST['date'])?$_POST['date']:"";
	$heure=isset($_POST['heure'])?$_POST['heure']:"";
	$description=isset($_POST['description'])?$_POST['description']:"";
	$salle=isset($_POST['salle'])?$_POST['salle']:"";
	echo "=====> ".$salle;
	$id = $_POST['id'];
 	$id= $id*1+2;
 	
	if(isset($_SESSION['user']))
	{	
 		$user = unserialize($_SESSION['user']);
 		$sql = "INSERT INTO concert(Id, Nom, Date, Heure, Cout, Adresse, description,salle_acceptee,salle)
		VALUES ('$id','$nom','$date','$heure',null,null,'$description',0,'$salle')";
 	 	// si l'insertion dans la table concert est bien pass√©
 	 	echo $sql."</br>";
 	 	if(mysql_query ($sql))
	 	{
	 		// alors on insert dans la table concert_membre_organisateur
 	 			// inserer le nom de l'organisateur dans la table concert_membre_organisateur
	 			$login = $user->login;
	 		  	$sql2 = "INSERT INTO concert_membre_organise(Organisateur, Id_concert, Role) VALUES('$login','$id','')";
	 		  	echo $sql2;
 	 		  	$connexion = connect();
				$requete = $connexion->prepare($sql2);
				if($requete->execute())
				{
					// si l'insertion dans la table concert_membre_organisateur s'est bien pass√©e
					// envoyer une alerte au proprietaire 
					
			 		if(Alert::sendRequestJoinSalle($salle,$user->login,$id))
			 		{
			 			$_SESSION['message']="demande envoyÈ ! nous vous tiendrons au courant des que votre concert aura ÈtÈ acceptÈ !"; 
			 			header('Location: ./../template/MessageEtape.php');      	 		  	
			 		}
			 		else
			 		{
			 			$_SESSION['message']="dÈsolÈ, la requete n'as pu etre transmise, merci de concter nos services !";
			 			header('Location: ./../template/MessageEtape.php');
			 			
			 		}
				}
				else
				{
					$_SESSION['message']="dÈsolÈ, la requete n'as pu etre transmise, merci de concter nos services ! (insertion concert membre organise)";
					header('Location: ./../template/MessageEtape.php');
					
				}
	 	}	
	 	else
	 	{
	 		$_SESSION['message']="dÈsolÈ, la requete n'as pu etre transmise, merci de concter nos services(insertion concert dans la base) !";
	 		header('Location: ./../template/MessageEtape.php');
	 		
	 	}
		mysql_close();
	}
	else
		echo " merci de renseigner tous les champs";
 ?>