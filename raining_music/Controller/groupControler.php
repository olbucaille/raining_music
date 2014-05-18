<?php

function c_CreerGroupe()
{
	
	
	//elements mandatory present ?
	if(isset($_POST['pseudo']) && isset($_POST['role']) && isset($_POST['nomGroupe']))
	{
		
		//construction de l'objet groupe
		$newgroup= new Group($_POST['nomGroupe']);
	
		//appel du model
		if(Group::registerGroup($newgroup,$_POST['pseudo'],$_POST['role']))
		{
			$_SESSION['message'] = "merci, vous avez créé un groupe avec succès ! ";
			header("location:./template/MessageEtape.php");//redirection vers une page disant bravo t'as reussit \o/
		}
		else
		{
			$_SESSION['messageErreur'] = "oups, an error occured, the group already exist";
			header("location:./template/creerRejoindreGroupe.php");
		}
	
	
	}
	else {
		$_SESSION['messageErreur'] = "oups, tous les champs ne sont pas remplis ;)";
		header("location:./template/creerRejoindreGroupe.php");
	}
	
	}
	
	//action à faire pour rejoindre un goupe
	function c_RejoindreGroupe()
	{
		
		if(isset($_GET['groupe']))
		{
			if(isset($_SESSION['user']))
				$user = unserialize($_SESSION['user']);
			
			Group::AddUserToGroup($_GET['groupe'],$user->login);
			Alert::sendRequestJoinUser($_GET['groupe'],$user->login);
			$_SESSION['message'] = "requete envoyé ! en attente de confirmation \o/";
			header("location:./template/MessageEtape.php");
		}
	}
	


?>