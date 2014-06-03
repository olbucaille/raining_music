<?php
class Song {


	//attributs classe User

	var $nom;
	//constructeur à x champs

	function __construct($nom)
	{
		$this->nom = $nom;
	}

public static function getSongName()
{

	$connexion = connect();


	$requete = $connexion->prepare("SELECT Nom FROM piste ORDER BY ID ASC");

	if($requete->execute())//execution(pas de verification securité a faire => automatique)
	{
		$listeMusic = array();


		while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
		{
			$liste = new Song($lignes->Nom);
				
			$listeMusic[] = $liste; // ajout dans la liste

		}

	}
	return $listeMusic;
}
}