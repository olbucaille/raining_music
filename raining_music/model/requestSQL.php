<?php
include_once '../db_connect.inc.php';


class requestSQL{
	
	
	function select($table, $champs, $condition){
		
		/*	Connection � la base de donn�e	*/
		$bdd = connect();
		
        $bdd -> query("SET NAMES utf8");
		/*	Pr�paration de la requete SQL	*/
        if ($condition != ""){
			$sql = "SELECT ".$champs." FROM ".$table." WHERE ".$condition;
        }
        else {
        	$sql = "SELECT ".$champs." FROM ".$table;
        }
       	/*	On execute la commande			*/
		$resultat = $bdd -> query($sql);
		$bdd = connect();
		$bdd = null;
		return $resultat ; // PDO	
	}


        function show($table)
      {
	/*
		
		/*	Connection � la base de donn�e	*/
		$bdd = connect();
                  $bdd -> query("SET NAMES utf8");
		
		/*	Pr�paration de la requete SQL	*/
		$sql = "SHOW COLUMNS FROM ".$table;
                		/*	On execute la commande			*/
		$resultat = $bdd -> query($sql);
                		/*	On se d�connecte de la base		*/
		$bdd = connect();
		$bdd = null;
		return $resultat ;	
	}

	
	
	public static function getAllConcerts()
	{
	
		//conection BDD
		$connexion = connect();
	
		//verification groupe identique n'existe pas
		$requete= $connexion->prepare("select * from concert"); //preparation requete
		//		echo "SELECT * FROM groupe WHERE Nom =\"$g->nom\" ";
		if($requete->execute())//execution(pas de verification securit� a faire => automatique)
		{
			$i = 0;
			while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
				$i++;
	
			return $i;
		}
		else
			echo " erreur lors de selection des concerts";
		return 0;
	}
	
	
	
	
}

?>