<?php


class Database{
	
	public static function connectDatabase(){
		if(self::$instance == null){			//	Si l'objet n'est pas encore instancier (ce qui signifie que l'on a pas encore utilis� le mot cl� new), alors on peut faire ce qui suit.
			try{
				self::$instance = new PDO('mysql:host=10.0.120.16;dbname=dotgamehmod1', 'dotgamehmod1', 'UOA6up7E');
			}
			catch (Exception $e){
				die('Erreur : ' . $e->getMessage());
				/*
				 * Si pour une raison, quelqu'elle soit, on n'arrive pas � se connecter � la base, on retourne le message.*/
			}
		}
                
		return self::$instance;	//	A cette �tape, $instance est un champ de classe contenant la r�f�rence d'un objet de type PDO qui donne acc�s � toutes les m�thodes pour dialoguer avec une B2D.
	}
	/*
         */
  
        /*_________________________________________________________________________*/
	public static function disconnectDatabase(){
		$instance=null; 	//	Une fois l'utilisation fini, il est important de liberer de la m�moire. Pour se faire, il suffit de changer la r�f�rence contenue dans $instance par null. 
		return null;		//	Retourne null pour utilisation de l'objet PDO dans d'autre fichier.
	}
        
	/*______________________________________________________________________________*/
	
	
}

?>