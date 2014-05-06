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
					
			
			$requete= $connexion->prepare("INSERT INTO membre_groupe(Nom_groupe,Login_membre,Role) VALUES(\"$g->nom\",\"$login\",\"$role\")"); //preparation requete

			echo $login;
			if($requete->execute())
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	
}
	?>