<?php 
// permet de charger la session courante : avec par exemple les données relative à la connexion de l'utilisateur
session_start();
require_once '../model/user.php';
?>
<!DOCTYPE html >
<html lang="fr">
<head>
<meta charset="iso8859">
<link rel="stylesheet" type="text/css" href="../CSS/style.css"/>
<link rel="icon" type="image/gif" href="../pictures/favicon.ico" />

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


<!-- DEBUT - SearchBarre + SignalerAbus -->

<div style="position:fixed;top:300px;z-index:0;margin-left:90%;" class="PetitBlocPourLeSignalementEtLaRecherche">
<ul style="background-color: transparent;border:1px; border-color:#fff; width: 150px; border-radius:5px; padding: 1px; margin: 1px;">
<li >

<form  method="post" action="../Controller/traitementSearch.php">
<img alt="caution" src="../pictures/caution30px.png"/><a  href="../template/signalerAbus.php" style="color: red ;font-size:12px">Signaler un abus</a><br/><br/>
	<input type="radio"
		name="kindOfObject" value="menuSearchBarre" CHECKED hidden>
		<p style="margin: 0px; color: #fff">Recherche:</p> 
<input name="motcleSearch" type="search" placeholder="Search" style="margin-top:0px;width:100%;height:24px;" required /><br/><br/>
<input name="go" type="submit" value="Envoyer"/>
</form></li>
</ul>
</div>
<!-- <div class="searchAndSignal">
<ul>
<li >
<form  class="search" method="post" action="../Controller/traitementSearch.php">
<img alt="caution" src="../pictures/caution30px.png"/><a class="signalerAbus" href="../template/signalerAbus.php">Signaler un abus</a><br/><br/>
	<input type="radio"
		name="kindOfObject" value="menuSearchBarre" CHECKED hidden>
<input class="search_data" name="motcleSearch" type="search" placeholder="Mot(s) clé(s)" required /><br/><br/>
<input class="btn-right-loupe" name="go" type="submit" value="Envoyer"/>
</form></li>
</ul>
</div>-->


<div class="conteneurBanniereMenu">

<header class="banniere">      
		<a href="../index.php"><img src="../pictures/NewBanner04.bmp" alt="RainingMusic"  title="RainingMusic"  width="100%" style="max-width:1200px; max-height:300px;min-height:230px; margin-left:10%; width: 80%" /></a>
        <div style="position:absolute;top:0px;margin-left:70%;">
            <div id="loginFormContainer">

<?php 
include("./../layout/connectForm.php");
include("./../layout/menu.php");?>
</div>





<!-- div conteneur : premiere div, elle permet de placer tous les autres composants!--> 
<div class="conteneur">
<!-- haut de page : photo + connexion !-->

