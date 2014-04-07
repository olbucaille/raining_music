<?php
//on inclut le modele et la BD
require_once("db_connect.inc.php");
require_once("model/user.php");

//affecte la $action
$r = "action";
global $action;
$action = "unknown";
if(isset($_GET[$r]))
{
	$action = $_GET[$r];
}

function param($name) {
	return $_GET[$name];
}
 
function render($layout,$target) {
	include($layout);
}
?>
