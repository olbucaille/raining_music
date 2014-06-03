<?php 
 
require_once 'db_connect.inc.php';
include_once './Controller/userControler.php';
include_once './Controller/groupControler.php';
include_once './Controller/musicControler.php';
include_once './Controller/salleControler.php';
include_once 'model/user.php'; 
include_once 'model/group.php';
include_once 'model/salle2.php';
include_once 'model/alert.php';
include_once 'model/song.php';
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
