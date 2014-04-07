<?php
$result;
function identify($login, $mdp) {
	global $connect;
	
		$result = mysql_query("SELECT Password FROM membre WHERE Login =\"$login\"", $connect) or die("MySQL Error : " . mysql_error());
		
		$passFromBD = mysql_fetch_row($result);
			if($passFromBD[0] ==$mdp)
			{
				$_SESSION['user'] = $login;
				return true;
			}
			else
				return false;
			
			
}

?>