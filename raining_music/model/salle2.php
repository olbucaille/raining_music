<?php



class Salle implements serializable{


	//attributs classe User

	var $nom;
	//constructeur � x champs

	function __construct($nom)
	{
		$this->nom = $nom;
	}

	//permet de serialiser un objet user et le passer en SESSION
	public function serialize() {

		return serialize(
				array(

						'nom' => $this->nom,

				)
		);
	}

	//appel de cette fonction dans une vue (par exemple) afin de deserialiser et exploiter l'objet!
	public function unserialize($data) {
			
		$data = unserialize($data);
		$this->nom =$data['nom'];
	}

	//inscrire une salle
	public static function registerSalle(Salle $g,$login,$role)
	{
		//conection BDD
		$connexion = connect();

		//construction requete
		$requete= $connexion->prepare("INSERT INTO salle(Nom) VALUES(\"$g->nom\")"); //preparation requete

		if($requete->execute())//execution(pas de verification securit� a faire => automatique)
		{
				
				
			$requete= $connexion->prepare("INSERT INTO salle_memebre_possede(Proprietaire_Salle,Adresse_Salle,Role,Valide) VALUES(\"$g->nom\",\"$login\",\"$role\",1)"); //preparation requete

			echo $login;
			if($requete->execute())
				return true;
			else
				return false;
		}
		else
			return false;
	}


	
	//recuperer toutes les salles par ordre alphabetique
	public static function getsalle()
	{

		$connexion = connect();


		$requete = $connexion->prepare("SELECT Nom FROM salle ORDER BY Nom ASC");

		if($requete->execute())//execution(pas de verification securit� a faire => automatique)
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

	//cette fonction est ici car la requete se fait sur la table salle_memebre_possede
	public static function getUserFromSalle($salle)
	{
		$connexion = connect();
		$requete = $connexion->prepare("SELECT Login_membre FROM salle_memebre_possede WHERE ID = ".$salle);
		while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
				$listeSalle[] = $lignes->Login_membre; // ajout dans la liste
		return $listeSalle;
		
	}

}
?>