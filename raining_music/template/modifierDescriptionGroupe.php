<?php
include("./../layout/basic_header.php");
include("./../db_connect.inc.php");
include("./../model/group.php");


if(isset($_POST["nom_groupe"]) && isset($_POST["description_groupe"]))
{
	// afficher un champs de texte avec la description originale

	$nom_groupe = $_POST["nom_groupe"];
	$description = $_POST["description_groupe"];
	$retour = Group::updateGroupDescription($nom_groupe,$description);
	if($retour)
		echo " la modification est faite"; // on peut rediriger l'utilisateur vers l'accueil...		
	else
		echo " une erreur s'est produite !";
}

?>