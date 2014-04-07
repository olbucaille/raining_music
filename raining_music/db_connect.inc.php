<?php
$connect = mysql_connect("localhost","root","") or die("impossible de se connecter : " . mysql_error());
$db_selected = mysql_select_db("bd_raining_music", $connect);

if(!$db_selected)
{
	die('impossible de selectionner la base de  données : ' . mysql_error());
}
	

?>
