<?php



class Group {


	//attributs classe User

	var $nom;
	var $id_group;
	
	//constructeur à x champs

	function __construct($nom)
	{
		$this->nom = $nom;
	}


	//inscrire un groupe
	public static function registerGroup(Group $g,$login,$role)
	{
		//conection BDD
		$connexion = connect();

		//verification groupe identique n'existe pas
		$requete= $connexion->prepare("SELECT * FROM groupe WHERE Nom =\"$g->nom\" "); //preparation requete
	//		echo "SELECT * FROM groupe WHERE Nom =\"$g->nom\" ";
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
		$requete= $connexion->prepare("INSERT INTO groupe(Nom) VALUES(\"$g->nom\")"); //preparation requete
		//echo  "INSERT INTO groupe(Nom) VALUES(\"$g->nom\")";
		if($requete->execute())//execution(pas de verification securité a faire => automatique)
		{
			
			
				
			$requete= $connexion->prepare("INSERT INTO membre_groupe(Nom_groupe,Login_membre,Role,Valide,Creator) VALUES(\"$g->nom\",\"$login\",\"$role\",1,1)"); //preparation requete

			//echo $login;
			if($requete->execute())
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	//verifie si un user est validé dans le groupe
	public static function verifyMemberValidate($user,$group)
	{
		//conection BDD
		$connexion = connect();
		
		//construction requete
		$requete= $connexion->prepare("SELECT * FROM membre_groupe WHERE Login_membre =\"$user\" AND Nom_groupe =\"$group\" AND Valide = 1"); //preparation requete
		echo "SELECT * FROM membre_groupe WHERE Login_membre =\"$user\" AND Nom_groupe =\"$group\" AND Valide = 1" ;//preparation requete
		 
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

	
	//inscrire un groupe
	public static function AddUserToGroup($g,$login)
	{
		//conection BDD
		$connexion = connect();
	
		$requete= $connexion->prepare("INSERT INTO membre_groupe(Nom_groupe,Login_membre,Role,Valide) VALUES(\"$g\",\"$login\",\"\",0)"); //preparation requete
		//echo "INSERT INTO membre_groupe(Nom_groupe,Login_membre,Role,Valide) VALUES(\"$g\",\"$login\",\"\",0)";
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

	public static function getgroupname($id_group)
	{
	
		$connexion = connect();
	
	
		$requete = $connexion->prepare("SELECT Nom FROM groupe WHERE Id='$id_group'");
	
		if($requete->execute())//execution(pas de verification securité a faire => automatique)
		{
			$Groupename = array();

			while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
			{
				$groupe = new Group($lignes->Nom);
					
				$Groupename[] = $groupe; // ajout dans la liste
			
			}
			
	
		}
		return $Groupename;
	}

	//cette fonction est ici car la requete se fait sur la table membre groupe, généraleemnt géré par le modele group
	//permet de renvoyer le createur du groupe
	public static function getUserFromGroup($group)
	{
		$listeGroupe='';
		$connexion = connect();
		$requete = $connexion->prepare("SELECT Login_membre FROM membre_groupe WHERE Nom_groupe = \"".$group."\" AND Creator = 1");
		
		$requete->execute();//execution(pas de verification securité a faire => automatique)
		
		echo "SELECT Login_membre FROM membre_groupe WHERE Nom_groupe = \"".$group."\" AND Creator = 1";
		while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
		{
				$listeGroupe[] = $lignes->Login_membre; // ajout dans la liste
			
		}
		return $listeGroupe;
		
	}
	
	public static function RemoveMembre_Group($user,$group)
	{
		$connexion = connect();
		$requete = $connexion->prepare("DELETE FROM membre_groupe WHERE login_membre = \"".$user."\" AND Nom_groupe = \"".$group."\" ");
		
		if($requete->execute())
			return true; 
		return false;		
		
	}
	public static function AcceptMembre_Group($user,$group)
	{
		$connexion = connect();
		$requete = $connexion->prepare("UPDATE membre_groupe SET valide = 1 WHERE login_membre = \"".$user."\" AND Nom_groupe = \"".$group."\" ");
		
		if($requete->execute())
			return true;
		return false;
	}
	
	public static function GetAllGroupIAmCreator($user)
	{
		$listeGroupe='';
		$connexion = connect();
		$requete = $connexion->prepare("SELECT  FROM membre_groupe WHERE Nom_groupe = \"".$group."\" AND Creator = 1");
		
		$requete->execute();//execution(pas de verification securité a faire => automatique)
		
		echo "SELECT Login_membre FROM membre_groupe WHERE Nom_groupe = \"".$group."\" AND Creator = 1";
		while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
		{
			$listeGroupe[] = $lignes->Login_membre; // ajout dans la liste
				
		}
		return $listeGroupe;
		
	}
}
?>