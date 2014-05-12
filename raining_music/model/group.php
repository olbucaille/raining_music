<?php



class Group implements serializable{


	//attributs classe User

	var $nom;
	//constructeur à x champs

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

	//inscrire un groupe
	public static function registerGroup(Group $g,$login,$role)
	{
		//conection BDD
		$connexion = connect();

		//construction requete
		$requete= $connexion->prepare("INSERT INTO groupe(Nom) VALUES(\"$g->nom\")"); //preparation requete

		if($requete->execute())//execution(pas de verification securité a faire => automatique)
		{
				
				
			$requete= $connexion->prepare("INSERT INTO membre_groupe(Nom_groupe,Login_membre,Role,Valide) VALUES(\"$g->nom\",\"$login\",\"$role\",1)"); //preparation requete

			echo $login;
			if($requete->execute())
				return true;
			else
				return false;
		}
		else
			return false;
	}

	
	//inscrire un groupe
	public static function AddUserToGroup($g,$login)
	{
		//conection BDD
		$connexion = connect();
	
		$requete= $connexion->prepare("INSERT INTO membre_groupe(Nom_groupe,Login_membre,Role,Valide) VALUES(\"$g\",\"$login\",\"\",0)"); //preparation requete
		echo "INSERT INTO membre_groupe(Nom_groupe,Login_membre,Role,Valide) VALUES(\"$g\",\"$login\",\"\",0)";
		if($requete->execute())
			return true;
		else
			return false;
		
	}
	
	
	//recuperer tous les groupes par ordre alphabetique
	public static function getgroup()
	{

		$connexion = connect();


		$requete = $connexion->prepare("SELECT Nom FROM groupe ORDER BY Nom ASC");

		if($requete->execute())//execution(pas de verification securité a faire => automatique)
		{
			$listeGroupe = array();
				
				
			while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
			{					
				$groupe = new Group($lignes->Nom);
					
				$listeGroupe[] = $groupe; // ajout dans la liste

			}
				
		}
		return $listeGroupe;
	}

	//cette fonction est ici car la requete se fait sur la table membre groupe, généraleemnt géré par le modele group
	public static function getUserFromGroup($group)
	{
		$listeGroupe='';
		$connexion = connect();
		$requete = $connexion->prepare("SELECT Login_membre FROM membre_groupe WHERE Nom_groupe = ".$group);
		while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
				$listeGroupe[] = $lignes->Login_membre; // ajout dans la liste
		return $listeGroupe;
		
	}

}
?>