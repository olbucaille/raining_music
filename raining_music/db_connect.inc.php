
<?php
// reprise du code du cours avec ajout d'une vérification pour la sélection de base de donnée
$connect = mysql_connect("localhost","root","") or die("impossible de se connecter : " . mysql_error());
$db_selected = mysql_select_db("bd_raining_music", $connect);

if(!$db_selected)
{
	die('impossible de selectionner la base de  données : ' . mysql_error());
}
	

?>
