<?php

function c_CreerSalle()
{
	
	
	//elements mandatory present ?
	if(isset($_POST['pseudo']) && isset($_POST['role']) && isset($_POST['nomSalle']))
	{
		
		//construction de l'objet salle
		$newsalle= new Salle($_POST['nomSalle']);
	
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
	
	
	//refuser une adhsion à une salle
	
	function c_RefuserAdhsionSalle()
	{
		$type;
		if(isset($_GET['type']))
		{
			$type =  explode("_",$_GET['type'], 3);
			
			if($type[0]=="ASK")
			{
				Alert::PutFlag1($_GET['type']);
				Salle::Removesalle_memebre_possede($type[1],$type[2]);
			}
		}
		header("location:./template/myProfile.php");
	}

	//accepter adhesion à un salle(validation table salle_membre_possede)
	function c_AccepterAdhesionSalle()
	{
		$type;
		if(isset($_GET['type']))
		{
			$type =  explode("_",$_GET['type'], 3);
				
			if($type[0]=="ASK")
			{
				Alert::PutFlag1($_GET['type']);
				Group::Acceptsalle_memebre_possede($type[1],$type[2]);
			}
		}
		header("location:./template/myProfile.php");
		
		
	}

?>