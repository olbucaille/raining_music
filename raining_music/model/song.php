<?php
class Song {


	//attributs classe User

	var $nom;
	var $nom_groupe;
	//constructeur � x champs

	function __construct($nom)
	{
		$this->nom = $nom;
	}

public static function getSongName($nom_groupe)
{

	$connexion = connect();


	$requete = $connexion->prepare("SELECT Nom FROM piste WHERE Groupe='$nom_groupe' ORDER BY ID ASC");

	if($requete->execute())//execution(pas de verification securit� a faire => automatique)
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