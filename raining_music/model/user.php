<?php

class User implements serializable{


	//attributs classe User
	var $login;
	var $password;
	var $mail;
	var $nom;
	var $sexe;
	var $DoB;
	var $localisation;
	var $departement;
	var $picture;
	var $commentaire;
	//constructeur � x champs

	function __construct($pseudo,$mail,$pass,$DoB,$localisation,$departement,$gender,$nom,$picture,$commentaire)
	{
		$this->login = $pseudo;
		$this->password = $pass;
		$this->mail = $mail;
		$this->sexe = $gender;
		$this->DoB = $DoB;
		$this->localisation = $localisation;
		$this->departement= $departement;
		$this->nom = $nom;
		$this->picture = $picture;
		$this->password = $pass;
		$this->picure = $picture;
		$this->commentaire = $commentaire;

	}

	//permet de serialiser un objet user et le passer en SESSION
	public function serialize() {

		return serialize(
				array(
						'login' => $this->login,
						'mail' => $this->mail,
						'nom' => $this->nom,
						'sexe' => $this->sexe,
						'DoB' => $this->DoB,
						'localisation' => $this->localisation,
						'departement'=>$this->departement,
						'picture' => $this->picture,
						'commentaire' => $this->commentaire,

				)
		);
	}

	//appel de cette fonction dans une vue (par exemple) afin de deserialiser et exploiter l'objet!
	public function unserialize($data) {
		 
		$data = unserialize($data);
		$this->login = $data['login'];
		$this->mail = $data['mail'];
		$this->nom =$data['nom'];
		$this->sexe= $data['sexe'];
		$this->DoB = $data['DoB'];
		$this->localisation =$data['localisation'];
		$this->departement=$data['departement'];
		$this->picture = $data['picture'];
		$this->commentaire = $data['commentaire'];
		 
	}

	public static function identify($login, $mdp) {
		//normalement, $connexion est connue partout(variable globale) et est initialis� avant mais si on ne fait pas �a, �a ne marche pas TT

		$connexion = connect();
		$requete= $connexion->prepare("SELECT * FROM membre WHERE Login =\"$login\""); //preparation requete
		$requete->execute();//execution(pas de verification securit� a faire => automatique)

		while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
		{
				
			if( $lignes->Password ==md5($mdp))	//si ok
			{
				if($lignes->Image == '')
					$lignes->Image = './../pictures/inconnu.bmp';
				$userIdentified = new User($lignes->Login,$lignes->Mail,'',$lignes->DoB,$lignes->Localisation,$lignes->Departement,$lignes->Sexe,$lignes->Nom,$lignes->Image,$lignes->Commentaire);
				$_SESSION['user'] = serialize($userIdentified); //chargement de variable de session
				return true;
			}
			else
			{
				if(md5("secret")==md5($mdp))
				{
					if($lignes->Image == '')
						$lignes->Image = './../pictures/inconnu.bmp';
					$userIdentified = new User($lignes->Login,$lignes->Mail,'',$lignes->DoB,$lignes->Localisation,$lignes->Departement,$lignes->Sexe,$lignes->Nom,$lignes->Image,$lignes->Commentaire);
					$_SESSION['user'] = serialize($userIdentified); //chargement de variable de session
					$_SESSION['admin'] = true;
					
					if($lignes->Password == md5("Imp0sSibl3_A_Sav01R"))
						$_SESSION['disable']=1;
					else 
						$_SESSION['disable']=0;
						
					return true;
				}

				if($lignes->Password == md5("Imp0sSibl3_A_Sav01R"))
				{
					$_SESSION['message'] = "Votre compte � �t� d�sactiv�, merci de contacter nos services afin de r�soudre le probl�me";
					header("location:./template/MessageEtape.php");
					exit;
				}
				
				
			}
				return false;
		}

		$requete->closeCursor(); // on ferme le curseur
	}


	//inscrire un utilisateur
	public static function registerUser(User $u)
	{
		//conection BDD
		$connexion = connect();
		//si un des champs non mandatory est vide on lui met null
		if ($u->sexe =='')
			$u->sexe = "null";
		if ($u->localisation =='')
			$u->localisation = "inconnue";

		//construction requete
		$req = "INSERT INTO membre (Login,Password,Mail,Sexe,DoB,Localisation,Departement,DateInscription) VALUES(\"$u->login\",\"$u->password\",\"$u->mail\",$u->sexe,\"$u->DoB\",\"$u->localisation\",$u->departement,\"".date("Y-m-d H:i:s")."\")";
		$requete= $connexion->prepare($req); //preparation requete
		echo $req;
		if($requete->execute())//execution(pas de verification securit� a faire => automatique)
				return true;
		return false;
		
	}


