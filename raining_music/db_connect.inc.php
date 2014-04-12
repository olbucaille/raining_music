<?php


function connect(){
	$PARAM_hote='localhost'; // le chemin vers le serveur
	$PARAM_port='3306';
	$PARAM_nom_bd='bd_raining_music'; // le nom de votre base de données
	$PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
	$PARAM_mot_passe=''; // mot de passe de l'utilisateur pour se connecter
	

	$connexion =  new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);

	return $connexion;
}


	?>
