
<?php



class Salle {

	var $Nom;
	
	//constructeur à x champs

	function __construct($Nom)
	{
		$this->Nom = $Nom; 

	}


	//inscrire une salle
	public static function registerSalle(Salle $s,$Departement,$Adresse,$Proprietaire)
	{
			//conection BDD
		$connexion = connect();

		//verification groupe identique n'existe pas
		$requete= $connexion->prepare("SELECT * FROM salle WHERE Nom =\"$s->Nom\" "); //preparation requete
	
		if($requete->execute())//execution(pas de verification securité a faire => automatique)
		{
		$i = 0;
			while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
			$i++;
		
			//echo "i == ";
			//echo  $i;
			if ($i!= 0)
				return false;
		}
		
		//construction requete
		$requete= $connexion->prepare("INSERT INTO salle(Nom, Adresse, Departement, Proprietaire) VALUES(\"$s->Nom\",\"$Adresse\",\"$Departement\",\"$Proprietaire\")"); //preparation requete
		
		if($requete->execute())//execution(pas de verification securité a faire => automatique)
		{
		
			$requete= $connexion->prepare("INSERT INTO salle_memebre_possede(Nom_Salle,Proprietaire_Salle,Adresse_Salle,Valide,Creator) VALUES(\"$s->Nom\",\"$Proprietaire\",\"$Adresse\",1,1)"); //preparation requete
		
			//echo $login;
			if($requete->execute())
				return true;
			else
				return false;
		}
		else
			return false;
	}	

	//verifie si un user est validé dans la salle
	public static function verifyProprietaireValidate($user,$salle)
	{
		//conection BDD
		$connexion = connect();
	
		//construction requete
		$requete= $connexion->prepare("SELECT * FROM salle_memebre_possede WHERE Proprietaire_Salle =\"$Proprietaire\" AND Nom_Salle =\"$salle\" AND Valide = 1"); //preparation requete
		echo "SELECT * FROM salle_memebre_possede WHERE Proprietaire_Salle =\"$user\" AND Nom_Salle =\"$salle\" AND Valide = 1" ;//preparation requete
			
		if($requete->execute())//execution(pas de verification securité a faire => automatique)
		{
		$i = 0;
		while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
		$i++;
	
		//echo "i == ";
		//echo  $i;
		if ($i!= 0)
		return true;
		return false;
		}
	
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
	
	//permet de renvoyer le createur de la salle
	public static function getUserFromSalle($salle)
	{
		$listeSalle='';
		$connexion = connect();
		$requete = $connexion->prepare("SELECT Proprietaire_Salle FROM salle_memebre_possede WHERE Nom_Salle = \"".$salle."\" AND Creator = 1");

		$requete->execute();//execution(pas de verification securité a faire => automatique)

		echo "SELECT Proprietaire_Salle FROM salle_memebre_possede WHERE Nom_Salle = \"".$salle."\" AND Creator = 1";
		while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
		{
			$listeSalle[] = $lignes->Proprietaire_Salle; // ajout dans la liste
				
		}
		return $listeSalle;

	}

	public static function Removesalle_membre_possede($user,$salle)
	{
		$connexion = connect();
		$requete = $connexion->prepare("DELETE FROM salle_memebre_possede WHERE Proprietaire_Salle = \"".$user."\" AND Nom_Salle = \"".$salle."\" ");

		if($requete->execute())
			return true;
		return false;

	}
	
}
?>
