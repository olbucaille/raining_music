<?php 
class Alert {


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
	
	public static function sendRequestJoinUser($groupe,$user)
	{
		//objet de base
		$alert = new Alert('','demande','demande pour rejoindre le groupe','',"ASK_".$user."_".$groupe,'');
		//cherche liste des membres du groupe
		$listedest = Group::getUserFromGroup($groupe);
		//construit requete 
		
		
	}
}
	
?>