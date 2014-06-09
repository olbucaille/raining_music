<?php

function c_CreerSalle()
{
	
	
	//elements mandatory present ?
	if( isset($_POST['Nom']) && isset($_POST['Departement']) && isset($_POST['Adresse']))
	{
		
		//construction de l'objet salle
		$newsalle= new Salle($_POST['Nom']);
	
		//appel du model
		if(Salle::registerSalle($newsalle,$_POST['Departement'],$_POST['Adresse']))
		{
			$_SESSION['message'] = "merci, vous avez ajouté une salle avec succès !";
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
	
	
?>