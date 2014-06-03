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
			$_SESSION['message'] = "merci, vous avez cr�� un groupe avec succ�s ! ";
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
	
	//action � faire pour rejoindre un goupe
	function c_RejoindreGroupe()
	{
		
		if(isset($_GET['groupe']))
		{
			if(isset($_SESSION['user']))
				$user = unserialize($_SESSION['user']);
			
			if(Group::AddUserToGroup($_GET['groupe'],$user->login))
			{
				Alert::sendRequestJoinUser($_GET['groupe'],$user->login);
				
					$_SESSION['message'] = "requete envoy� ! en attente de confirmation \o/";
					header("location:./template/MessageEtape.php");
			
				
				
			}
			else
			{
				if(!Group::verifyMemberValidate($user->login,$_GET['groupe']))
					$_SESSION['message'] = "Vous avez d�j� une requete en cours, elle n'as pas encore �t� trait�... soyez patients ! ";
				else 	
					$_SESSION['message'] = "Vous faites d�j� parti du groupe TT";
				
				header("location:./template/MessageEtape.php");
			}
			
		}
	}
	
	
	//refuser une adhsion � un groupe (supression de la valeur dans membre_groupe)
	function c_RefuserAdhsionGroupe()
	{
		$type;
		if(isset($_GET['type']))
		{
			$type =  explode("_",$_GET['type'], 3);
			
			if($type[0]=="ASK")
			{
				Alert::PutFlag1($_GET['type']);
				Group::RemoveMembre_Group($type[1],$type[2]);
			}
		}
		header("location:./template/myProfile.php");
	}

	//accepter adhesion � un groupe(validation table membre goupe)
	function c_AccepterAdhesionGroupe()
	{
		$type;
		if(isset($_GET['type']))
		{
			$type =  explode("_",$_GET['type'], 3);
				
			if($type[0]=="ASK")
			{
				Alert::PutFlag1($_GET['type']);
				Group::AcceptMembre_Group($type[1],$type[2]);
			}
		}
		header("location:./template/myProfile.php");
		
		
	}

?>