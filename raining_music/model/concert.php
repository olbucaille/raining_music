<?php
class Concert implements serializable{


	//attributs classe User
	var $nom;
	var $date;
	var $heure;
	var $cout;
	var $adresse;
	var $description;
	var $salle;
	var $groupe;
	
	//constructeur à x champs

	function __construct($nom,$date,$heure,$cout,$adresse,$description,$salle,$groupe)
	{
		$this->nom = $nom;
		$this->date =$date;
		$this->heure = $heure;
		$this->cout = $cout;
		$this->adresse = $adresse;
		$this->description = $description;
		$this->salle = $salle;
		$this->groupe = $groupe;
		
	}

	//permet de serialiser un objet user et le passer en SESSION
	public function serialize() {
	
		return serialize(
				array(
						
						
						'nom'=> $this->nom,
						'date'=>$this->date,
						'heure'=>$this->heure,
						'cout'=>$this->cout,
						'adresse'=>$this->adresse,
						'description'=>$this->description,
						'salle'=>$this->salle,
						'groupe'=>$this->groupe,
				)
		);
	}
	
	//appel de cette fonction dans une vue (par exemple) afin de deserialiser et exploiter l'objet!
	public function unserialize($data) {
			
		$data = unserialize($data);
		$this->nom = $data['nom'];
		$this->date = $data['date'];
		$this->heure=$data['heure'];
		$this->cout= $data['cout'];
		$this->adresse= $data['adresse'];
		$this->description =$data['description'];
		$this->salle=$data['salle'];
		$this->groupe = $data['groupe'];

			
	}
	public function getConcert()
	{
		$connexion = connect();
	
			$requete= $connexion->prepare("SELECT * FROM concert WHERE salle_acceptee= 1 AND Concert_accepte =1"); 
			$requete->execute();

			while($lignes=$requete->fetch(PDO::FETCH_OBJ))
			{
				$this->nom = $lignes->nom;
				$this->date =  $lignes->date;
				$this->heure = $lignes->heure;
				$this->cout = $lignes->cout;
				$this->adresse=$lignes->adresse;
				$this->description = $lignes->description;
				$this->salle = $lignes->salle;
				$this->groupe = $lignes->groupe;

			}

		

		

	}
	
}