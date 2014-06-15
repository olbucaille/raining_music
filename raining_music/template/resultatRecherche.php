<?php
// on inclut le header
include ("./../layout/basic_header.php");
include ("./../model/group.php");
?>

<div>
	<H1 class="SearchResults">Résultats de la recherche avancée</H1>
</div>


<div class="containerSearchResults">
	<!-- ------------------------------------------- -->
	<!-- TEXTE QUI RECAPITULE LA RECHERCHE EFFECTUEE -->
	<!-- ------------------------------------------- -->

	<p class="quasiHiddenText">
		Recherche sur un<?php
		
		if ($_POST ['kindOfObject'] == "salle") :
			echo "e " . $_POST ['kindOfObject'];
		 else :
			echo " " . $_POST ['kindOfObject'];
		endif;
		?> 
		<?php if ( $_POST ['motcleSearch']!=null&& $_POST ['motcleSearch']!="") echo "avec comme mot(s) clé(s) :'<i>". $_POST['motcleSearch']."' et"; ?> 
		<?php
		
		if ($_POST ['kindOfObject'] != "membre") :
			echo " avec un filtre sur </i>: ";
		
		endif;
		if ($_POST ['kindOfObject'] == "groupe") :
			echo "le style de musique => " . $_POST ['styleMusique'];
		 elseif ($_POST ['kindOfObject'] == "concert") :
			echo "rien";
		 elseif ($_POST ['kindOfObject'] == "salle") :
			echo "le département: " . $_POST ['dep'];
		 else :
			echo "aucun paramètre filtré";
		endif;
		?></p>
	<!-- ------------------------------------------- -->
	<!-- ------------------------------------------- -->
		
<?php $alphabet=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");?>		
		
		
<!-- ------------------------------------------- -->
	<!-- 	AFFICHAGE DES RESULTATS SUR LES MEMBRES	 -->
	<!-- ------------------------------------------- -->

<?php   if (($nb_resultats != "0")&&($_POST['kindOfObject']=="membre")): ?>
    <h2 class="SubtitlesForSearchResults">Membres correspondant à  votre
		recherche</h2>


	<div>
    <?php
	
	for($i = 0; $i < 26; $i ++) {
		?>

    <h3><?php echo $alphabet[$i]?></h3>
		<hr />
             <?php foreach ($resultats as $infos): ?>
<?php

			$check = new checkDataBase ();
			$resultatMembre = $check->checkRecherche ( "membre", "Login LIKE '" . $alphabet [$i] . "%' AND Login='" . $infos ['Login'] . "'" );
			$nb_resultatMembre = count ( $resultatMembre );
			?>

<?php
			
			if ($nb_resultatMembre) :
				?>
	
	
	    <?php $link =  "./../index.php?action='visualiser_User'&Nom=".$infos['Login'];?>
    
		<h4 class="resultNames"><?php echo htmlentities($infos['Login']);?></h4>
		<div class="resultInfos">
			<a class="resultInfos" href=<?php echo $link?>> voir profil </a><br />
			<span> <span> <?php
				
echo "<b>Vrai nom: </b>";
				if (isset ( $infos ['Nom'] ))
					echo htmlentities ( $infos ['Nom'] );
				else
					echo "non renseigné"?> </span> <br /> <span> <?php echo "<b>Adresse e-mail:</b> ". $infos['Mail']." adresse à  cacher si besoin !!";  ?></span><br />
				<span><?php if ($infos['DoB']!="0000-00-00") echo "<b>Date de naissance: </b>". $infos['DoB']; else echo " <b>Date de naissaince</b> non renseignée" ; ?> </span><br />
				<span> <?php if ($infos['Localisation']!="null") echo "<b>Localisation: </b>".$infos['Localisation']; else echo "<b>Localisation</b> non renseignée" ?>  </span>
			</span>
		</div>


<?php  endif;?>

<?php
		endforeach
		;
		?> <?php
	}
	
	?>
<!-- fin de la boucle -->

		<!-- ------------------------------------------- -->
		<!-- ------------------------------------------- -->


		<!-- ------------------------------------------- -->
		<!-- 	AFFICHAGE DES RESULTATS SUR LES GROUPES	 -->
		<!-- ------------------------------------------- -->

