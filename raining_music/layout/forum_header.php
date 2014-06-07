<?php
//This page displays the list of the forum's categories
include('config.php');
?>

<!DOCTYPE html >
<html lang="fr">

<head>
	<meta charset="iso-8859-1">
	<link href="<?php echo $design; ?>/style.css" rel="stylesheet"	title="Style" />
	
	<link rel="stylesheet" type="text/css" href="../CSS/style.css" />
	<link rel="icon" type="image/gif" href="../pictures/favicon.ico" />
	
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="functions.js"></script>
 
	
	<title>RainingMusic - Soyez arrosé d'informations !</title>

</head>


		<?php 
		// permet de charger la session courante : avec par exemple les données relative à la connexion de l'utilisateur
		session_start();
		require_once '../model/user.php';
		?>
		<!-- body : "racine" de la page !-->
		<body>


			<!-- DEBUT - Bouton haut de page -->
			<a href="#hautpage"><div id="btntop"></div> </a>
			<a name="hautpage" id="hautpage"></a>
			<div id="header"></div>
			<!-- FIN - Bouton haut de page -->

			<!-- DEBUT - Boutons Facebbok et Twitter -->
			<div class="social">
				<ul>
					<li><a target=blank class="twitterbutton" href="http://twitter.com">Twitter</a>
					</li>
					<li><a target=blank class="facebookbutton"
						href="http://www.facebook.com/rainingmusic.isepgroup">Facebook</a>
					</li>
				</ul>
			</div>
			<!-- DEBUT - Boutons Facebbok et Twitter -->


			<!-- div conteneur : premiere div, elle permet de placer tous les autres composants!-->
			<div class="conteneur">
				<!-- haut de page : photo + connexion !-->
				<header class="banniere"> <a href="../index.php"><img
					src="../pictures/NewBanner04.bmp" alt="RainingMusic"
					title="RainingMusic" height="100%" width="100%"
					style="max-height: 300px;" /> </a>
				<div style="position: absolute; top: 0px; margin-left: 70%;">
					<div id="loginFormContainer">

						<?php 
						include("./../layout/connectForm.php");
include("./../layout/menu.php");?>
