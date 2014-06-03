<?php
 mysql_connect("localhost","root","");
mysql_select_db("bd_raining_music");
	
$nom=isset($_POST['nom'])?$_POST['nom']:"";
$adresse=isset($_POST['adresse'])?$_POST['adresse']:"";
$date=isset($_POST['date'])?$_POST['date']:"";
$heure=isset($_POST['heure'])?$_POST['heure']:"";
$id=isset($_POST['id'])?$_POST['id']:"";
$cout=isset($_POST['cout'])?$_POST['cout']:"";


$sql = "INSERT INTO concert VALUES ('$nom','$adresse','$id','$date','$heure','$cout')";
			$req = mysql_query($sql);
			mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
 mysql_close();
 ?>