<?php   elseif (($nb_resultats != "0")&&($_POST['kindOfObject']=="groupe")): ?>
    <h2 class="SubtitlesForSearchResults">Groupes de musique
			correspondant à  votre recherche</h2>
		<!-- SELECT `Nom_genre_musical` FROM groupe_genre_musical WHERE `Id_groupe`=(SELECT `Id` FROM `groupe` WHERE `Nom`='Hey Dude !') -->

		<div>
    <?php
	
	for($i = 0; $i < 26; $i ++) {
		?>

    <h3><?php echo $alphabet[$i]?></h3>
			<hr />
             <?php foreach ($resultats as $infos): ?>
<?php

			$check = new checkDataBase ();
			$resultatGroupe = $check->checkRecherche ( "groupe", "Nom LIKE '" . $alphabet [$i] . "%' AND Nom='" . $infos ['Nom'] . "'" );
			$nb_resultatsGroup = count ( $resultatGroupe );
			?>

<?php
			
			if ($nb_resultatsGroup != 0) :
				?>
	<!--LIGNES DE CODE POUR RECUPERER L'ID DU GROUPE EN BASE POUR FAIRE LE LIEN VERS LA PAGE PROFIL-->
	<?php
				$requestID = new requestSQL (); // Création d'un objet Request SQL permettant de faire une requete SQL pré-construite
				$dataID = $requestID->select ( 'groupe', 'Id', "Nom='" . $infos ['Nom'] . "'" );
				?>
	
	
	
	<h4 class="resultNames"><?php echo "<a href='../template/AffichageGroupeAdmin.php?id_groupe=".$infos['Id']."'>".htmlentities($infos['Nom']);?></a>
			</h4>

			<div class="resultInfos">
				<?php
				$checkMusicStyle = new checkDataBase ();
				$resultMusicStyle = $checkMusicStyle->getMusicStyle ( $infos ['Nom'] );
				$nb_resultMusicStyle = count ( $resultMusicStyle );
				
				// print_r($resultMusicStyle);
				?>	
			
			
	<?php
				if ($nb_resultMusicStyle != 0) {
					foreach ( $resultMusicStyle as $Row ) :
						echo "Genre musical : " . $Row ['Nom_genre_musical'] . "<br/>";
					endforeach
					;
				}
				?>
				<span> <span>
             <?php if( $infos['Popularite']!=null):?>
            	<span> <?php
					
					echo "Popularite: " . $infos ['Popularite'];
				 else :
					echo "Popularite: cet(te) artiste n'est pas encore évalué(e)";
					?></span>
            <?php endif;?>
            
            <?php
				
				$checkStyle = new checkDataBase ();
				$resultatStyle = $checkStyle->getMusicStyle ( $infos ['Nom'] );
				// $temp=$resultatStyle->fetchAll();
				$nb_resultatStyle = count ( $resultatStyle );
				?>


				</span>
			
			</div>
		<?php endif;?>





<?php
		endforeach
		;
		?> <?php
	}
	
	?>
		<!-- ------------------------------------------- -->
			<!-- ------------------------------------------- -->


			<!-- ------------------------------------------- -->
			<!-- 	AFFICHAGE DES RESULTATS SUR LES CONCERTS -->
			<!-- ------------------------------------------- -->

<?php   elseif (($nb_resultats != "0")&&($_POST['kindOfObject']=="concert")): ?>
<?php //DEBUG
	//print_r($nb_resultats)?>
 <h2 class="SubtitlesForSearchResults">Concerts correspondant à  votre
				recherche</h2>
    
             <?php foreach ($resultats as $infos): ?>
             <?php 
