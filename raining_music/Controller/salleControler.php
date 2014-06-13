<?php

function c_CreerSalle()
{
	
	
	//elements mandatory present ?
	if( isset($_POST['Nom']) && isset($_POST['Departement']) && isset($_POST['Adresse']) && isset($_POST['Proprietaire']) && isset($_POST['NbPlaces'])&& isset($_POST['Telephone'])&& isset($_POST['Horaires']))
	{
		
		//construction de l'objet salle
		$newsalle= new Salle($_POST['Nom']);
	
		//appel du model
		if(Salle::registerSalle($newsalle,$_POST['Departement'],$_POST['Adresse'],$_POST['Proprietaire'],$_POST['NbPlaces'], $_POST['Telephone'],$_POST['Horaires']))
		{
			$_SESSION['message'] = "merci, vous avez ajout� une salle avec succ�s !";
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