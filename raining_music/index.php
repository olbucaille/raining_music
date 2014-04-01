<?php
session_start();
include("controller.inc.php");




if(strcmp($action,'deco'))
{
	session_destroy();
	session_start();
}

if(strcmp($action,'identification'))
{
if(isset($_POST['username']) && isset($_POST['username']) )	
	if(identify($_POST['username'],$_POST['password']))
	header("location:./template/accueil.php");
}


	header("location:./template/accueil.php");

	
?>


