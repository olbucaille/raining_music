<?php 
 
require_once 'db_connect.inc.php';
include_once './Controller/userControler.php';
include_once 'model/user.php'; 
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
