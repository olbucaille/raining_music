<?php



class User implements serializable{


	//attributs classe User
	
	var $nom;
	var $nombreDeMembre;
	//constructeur à x champs

	function __construct($nom,$nombreDeMembre)
	{	$this->nom = $nom;
		$this->nombreDeMembre = $nombreDeMembre;
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
	
	?>