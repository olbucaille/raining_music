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
			$_SESSION['message'] = "merci, vous avez ajout� une salle avec succ�s ! ";
			header("location:./template/MessageEtape.php");//redirection vers une page disant bravo t'as reussi \o/
		}
		else
		{
			$_SESSION['messageErreur'] = "Oups, cette salle existe d�j�";
			header("location:./template/creerSalle.php");
		}
	
	
	}
	else {
		$_SESSION['messageErreur'] = "oups, tous les champs ne sont pas remplis ;)";
		header("location:./template/creerSalle.php");
	}
	
	}
	
	
?>