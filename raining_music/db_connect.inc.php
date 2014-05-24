<?php


function connect(){
	

	$PARAM_hote='10.0.120.16'; // le chemin vers le serveur
	$PARAM_port='3306';
	$PARAM_nom_bd='dotgamehmod1'; // le nom de votre base de données
	$PARAM_utilisateur='dotgamehmod1'; // nom d'utilisateur pour se connecter
	$PARAM_mot_passe='UOA6up7E'; // mot de passe de l'utilisateur pour se connecter
		$connexion =  new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
	return $connexion;
}


	?>
