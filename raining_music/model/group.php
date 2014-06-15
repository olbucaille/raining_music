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
	public static function registerGroup(Group $g,$login,$role, $genre)
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
			
			
			$requeteInter=$connexion->prepare("SELECT Id FROM groupe WHERE Nom=\"$g->nom\" ");
			$requeteInter->execute();
			$temp=$requeteInter->fetchAll();
			//print_r($temp);
			$nb_resultats = count ( $temp );
			
			if($nb_resultats!=0){
				foreach ( $temp as $Row ) {
					// parsing des valeurs récupérées
					$idGroupe = $Row ['Id'];
			
			
					$requete2=$connexion->prepare("INSERT INTO groupe_genre_musical(Id_groupe, Nom_genre_musical) VALUES (\"$idGroupe\",\"$genre\")");
				}
			}
			
			//echo $login;
			if($requete->execute()&&$requete2->execute())
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
	//	echo "SELECT * FROM membre_groupe WHERE Login_membre =\"$user\" AND Nom_groupe =\"$group\" AND Valide = 1" ;//preparation requete
		 
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

	//recuperer tous les groupes par ordre alphabetique
	public static function getgroupAndId()
	{
		$connexion = connect();
		$requete = $connexion->prepare("SELECT Nom,Id FROM groupe ORDER BY Nom ASC");

		if($requete->execute())//execution(pas de verification securité a faire => automatique)
		{
			$listeGroupe = array();


			while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
			{
				$groupe = new Group($lignes->Nom);
				$groupe->id_group = $lignes->Id;

				$listeGroupe[] = $groupe; // ajout dans la liste
			}

		}
		return $listeGroupe;
	}

