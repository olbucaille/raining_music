<?php
include_once 'database.php';
/* Contient toutes les requ�tes SQL qui nous int�resse � savoir :
 * 		- insert
 * 		- update 
 * 		- delete
 * 		- select
 * 
 * Elles ont toutes �t� test�s. Pour les utiliser, voici comment il faut faire :
 * 		- Instancier un objet
 * 		- Lancer la requ�te avec les param�tres voulu.
 * Exemple :
 * 		$request = new requestSQL();
 * 		$request -> insert ();*/

class requestSQL{
	
	function insert($table, $champs, $donnee){
		$bdd = Database::connectDatabase();
                
        $bdd -> query("SET NAMES utf8");		
		/*	Pr�paration de la requ�te SQL :
		 * On commence par cr�er un "patron" � l'aide de la m�thode prepare de la class PDO o� des champs sont � remplir */	
		$sql = "INSERT INTO ".$table." ( ".$champs." ) VALUES ( ".$donnee." )";
		$req = $bdd -> prepare($sql);
		/*	On execute la commande	*/
		$req -> execute();
		/*	On se d�connecte de la base	*/
		$bdd = Database::disconnectDatabase();
		$bdd = null;
	}
	
	function update($table, $champs, $data, $cible, $dataCible){
		/*
		 * Mettre � jour un �l�ment de la table (Mot de passe pour un utilisateur tiers, par exemple) :
		 * 		update('users','Password','LeFameuxMotDePasse','Login','CeluiDontOnVeutModifierLeMotDePasse');
		 * Supprimer un attribut du tableau :
		 * 		update('NomDeLaTable','LAttributQueLOnVeutModifier','','PRIMARY_KEY','Valeur');*/
		/*	On se connecte � la base de donn�e*/
		$bdd = Database::connectDatabase();
                  $bdd -> query("SET NAMES utf8");
		
		/*	Pr�paration de la requ�te SQL*/
		$sql = "UPDATE ".$table." SET ".$champs." = '".$data."' WHERE ".$cible." = '".$dataCible."'";
		$req = $bdd -> prepare($sql);
		/*	On execute la commande	*/
		$req -> execute();
		/*	On se d�connecte de la base	*/
		$bdd = Database::disconnectDatabase();
		$bdd = null;
	}
	
	function delete($table, $condition){
		/*
		 * Supprimer un champs d'une ligne d'une table :
		 * 			Utiliser la requ�te Update avec un champs NULL � la place !
		 * Supprimer une ligne d'une table : 
		 * 			delete ('NomDeLaTable','PRIMARY_KEY ="value"');
		 *Supprimer tout le contenue d'une table
		 *			delete ('NomDeLaTable','1');
		 * */
		
		/*	Connection � la base de donn�e	*/
		$bdd = Database::connectDatabase();
                  $bdd -> query("SET NAMES utf8");
		
		/*	Pr�paration de la requ�te SQL	*/
		$sql = "DELETE FROM ".$table." WHERE ".$condition;
		$req = $bdd -> prepare($sql);
		/*	On execute la commande			*/
		$req -> execute();
		/*	On se d�connecte de la base		*/
		$bdd = Database::disconnectDatabase();
		$bdd = null;
	}
	function select($table, $champs, $condition){
		/*
		 * Retourner le pr�nom (Firstname) d'un utilisateur caract�ris� par son adresse mail
		 * 		$test -> select('users', 'Firstname', "Login = 'SonAdresseMail'");
		 * Attention ! Cet m�thode vous retourne un objet PDO ! CE qui signifie qu'il n'est pas utilisable tel quel.
		 * Vous devez utiliser la m�thode fetch afin de pouvoir utiliser cet donn�e.
		 * 
		 * */
		/*	Connection � la base de donn�e	*/
		$bdd = Database::connectDatabase();
		
        $bdd -> query("SET NAMES utf8");
		/*	Pr�paration de la requ�te SQL	*/
        if ($condition != "Order by Date"){
			$sql = "SELECT ".$champs." FROM ".$table." WHERE ".$condition;
        }
        else {
        	$sql = "SELECT ".$champs." FROM ".$table;
        }
       	/*	On execute la commande			*/
		$resultat = $bdd -> query($sql);
		$bdd = Database::disconnectDatabase();
		$bdd = null;
		return $resultat ; // PDO	
	}


        function show($table)
      {
	/*
		 * Retourner l'ensemble des colonnes de la table
		 * Attention ! Cet m�thode vous retourne un objet PDO ! CE qui signifie qu'il n'est pas utilisable tel quel.
		 * Vous devez utiliser la m�thode fetch afin de pouvoir utiliser cet donn�e.
		 * 
		 * */
		/*	Connection � la base de donn�e	*/
		$bdd = Database::connectDatabase();
                  $bdd -> query("SET NAMES utf8");
		
		/*	Pr�paration de la requ�te SQL	*/
		$sql = "SHOW COLUMNS FROM ".$table;
                		/*	On execute la commande			*/
		$resultat = $bdd -> query($sql);
                		/*	On se d�connecte de la base		*/
		$bdd = Database::disconnectDatabase();
		$bdd = null;
		return $resultat ;	
	}
	function encodage(){
		$bdd = Database::connectDatabase();
		$bdd->exec('SET NAMES utf8');
		$bdd = Database::disconnectDatabase();        
		$bdd = null;
	}
}

?>