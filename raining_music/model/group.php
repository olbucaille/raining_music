<?php



class User implements serializable{


	//attributs classe User
	
	var $nom;
	var $popularite;
	//constructeur à x champs

	function __construct($nom,$nombreDeMembre)
	{	$this->nom = $nom;
		$this->popularite = $popularite;
	}

	//permet de serialiser un objet user et le passer en SESSION
	public function serialize() {

		return serialize(
				array(
						
						'nom' => $this->nom,
						'popularite' => $this->popularite,

				)
		);
	}

	//appel de cette fonction dans une vue (par exemple) afin de deserialiser et exploiter l'objet!
	public function unserialize($data) {
		 
		$data = unserialize($data);
		$this->nom =$data['nom'];
		$this->commentaire = $data['popularite'];
		 
	}
	
	?>