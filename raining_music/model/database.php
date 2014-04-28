<?php
 
// 		$Base = Database::connectDatabase();
// 		$req = "INSERT INTO  (name, firstname, email, password, birthday, codePostal, gender) VALUES ('$name', '$firstname', '$email', '$password', '$birthday', '$codePostal', '$gender')";
// 		$Base -> exec($req);
// 		$Base = Database::disconnectDatabase();
// 		$Base = null;


class Database{
	private static $instance = null;
        //private static $instanceville = null;
	
	public static function connectDatabase(){
		if(self::$instance == null){			//	Si l'objet n'est pas encore instancier (ce qui signifie que l'on a pas encore utilis� le mot cl� new), alors on peut faire ce qui suit.
			try{
				self::$instance = new PDO('mysql:host=localhost;dbname=bd_raining_music', 'root', '');
				/*				--	Explication sur cette ligne de code	--
				 * PDO : PHP Data Object --> Nouveaut� apport� par PHP5 qui permet de rendre le PHP orient� Objet (Comme le Java).
				 * 		Il faut donc penser avec des objets que l'on cr�e et que l'on manipule.
				 * 		Attention !!! ==> l'objet PDO est r�serv� pour les bases de donn�es (quelqu'elles soient : PostgreSQL, Oracle, MySQL...).
				 * List des arguments :
				 * 		--> mysql : d�fini le SGBD (Syst�me de Gestion de Base de Donn�e)
				 * 		--> host = localhost : d�fini le serveur d'application o� la base est h�berg�. Cette donn�e aura tendance � changer si on stocke notre site sur un serveur.
				 * 		--> dbname=mydb : d�finit le nom sous lequel la base de donn�es est connue dans le serveur d'application (ici, localhost).
				 * 		--> root : Nom d'acc�s � la base de donn�e.
				 * 		--> '' : Correspond au champ du mot de passe. On a fait en sorte que notre base n'ait pas besoin de mdp pour le moment M�ME si dans le futur il y en aura bien �videmment un.
				 * self::$instance :
				 * 		--> Le mot cl� "self" permet de cibler le champ de classe (d�fini avec le mot cl� static). 
				 * 				ATTENTION : Ne pas confondre self & this. This permet d'utiliser la r�f�rence d'un objet instanci�. Ce qui signifie que l'on parle d'un attribut/m�thode d'un objet.
				 * 		--> $instance correspond au nom de la variable. Pour dire que c'est une variable,  on utilise l'identificateur '$'. */
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
	
	public static function remplirTable($table, $champ, $donnee){
		/*		--		Explication sur la m�thode		--
		 * On cr�e une connexion � la base de donn�e dans un premier temps. 		 	--> 1
		 * On construit la requ�te SQL (Explication sur la concat�nation plus bas)	 	--> 2
		 * On execute la requ�te. Puisque l'on n'attends pas un retour de la base (Comme dans un Select), la m�thode exec nous suffit. --> 3
		 * On supprime la connexion � la base de donn�e. 								--> 4
		 * 
		 * 		--		Explication sur la concat�nation des donn�es		--
		 * On peut cr�er une cha�ne de caract�re de mani�re dynamique avec des arguments variables. Cela s'appelle la concat�nation.
		 * Exemple : On dira pour l'exemple que $table = "'users'";, $champ = "'email','Password'" et $donnee = "'conotte.benjamin@gmail.com','azerty123'"
		 * 		"'INSERT INTO'.$table.'('... donnera "'INSERT INTO 'users' (...
		 * */
		$Base = self::connectDatabase(); 
		$Base -> query("SET NAMES utf8");												// Etape --> 1
		$req = "INSERT INTO ".$table."(".$champ.") VALUES (".$donnee.")"; 				// Etape --> 2
		$Base -> exec ($req);															// Etape --> 3
		$Base = self::disconnectDatabase();												// Etape --> 4
	}
	
	/*_____________________________________________________________________________*/
	
	public static function lectureTable($table, $champCible, $champDonnee){
		/*		--		Explication sur la m�thode		--
		 * Elle ressemble de mani�re tr�s similaire � la m�thode remplirTable(); � la diff�rence de l'�tape 3
		 * 				--> �tape 3 : Puisque l'on attends une donn�e en retour, la m�thode a utilis� doit �tre query
		 * 						ATTENTION : Cet m�thode retourne un objet PDO ! Il ne peut donc pas �tre utilis� tel quel !
		 *  return $test : On retourne l'objet PDO contenant le r�sultat de la requ�te.
		 * */
		$Base = self::connectDatabase(); 
		$Base -> query("SET NAMES utf8");													// Etape --> 1
		$req = "SELECT ".$champCible."  FROM ".$table." WHERE ".$champDonnee; 			// Etape --> 2
		$retour = $Base -> query ($req);												// Etape --> 3
        $Base = self::disconnectDatabase();												// Etape --> 4
		return $retour;
	}
	
	/*_____________________________________________________________________________*/
	
	public static function modifierTable($table, $champ, $valeur, $condition){
		/*		--		Explication sur la m�thode		--
		* On cr�e une connexion � la base de donn�e dans un premier temps. 		 	--> 1
		* On construit la requ�te SQL (Explication sur la concat�nation plus bas)	 	--> 2
		* On execute la requ�te. Puisque l'on n'attends pas un retour de la base (Comme dans un Select), la m�thode exec nous suffit. --> 3
		* On supprime la connexion � la base de donn�e. 								--> 4
		*
		*/
		$Base = self::connectDatabase(); 
		$Base -> query("SET NAMES utf8");												// Etape --> 1
		$req = "UPDATE ".$table." SET ".$champ."=".$valeur." WHERE ".$condition; 		// Etape --> 2		
		
		var_dump($req);
		
		$Base -> exec ($req);															// Etape --> 3
		$Base = self::disconnectDatabase();												// Etape --> 4
	}
	
	/*_____________________________________________________________________________*/
	
	public static function effacerEnregistrement($table, $condition){
	
		$Base = self::connectDatabase();
		$Base -> query("SET NAMES utf8");												// Etape --> 1
		$req = "DELETE FROM ".$table." WHERE ".$condition; 								// Etape --> 2
		$Base -> exec ($req);															// Etape --> 3
		$Base = self::disconnectDatabase();												// Etape --> 4
	}
	
}

?>