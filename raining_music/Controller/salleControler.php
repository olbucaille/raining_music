<?php
 
function c_CreerSalle()
{
	
	
	//elements mandatory present ?
	if(isset($_POST['pseudo']) && isset($_POST['role']) && isset($_POST['nom']))
	{
		
		//construction de l'objet salle
		$newsalle= new Salle($_POST['nom']);
	
		//appel du model
		if(Salle::registerSalle($newsalle,$_POST['pseudo'],$_POST['role']))
		{
			$_SESSION['message'] = "merci, vous avez ajouté une salle avec succès ! ";
			header("location:./template/MessageEtape.php");//redirection vers une page disant bravo t'as reussi \o/
		}
		else
		{
			$_SESSION['messageErreur'] = "Oups, cette salle existe déjà";
			header("location:./template/creerSalle.php");
		}
	
	
	}
	else {
		$_SESSION['messageErreur'] = "oups, tous les champs ne sont pas remplis ;)";
		header("location:./template/creerSalle.php");
	}
	
}


// permet de mettre le flag de lecture à 1
// en utilisant l'Id au lieu du type 
 function c_lire_notification()
{
 		Alert::PutFlag1($_GET['type']);
		header("location:./template/myProfile.php");
	}		
		



// accepter la demande de la salle pour un concert
	function c_AccepterDemandeSalle()
	{

		if(isset($_GET['type']))
		{
			$type =  explode("_",$_GET['type'], 3);
			$demandeur = $type[1];
			$salle = $type[2];
			$res = explode("_",$type[2]);

			if($type[0]=="ASKSALLE")
			{
				Alert::PutFlag1($_GET['type']);			
				// mettre l'attribut salle_acceptee à 1 
				// dans la table concert
					//on recupere l'id du concet en utilisant la table concert_membre_organisateur
					$sql = "select Id_concert from concert_membre_organise where Organisateur = '".$demandeur."'";
 					$connexion = connect();
					$requete= $connexion->prepare($sql);
					if($requete->execute())
					{
						$lignes=$requete->fetch(PDO::FETCH_OBJ);
						$Id_concert = $lignes->Id_concert;
						// requette pour mettre l'attribut salle_acceptee à 1
						$sql2 = "update concert set salle_acceptee = 1 where Id = '".$res[1]."'"; // ajouter le nom de la salle dans la requette
						echo "<br>".$sql2;
						
						$requete= $connexion->prepare($sql2);
						if($requete->execute())
						{
							// envoyer une alerte au demandeur pour l'informer que 
							// la salle est bien acceptée
							// je n'ai pas utilisé la classe Alert mais directement 
							// du SQL ( le code peut etre deplacer dans la classe Alert)
							$sql3 = "INSERT INTO `alerte`(`Id`, `Titre`, `Description`, `Flag_lecture`, `Type`, `Login_membre`)
											VALUES('','Demande acceptee','votre demande de salle est acceptee',0,'demandeAccepte_salle','$demandeur')";
							$requete= $connexion->prepare($sql3);
							if($requete->execute())
							{
								header("location:./template/myProfile.php");
							}

						}

					}
				



			}
		}
 		header("location:./template/myProfile.php");
	}


// refuser une demande de salle
	// accepter la demande de la salle pour un concert
	function c_RefuserDemandeSalle()
	{

		if(isset($_GET['type']))
		{
			$type =  explode("_",$_GET['type'], 3);
			$demandeur = $type[1];
			$salle = $type[2];

			if($type[0]=="ASKSALLE")
			{
				Alert::PutFlag1($_GET['type']);			
				// mettre l'attribut salle_acceptee à 1 
				// dans la table concert
					//on recupere l'id du concet en utilisant la table concert_membre_organisateur
					$sql = "select Id_concert from concert_membre_organise where Organisateur = '".$demandeur."'";
					echo $sql;
					$connexion = connect();
					$requete= $connexion->prepare($sql);
					if($requete->execute())
					{
						$lignes=$requete->fetch(PDO::FETCH_OBJ);
						$Id_concert = $lignes->Id_concert;
						// requette pour mettre l'attribut salle_acceptee à 1
						$sql2 = "update concert set salle_acceptee = 0 where Id = '".$Id_concert."'";
						echo "<br>".$sql2;
						$requete= $connexion->prepare($sql2);
						if($requete->execute())
						{
							// envoyer une alerte au demandeur pour l'informer que 
							// la salle est bien acceptée
							// je n'ai pas utilisé la classe Alert mais directement 
							// du SQL ( le code peut etre deplacer dans la classe Alert)
							$sql3 = "INSERT INTO `alerte`(`Id`, `Titre`, `Description`, `Flag_lecture`, `Type`, `Login_membre`)
											VALUES('','Demande acceptee','votre demande de salle est refusee',0,'demandeAccepte_salle','$demandeur')";
							$requete= $connexion->prepare($sql3);
							if($requete->execute())
							{
								header("location:./template/myProfile.php");
							}

						}

					}

			}
		}
 		header("location:./template/myProfile.php");
	}
	 


	
	
?>