// parsing
		$idConcert = $infos ['Id'];
		$nomConcert = $infos ['Nom'];
		$dateConcert = $infos ['Date'];
		$heureConcert = $infos ['Heure'];
		$prixConcert = $infos ['Cout'];
		$descriptionConcert = $infos ['Description'];
		$salleConcert = $infos ['salle'];
		$groupeConcert = $infos ['Groupe'];
		$salleAcceptation = $infos ['salle_acceptee'];
		$groupeAcceptation = $infos ['Concert_accepte'];
		
		// DATE, test si la date est dans le futur
		$now = date ( 'Y-m-d' );
		$next = $dateConcert;
		
		// test
		$now = new DateTime ( $now );
		$now = $now->format ( 'Ymd' );
		$next = new DateTime ( $next );
		$next = $next->format ( 'Ymd' );
		// le concert est actif ?
		if ($salleAcceptation == 1 && $groupeAcceptation == 1) {
			// le concert est à venir ?
			if ($now < $next) {
				?>
             	<?php
				$departementConcert = Group::getDepConcert ( $idConcert );
				foreach ( $departementConcert as $Row2 ) {
					// print_r($departementConcert);
					$depConcert = $Row2 ['Departement'];
					?>
             
             
<h4 class="resultNames"><?php echo"<a href='#'> ". $nomConcert;?></a>
			</h4>

			<div><?php 
// DEBUG
// print_r($depConcert);					?>
		<p> <?php echo "Ce concert se déroulera dans la salle ".$salleConcert." dans le (".$depConcert.").<br/>"; ?>
		 <?php echo "On y retrouvera ".$groupeConcert." pour un spectacle exceptionnel."; ?>
		<br /> <?php echo "Notez bien la date : le ".$dateConcert." à ".$heureConcert." !"; ?>
		<?php echo "<br/><span style='font-size:12px; font-style:italic; '>Pour plus d'informations, cliquez sur le nom du concert.</span>"?></p>

			</div>
			<hr />

			<?php
				}
			}?>
			</div>
			<?php
		}
		
		?>
		


<?php endforeach; ?>
<!-- ------------------------------------------- -->
		<!-- ------------------------------------------- -->


		<!-- ------------------------------------------- -->
		<!-- 	AFFICHAGE DES RESULTATS SUR LES SALLES	 -->
		<!-- ------------------------------------------- -->
<?php   elseif (($nb_resultats != "0")&&($_POST['kindOfObject']=="salle")): ?>
    <h2 class="SubtitlesForSearchResults">Salles de concert
			correspondant à  votre recherche</h2>
		<div>
    <?php
	for($i = 0; $i < 26; $i ++) {
		?>

    <h3><?php echo $alphabet[$i]?></h3>
			<hr />
<?php foreach ($resultats as $infos): ?>
<?php

			$check = new checkDataBase ();
			$resultatSalle = $check->checkRecherche ( "salle", "Nom LIKE '" . $alphabet [$i] . "%' AND REPLACE (Nom, ' ', '-')='" . str_replace ( ' ', '-', $infos ['Nom'] ) . "'" );
			$nb_resultatsSalle = count ( $resultatSalle );
			?>

<?php
			
			if ($nb_resultatsSalle != 0) :
				$infos ['Nom'] = htmlentities ( $infos ['Nom'] );
				
				$infos ['Adresse'] = htmlentities ( $infos ['Adresse'] );
				$infos ['Proprietaire'] = htmlentities ( $infos ['Proprietaire'] );
				?>
	
	<h4 class="resultNames"><?php echo"<a href='../template/Salle.php?Nom=".$infos['Nom']."'> ". $infos['Nom'];?></a>
			</h4>

			<div>
				<p> <?php echo "L'adresse de la salle est: ".$infos['Adresse']."."; ?>
		
	
				<p> <?php echo "Dans le département: ".$infos['Departement']."."; ?>
		<br /> <?php echo "Il y a ".$infos['NbPlaces']." places."; ?>
		<br /> <?php echo "Le proprietaire est: ".$infos['Proprietaire']; ?>
	
			
			
			
			</div>

			<?php endif;
		endforeach
		;
		?> <?php }?>
<!-- fin de la boucle -->

		<!-- ------------------------------------------- -->
		<!-- ------------------------------------------- -->


		<!-- ------------------------------------------- -->
		<!-- 		AFFICHAGE QUAND AUCUN RESULTAT		 -->
		<!-- ------------------------------------------- -->
									 
 
 <?php
else :
	echo "<h2>Aucun résultat ne correspond à  votre recherche</h2>";
	$link = "http://localhost/raining_music/raining_music/template/RechercheAvancee.php";
	echo "Vous allez être redirigé vers la page de recherche avancée dans 5 secondes. <br/>Si la redirection ne s'effectue pas, <a href=" . $link . ">cliquez ici</a>."?><?php

	header ( "Refresh: 5;URL=http://localhost/raining_music/raining_music/template/RechercheAvancee.php" );
	exit ();
	
	?>
           
        <?php endif;?>

<!-- ------------------------------------------- -->
					<!-- ------------------------------------------- -->
	
				
				</div>
	<!-- class="containerSearchResults" -->

	<!-- PIED DE PAGE -->
<?php
// ... puis le footer
include ("./../layout/basic_footer.php");
?>
