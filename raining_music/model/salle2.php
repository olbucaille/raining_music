
<?php



class Salle {


	//attributs classe User

	var $nom;
	
	//constructeur à x champs

	function __construct($nom)
	{
		$this->nom = $nom; 
	}


	//inscrire une salle
	public static function registerSalle(Salle $s,$Nom,$Adresse)
	{
		//conection BDD
		$connexion = connect();

		//construction requete
		$requete= $connexion->prepare("INSERT INTO salle(Nom) VALUES(\"$s->nom\")"); //preparation requete
		echo  "INSERT INTO salle(Nom) VALUES(\"$s->nom\")";
		if($requete->execute())//execution(pas de verification securité a faire => automatique)
		{
			$requete= $connexion->prepare("INSERT INTO salle_membre_possede(Nom, Adresse_Salle,Role,Valide,Creator) VALUES(\"$g->nom\",\"$Adresse_Salle\",\"$role\",1,1)"); //preparation requete

			echo $Nom;
			if($requete->execute())
				return true;
			else
				return false;
		}
		else
			return false;
	}


	//inscrire une salle
	public static function AddUserToSalle($s,$nom)
	{
		//conection BDD
		$connexion = connect();

		$requete= $connexion->prepare("INSERT INTO salle_membre_possede(Nom_Salle,Proprietaire_Salle,Role,Valide) VALUES(\"$s\",\"$login\",\"\",0)"); //preparation requete
		echo "INSERT INTO salle_membre_possede(Nom_Salle,Proprietaire_Salle,Role,Valide) VALUES(\"$s\",\"$login\",\"\",0)";
		if($requete->execute())
			return true;
		else
			return false;

	}


	//recupere toutes les salles par ordre alphabetique
	
	public static function getsalle()
	{

		$connexion = connect();

		$requete = $connexion->prepare("SELECT Nom FROM salle ORDER BY Nom ASC");

		if($requete->execute())//execution(pas de verification securité a faire => automatique)
		{
			$listeSalle = array();


			while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
			{
				$salle = new Salle($lignes->Nom);
					
				$listeSalle[] = $salle; // ajout dans la liste

			}

		}
		return $listeSalle;
	}

	//cette fonction est ici car la requete se fait sur la table salle_membre_possede, généraleemnt géré par le modele salle
	//permet de renvoyer le createur de la salle
	public static function getUserFromSalle($salle)
	{
		$listeSalle='';
		$connexion = connect();
		$requete = $connexion->prepare("SELECT Proprietaire_Salle FROM salle_membre_possede WHERE Nom_Salle = \"".$salle."\" AND Creator = 1");

		$requete->execute();//execution(pas de verification securité a faire => automatique)

		echo "SELECT Proprietaire_Salle FROM salle_membre_possede WHERE Nom_Salle = \"".$salle."\" AND Creator = 1";
		while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
		{
			$listeSalle[] = $lignes->Proprietaire_Salle; // ajout dans la liste
				
		}
		return $listeSalle;

	}

	public static function Removesalle_membre_possede($user,$salle)
	{
		$connexion = connect();
		$requete = $connexion->prepare("DELETE FROM salle_membre_possede WHERE Proprietaire_Salle = \"".$user."\" AND Nom_Salle = \"".$salle."\" ");

		if($requete->execute())
			return true;
		return false;

	}
	
}
?>
