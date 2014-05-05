<?php
include_once '../db_connect.inc.php';


class requestSQL{
	
	
	function select($table, $champs, $condition){
		
		/*	Connection à la base de donnée	*/
		$bdd = connect();
		
        $bdd -> query("SET NAMES utf8");
		/*	Préparation de la requete SQL	*/
        if ($condition != "Order by Date"){
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
		
		/*	Connection à la base de donnée	*/
		$bdd = connect();
                  $bdd -> query("SET NAMES utf8");
		
		/*	Préparation de la requete SQL	*/
		$sql = "SHOW COLUMNS FROM ".$table;
                		/*	On execute la commande			*/
		$resultat = $bdd -> query($sql);
                		/*	On se déconnecte de la base		*/
		$bdd = connect();
		$bdd = null;
		return $resultat ;	
	}

}

?>