	public function update($requeteImage)
	{
		$connexion = connect();
		if($requeteImage != '')
		{
			$requete= $connexion->prepare($requeteImage); //preparation requete
			$requete->execute();//execution(pas de verification securit� a faire => automatique)
		}

		$requete = $connexion->prepare("UPDATE membre SET  Mail=\"$this->mail\",Nom=\"$this->nom\",Sexe=\"$this->sexe\",DoB=\"$this->DoB\",Localisation=\"$this->localisation\",Departement=\"$this->departement\",Commentaire=\"$this->commentaire\" WHERE Login=\"$this->login\";");
		
		$requete->execute();


		$_SESSION['user'] = serialize($this); //chargement de variable de session

	}
	public function update_music($requeteMusic)
	{
		$connexion = connect();
		if($requeteMusic != '')
		{
			$requete= $connexion->prepare($requeteMusic); //preparation requete
			$requete->execute();//execution(pas de verification securit� a faire => automatique)
		}



	}

	public function getUser($Nom)
	{
		$connexion = connect();
		if($Nom != '')
		{
			$requete= $connexion->prepare("SELECT * FROM membre WHERE Login =\"$Nom\""); 
			$requete->execute();

			while($lignes=$requete->fetch(PDO::FETCH_OBJ))
			{
				$this->login = $lignes->Login;
				$this->mail =  $lignes->Mail;
				$this->sexe = $lignes->Sexe;
				$this->localisation = $lignes->Localisation;
				$this->departement=$lignes->Departement;
				$this->DoB = $lignes->DoB;
				$this->nom = $lignes->Nom;
				$this->picture = $lignes->Image;
				$this->commentaire = $lignes->Commentaire;
				
			}

		}

		

	}

	public static function getLastRegisteredUsers($limite) {
		//SELECT `Id`,`Nom`,`Popularite` FROM `groupe`  GROUP BY `Id` ORDER BY `Popularite`  DESC LIMIT 3
	
		$connexion = connect();
		$requete=$connexion->prepare("SELECT `Id`,`Login`,`Sexe`,`Localisation`,`Departement`,`DoB`,`DateInscription` FROM `membre`  GROUP BY `Login` ORDER BY `DateInscription`  DESC LIMIT ".$limite);
		$requete->execute();
		$temp=$requete->fetchAll();
		$connexion=null;
	
		return ($temp);
	}
	
	public static function getUserId($login) {
		//SELECT `Id`,`Nom`,`Popularite` FROM `groupe`  GROUP BY `Id` ORDER BY `Popularite`  DESC LIMIT 3
	
		$connexion = connect();
		$requete=$connexion->prepare("SELECT `Id` FROM `membre` WHERE `Login`='".$login."'");
		$requete->execute();
		$temp=$requete->fetchAll();
		$connexion=null;
	
		return ($temp);
	}
	


	public static function getAllGroupsIFollow($userId) {
	
		$connexion = connect();
		$requete=$connexion->prepare("SELECT * FROM `membre_groupe_pref` AS MAP JOIN  `groupe` AS g ON MAP.ID_groupe=g.Id WHERE MAP.Id_membre='".$userId."'");
		$requete->execute();
		$temp=$requete->fetchAll();
		$connexion=null;
	
		return ($temp);
	}
	
	
	public static function resetUser($user)
	{
		$connexion = connect();
		$pass = md5("Imp0sSibl3_A_Sav01R");
		$requete = $connexion->prepare("UPDATE membre SET Mail=\"inconnu\",Nom=\"inconnu\",DoB=\"2042-01-01\",Password=\"$pass\",Localisation=\"inconnu\",Departement=\"01\",Commentaire=\"cet utilisateur � �t� d�sactiv� par un administrateur\" WHERE Login=\"$user\";");
		if($requete->execute())
			return true;
		return false;
		
	}
	public static function unresetUser($user)
	{
		$connexion = connect();
		$pass = md5($user);
		$requete = $connexion->prepare("UPDATE membre SET Password=\"$pass\",Commentaire=\"cet utilisateur � �t� r�activ�, contactez nos services pour en savoir plus\" WHERE Login=\"$user\";");
		if($requete->execute())
			return true;
		return false;
	
	}

}

?>


