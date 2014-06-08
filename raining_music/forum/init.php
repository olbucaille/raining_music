<?php
session_start();
include './../model/user.php';
//This page let initialize the forum by checking for example if the user is logged
if(!isset($_SESSION['username']) and isset($_COOKIE['username'], $_COOKIE['password']))
{
	$cnn = mysql_query('select password,id from membre where Login="'.mysql_real_escape_string($_COOKIE['username']).'"');
	$dn_cnn = mysql_fetch_array($cnn);
	if(md5($dn_cnn['password'])==$_COOKIE['password'] and mysql_num_rows($cnn)>0)
	{
		$_SESSION['username'] = $_COOKIE['username'];		
		$_SESSION['userid'] = $dn_cnn['id'];
	}
}
echo "test init";
if(isset($_SESSION['user']))
{
	
	echo "session";
		$user = unserialize($_SESSION['user']);
		
				$req = 'select password,id from membre where Login="'.$user->login.'"';
		$cnn = mysql_query($req) or 	die("Impossible de se connecter : " . mysql_error());
			
		//$cnn = mysql_query('');
		//echo 'select password,id from membre where Login="'.$user->login.'"';
		$dn_cnn = mysql_fetch_array($cnn);
	    $_SESSION['username'] = $user->login;
		$_SESSION['userid'] = $dn_cnn['id'];
		
		
		
}
?>