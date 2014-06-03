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
	var $picture;
	var $commentaire;
	//constructeur à x champs
	
	function __construct($pseudo,$mail,$pass,$DoB,$localisation,$gender,$nom,$picture,$commentaire)
	{
		$this->login = $pseudo;
		$this->password = $pass;
		$this->mail = $mail;
		$this->sexe = $gender;
		$this->localisation = $localisation;
		$this->DoB = $DoB;
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
    	$this->picture = $data['picture'];
    	$this->commentaire = $data['commentaire'];
    	
    }
	
	public static function identify($login, $mdp) {
		//normalement, $connexion est connue partout(variable globale) et est initialisé avant mais si on ne fait pas ça, ça ne marche pas TT

		$connexion = connect();
		$requete= $connexion->prepare("SELECT * FROM membre WHERE Login =\"$login\""); //preparation requete
		$requete->execute();//execution(pas de verification securité a faire => automatique)

		while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
		{
			
			if( $lignes->Password ==md5($mdp))	//si ok
			{
				if($lignes->image == '')
					$lignes->image = './../pictures/inconnu.bmp';
				$userIdentified = new User($lignes->Login,$lignes->Mail,'',$lignes->DoB,$lignes->Localisation,$lignes->Sexe,$lignes->Nom,$lignes->image,$lignes->commentaire);
				$_SESSION['user'] = serialize($userIdentified); //chargement de variable de session
				
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


	public function update($requeteImage)
	{
		$connexion = connect();
		if($requeteImage != '')
		{
		$requete= $connexion->prepare($requeteImage); //preparation requete
		$requete->execute();//execution(pas de verification securité a faire => automatique)
		}
		
		$requete = $connexion->prepare("UPDATE membre SET Mail=\"$this->mail\",Nom=\"$this->nom\",Sexe=\"$this->sexe\",DoB=\"$this->DoB\",Localisation=\"$this->localisation\",Commentaire=\"$this->commentaire\" WHERE Login=\"$this->login\";");
		$requete->execute();
		
		
		$_SESSION['user'] = serialize($this); //chargement de variable de session
				
	}
	public function update_music($requeteMusic)
	{
		$connexion = connect();
		if($requeteMusic != '')
		{
			$requete= $connexion->prepare($requeteMusic); //preparation requete
			$requete->execute();//execution(pas de verification securité a faire => automatique)
		}
	
	
	
	}
	

	
}

?>


