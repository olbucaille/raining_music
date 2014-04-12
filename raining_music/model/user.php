<?php

class User{

	
	//attributs classe User
	var $login;
	var $password;
	var $mail;
	var $nom;
	var $sexe;
	var $DoB;
	var $localisation;


	//constructeur à 6 champs (inscription principalement)
	function __construct($pseudo,$mail,$pass,$DoB,$localisation,$gender)
	{
		$this->login = $pseudo;
		$this->password = $pass;
		$this->mail = $mail;
		$this->sexe = $gender;
		$this->localisation = $localisation;
		$this->DoB = $DoB;

		
	}

	public static function identify($login, $mdp) {
		//normalement, $connexion est connue partout(variable globale) et est initialisé avant mais si on ne fait pas ça, ça ne marche pas TT

		$connexion = connect();
		$requete= $connexion->prepare("SELECT Password FROM membre WHERE Login =\"$login\""); //preparation requete
		$requete->execute();//execution(pas de verification securité a faire => automatique)

		while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
		{
			
			if( $lignes->Password ==md5($mdp))	//si ok
			{
				$_SESSION['user'] = $login; //chargement de variable de session
				return true;
			}
			else
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
			$u->localisation = "null";
		
		//construction requete
		$requete= $connexion->prepare("INSERT INTO membre(Login,Password,Mail,Sexe,DOB,Localisation) VALUES(\"$u->login\",\"$u->password\",\"$u->mail\",$u->sexe,\"$u->DoB\",\"$u->localisation\")"); //preparation requete
		
		if($requete->execute())//execution(pas de verification securité a faire => automatique)
			return true;
		else
			return false;
	}


}

?>


