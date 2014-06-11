<?php
//This page displays the list of the forum's categories
include('config.php');
?>





<!DOCTYPE html >
<html lang="fr">
<head>
<meta charset="iso8859">
<link href="./../CSS/style_forum.css" rel="stylesheet"	title="Style" />
<link rel="stylesheet" type="text/css" href="../CSS/style.css"/>
<link rel="icon" type="image/gif" href="../pictures/favicon.ico" />
<link href="./../CSS/style_forum.css" rel="stylesheet"	title="Style" />


<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

<title>Raining Music - La musique à votre portée</title>
</head>
<!-- body : "racine" de la page !-->
<body>


<!-- DEBUT - Bouton haut de page -->
<a href="#hautpage"><div id="btntop"></div></a>
<a name="hautpage" id="hautpage"></a>
<div id = "header"></div>
<!-- FIN - Bouton haut de page -->

<!-- DEBUT - Boutons Facebbok et Twitter -->
<div class="social" >
<ul>
<li><a target=blank class="twitterbutton" href="http://twitter.com">Twitter</a></li>
<li><a target=blank class="facebookbutton" href="http://www.facebook.com/rainingmusic.isepgroup">Facebook</a></li>
</ul>
</div>
<!-- DEBUT - Boutons Facebbok et Twitter -->

<div class="conteneurBanniereMenu">

<header class="banniere">      
		<a href="../index.php"><img src="../pictures/NewBanner04.bmp" alt="RainingMusic"  title="RainingMusic" height="100%" width="100%" style="max-width:1200px; max-height:230px;min-height:230px; margin-left:10%; width: 80%" /></a>
        <div style="position:absolute;top:0px;margin-left:70%;">
            <div id="loginFormContainer">

<?php 
include("./../layout/connectForm.php");
include("./../layout/menu.php");?>
</div>





<!-- div conteneur : premiere div, elle permet de placer tous les autres composants!--> 
<div class="conteneur">
<!-- haut de page : photo + connexion !-->