//function LI
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
	// chercher un groupe en connaissant son id
	public static function getgroupById($id)
	{

		$connexion = connect();


		$requete = $connexion->prepare("SELECT * FROM groupe where Id = '".$id."'");

		if($requete->execute())//execution(pas de verification securité a faire => automatique)
		{
			$listeGroupe = array();

			while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
			{
				$groupe = new Group($lignes->Nom);
				$groupe->Id = $lignes->Id;
				$groupe->description = $lignes->description;
				$groupe->Popularite = $lignes->Popularite;
				$listeGroupe[] = $groupe; // ajout dans la liste

			}

		}
		return $listeGroupe;
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
	public static function updateGroupDescription($nom_groupe,$description)
	{

		$connexion = connect();
		$requete = $connexion->prepare("UPDATE groupe SET description = '".$description."' WHERE Nom = \"".$nom_groupe."\"");

		if($requete->execute())
			return true;
		return false;
	}

	public static function GetAllGroupIAmCreator($user)
	{
		$listeGroupe='';
		$connexion = connect();
		$requete = $connexion->prepare("SELECT Nom_groupe FROM membre_groupe WHERE Login_membre = \"".$user."\" AND Creator = 1");

		$requete->execute();//execution(pas de verification securité a faire => automatique)

		while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
		{
			$listeGroupe[] = $lignes->Nom_groupe; // ajout dans la liste

		}
		return $listeGroupe;

	}




	public static function getPopulariteGroup($idGroup) {

		$connexion = connect();
		$requete=$connexion->prepare("SELECT ScoreTotal, NbVotes FROM groupe WHERE Id='".$idGroup."'" );
		$requete->execute();
		$temp=$requete->fetchAll();
		$connexion=null;

		return ($temp);
	}



	public static function updateGroupPopularite($idGroupe,$newPop, $newScore, $newNbVotes)
	{

		$connexion = connect();
		$requete = $connexion->prepare("UPDATE groupe SET Popularite = '".$newPop."',ScoreTotal='".$newScore."', NbVotes='".$newNbVotes."'  WHERE Id = \"".$idGroupe."\"");

		if($requete->execute())
			return true;
		return false;
	}

	public static  function alreadyVoted ($idGroupe){
		$connexion = connect();
		$requete=$connexion->prepare("SELECT LoginMembre FROM vote WHERE IdGroupe='".$idGroupe."'" );
		$requete->execute();
		$temp=$requete->fetchAll();
		$connexion=null;

		return ($temp);
	}

	public static function insertVote($idGroupe,$Login)
	{

		$connexion = connect();
		$requete = $connexion->prepare("INSERT vote SET IdGroupe = '".$idGroupe."',LoginMembre='".$Login."'");

		if($requete->execute())
			return true;
		return false;
	}


	public static function getBestGroupByPop($limite) {
		//SELECT `Id`,`Nom`,`Popularite` FROM `groupe`  GROUP BY `Id` ORDER BY `Popularite`  DESC LIMIT 3 

		$connexion = connect();
		$requete=$connexion->prepare("SELECT `Id`,`Nom`,`Popularite` FROM `groupe`  GROUP BY `Id` ORDER BY `Popularite`  DESC LIMIT ".$limite);
		$requete->execute();
		$temp=$requete->fetchAll();
		$connexion=null;

		return ($temp);
	}


	public static function getGenreMusicalGroupe($nomGroupe) {
		//select du genre musical en fonction du nom de groupe
		//ex:
		//SELECT `Nom_genre_musical` FROM `groupe_genre_musical` as ggm JOIN `groupe` as g ON ggm.`Id_groupe`=g.`Id` WHERE g.`Nom`='coreanBand'

		$connexion = connect();
		$requete=$connexion->prepare("SELECT `Nom_genre_musical` FROM `groupe_genre_musical` as ggm JOIN `groupe` as g ON ggm.`Id_groupe`=g.`Id` WHERE g.`Nom`='".$nomGroupe."'");
		$requete->execute();
		$temp=$requete->fetchAll();
		$connexion=null;

		return ($temp);
	}

	//get followed groups:
	//SELECT `Nom`,`Id` FROM `membre_groupe_pref` as MAP JOIN `groupe` as g ON MAP.Id_groupe=g.Id WHERE MAP.Id_membre='32'
	
	
	
	public static function followThisGroup($idGroupe, $idMembre, $todo){
		$connexion = connect();
		//$todo="followThem";
		if ($todo=="follow") {
			$requete = $connexion->prepare("INSERT `membre_groupe_pref`  SET `Id_membre`= '".$idMembre."',`Id_groupe`='".$idGroupe."'");
		}
		else {
			// DEBUG
			//$requete = $connexion->prepare("INSERT `membre_groupe_pref`  SET `Id_membre`= '".'42'."',`Id_groupe`='".'42'."'");
			$requete = $connexion->prepare("DELETE FROM `membre_groupe_pref` WHERE `Id_membre` = '".$idMembre."' AND `Id_groupe`='".$idGroupe."'");
		}
		

		if($requete->execute())
			return true;
		return false;
	} 
	
	
	
	
	public static function getAllFollowers($idGroupe) {
	
		$connexion = connect();
		$requete=$connexion->prepare("SELECT `Id_membre` FROM `membre_groupe_pref` WHERE `Id_groupe`='".$idGroupe."'");
		$requete->execute();
		$temp=$requete->fetchAll();
		$connexion=null;
	
		return ($temp);
	}


//fonctions relatives aux concerts (flemme de recréer un model, on n'a plus le temps ^^)
	
	public static function getConcert() {
		$connexion = connect();
		$requete=$connexion->prepare("SELECT * FROM `concert` ORDER BY `Date` ASC");
		$requete->execute();
		$temp=$requete->fetchAll();
		$connexion=null;
	
		return ($temp);
	}
	
	public static function getConcertAroundMe($userDep) {
		$connexion = connect();
		//SELECT * FROM `concert` AS c JOIN `salle` AS s ON c.salle=s.Nom WHERE `Departement`='1'
		$requete=$connexion->prepare("SELECT * FROM `concert` AS c JOIN `salle` AS s ON c.salle=s.Nom WHERE `Departement`='".$userDep."' ORDER BY `Date` ASC");
		$requete->execute();
		$temp=$requete->fetchAll();
		$connexion=null;
	
		return ($temp);
	}
	
	public static function getDepConcert($concertId) {
		$connexion = connect();
		//SELECT * FROM `concert` AS c JOIN `salle` AS s ON c.salle=s.Nom WHERE `Departement`='1'
		$requete=$connexion->prepare("SELECT * FROM `concert` AS c JOIN `salle` AS s ON c.salle=s.Nom WHERE c.Id='".$concertId."'");
		$requete->execute();
		$temp=$requete->fetchAll();
		$connexion=null;
	
		return ($temp);
	}


//fonctions pour récupérer les membres de groupe

public static function getValideGroupe($groupe) {

	$connexion = connect();
	$requete=$connexion->prepare("SELECT Login_membre,Role FROM membre_groupe WHERE Nom_groupe='".$groupe."' AND Valide=1 AND Creator=0");
	$requete->execute();
	$temp=$requete->fetchAll();
	$connexion=null;

	return ($temp);
}
public static function getCreatorGroupe($groupe) {

	$connexion = connect();
	$requete=$connexion->prepare("SELECT Login_membre, Role FROM membre_groupe WHERE Nom_groupe='".$groupe."' AND Creator=1");
	$requete->execute();
	$temp=$requete->fetchAll();
	$connexion=null;

	return ($temp);
}
}
?>
