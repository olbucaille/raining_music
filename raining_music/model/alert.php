<?php 

class Alert implements serializable{


	//attributs classe User
	
	var $Id; 	
	var $Titre;
	var $Description;
	var $Flag_lecture;
	var $Type;
	var $Login_membre;
	
	//constructeur à x champs

	function __construct($Id,$Titre,$Description,$Flag_lecture,$Type,$Login_membre)
	{
		$this->Id = $Id;
		$this->Titre = $Titre;
		$this->Description = $Description;
		$this->Flag_lecture = $Flag_lecture ;
		$this->Type = $Type;
		$this->Login_membre= $Login_membre;
	}
	
	
	//permet de serialiser un objet user et le passer en SESSION
	public function serialize() {
	
		return serialize(
				array(
						'Titre' => $this->Titre,
						'Description' => $this->Description,
						'Flag_lecture' => $this->Flag_lecture,
						'Type' => $this->Type,
						'Login_membre' => $this->Login_membre
				)
		);
	}
	
	//appel de cette fonction dans une vue (par exemple) afin de deserialiser et exploiter l'objet!
	public function unserialize($data) {
		 
		$data = unserialize($data);
		$this->Titre = $data['Titre'];
		$this->Description = $data['Description'];
		$this->Flag_lecture =$data['Flag_lecture'];
		$this->Type= $data['Type'];
		$this->Login_membre = $data['Login_membre'];
				 
	}
	
	public static function sendRequestJoinUser($groupe,$user)
	{
		
		
		//objet de base
		$alert = new Alert('','demande',"".$user." demande à rejoindre ".$groupe."",'',"ASK_".$user."_".$groupe,'');
		//cherche liste des membres du groupe
		$listedest = Group::getUserFromGroup($groupe);
		$connexion = connect();
		//construit requete 
		$requete = $connexion->prepare("INSERT INTO Alerte(Titre,Description,Flag_lecture,Type,Login_membre)
				 VALUES(\"".$alert->Titre."\",\"".$alert->Description."\",0,\"".$alert->Type."\",\"".$listedest[0]."\")");
		
		if($requete->execute())//execution(pas de verification securité a faire => automatique)
			return true; 
		else 
			echo false;
		
	}
	
	
	public static function sendRequestProposeUserJoinGroup($groupe,$user)
	{
	
	
		//objet de base
		$alert = new Alert('','Proposition',"le groupe : ".$groupe." voudrais que vous les rejoigniiez ",'',"PRP_".$user."_".$groupe,'');
		$connexion = connect();
		//construit requete
		$requete = $connexion->prepare("INSERT INTO Alerte(Titre,Description,Flag_lecture,Type,Login_membre)
				VALUES(\"".$alert->Titre."\",\"".$alert->Description."\",0,\"".$alert->Type."\",\"".$user."\")");
	
		if($requete->execute())
			return true;
		else
			echo false;
	
	}
	public static function sendRequestJoinSalle($salle,$user,$idConcert)
	{
		//objet de base
		$alert = new Alert('','demande',"".$user." demande à rejoindre ".$salle."",'',"ASKSALLE_".$user."_".$salle."_".$idConcert,'');
		//cherche liste des membres de la salle
		$listedest = Salle::getUserFromSalle($salle);
		var_dump($listedest);
		$connexion = connect();
		//construit requete
		echo "toto";
		
		$sql = "INSERT INTO alerte2(Titre,Description,Flag_lecture,Type,Login_membre)
		VALUES(\"".$alert->Titre."\",\"".$alert->Description."\",0,\"".$alert->Type."\",\"".$listedest."\")";
		echo "<br>".$sql;
		$requete = $connexion->prepare($sql);
		if($requete->execute())//execution(pas de verification securité a faire => automatique)
			return true;
		else
			return false;
	}
	
	
	public static function getAlert($user)
	{
		
		$connexion = connect();
		//construit requete
		$requete = $connexion->prepare("SELECT * FROM Alerte WHERE Login_membre = \"".$user."\"");
		$requete->execute();//execution(pas de verification securité a faire => automatique)
		$listeAlert[] = Array();
	$a = '';
		while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
		{
			$a =  new Alert('',$lignes->Titre,$lignes->Description,$lignes->Flag_lecture,$lignes->Type,$lignes->Login_membre); // ajout dans la liste
			$listeAlert[] = serialize($a);
			 
			
		}
		
		$requete = $connexion->prepare("SELECT * FROM Alerte2 WHERE Login_membre = \"".$user."\"");
		$requete->execute();//execution(pas de verification securité a faire => automatique)
		while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
		{
			$a =  new Alert('',$lignes->Titre,$lignes->Description,$lignes->Flag_lecture,$lignes->Type,$lignes->Login_membre); // ajout dans la liste
			$listeAlert[] = serialize($a);
		
				
		}
		
		
		return $listeAlert;
	}


	public static function PutFlag1($type)
	{
		$connexion = connect();
		$requete = $connexion->prepare("UPDATE Alerte SET Flag_lecture = 1 WHERE Type = \"".$type."\"; ");
		if($requete->execute())
		{
			$requete = $connexion->prepare("UPDATE Alerte2 SET Flag_lecture = 1 WHERE Type = \"".$type."\"; ");
			if($requete->execute())
			return true;
			else
			{
				
				
					$requete = $connexion->prepare("DELETE FROM Alerte2 WHERE Flag_lecture = 0 AND Type = \"".$type."\"; ");
					$requete->execute();
				
						
			}
		}
		else 
		{
			$requete = $connexion->prepare("DELETE FROM Alerte WHERE Flag_lecture = 0 AND Type = \"".$type."\"; ");
			$requete->execute();
		}
			
			
	}
}
?>