<?php

class user{

	var $test;

public static function identify($login, $mdp) {
	//normalement, $connexion est connue partout(variable globale) et est initialisé avant mais si on ne fait pas ça, ça ne marche pas TT
	$connexion = connect();
	$requete= $connexion->prepare("SELECT Password FROM membre WHERE Login =\"$login\""); //preparation requete
	$requete->execute();//execution(pas de verification securité a faire => automatique)
	while($lignes=$requete->fetch(PDO::FETCH_OBJ))//recup de la premiere requete
	{
		if( $lignes->Password ==$mdp)	//si ok
		{
			$_SESSION['user'] = $login; //chargement de variable de session
			return true;
		}
		else
			return false;
	}

	$resultats->closeCursor(); // on ferme le curseur
}


}

?>


