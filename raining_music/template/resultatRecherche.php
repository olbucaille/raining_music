<?php
// on inclut le header
include ("./../layout/basic_header.php");
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
		avec comme mot(s) clé(s) : "<i><?php echo $_POST['motcleSearch']?></i>" et un filtre sur : 
		<?php
		
		if ($_POST ['kindOfObject'] == "membre") :
			echo $_POST ['userParam'];
		 elseif ($_POST ['kindOfObject'] == "groupe") :
			echo "le style de musique => " . $_POST ['styleMusique'];
		 elseif ($_POST ['kindOfObject'] == "concert") :
			echo "rien";
		 elseif ($_POST ['kindOfObject'] == "salle") :
			echo "le département: " . $_POST ['dep'];
		 else :
			echo "aucun paramétre filtré";
		endif;
		?></p>
	<!-- ------------------------------------------- -->
	<!-- ------------------------------------------- -->
		
<?php $alphabet=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");?>		
		
		
<!-- ------------------------------------------- -->
	<!-- 	AFFICHAGE DES RESULTATS SUR LES MEMBRES	 -->
	<!-- ------------------------------------------- -->

<?php   if (($nb_resultats != "0")&&($_POST['kindOfObject']=="membre")): ?>
    <h2 class="SubtitlesForSearchResults">Membres correspondant à votre
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
	
	<h4 class="resultNames"><?php echo $infos['Login'];?></h4>
		<div class="resultInfos">
			 <span> <span> <?php echo"<b>Vrai nom: </b>"; 
			if (isset($infos['Nom'])) echo $infos['Nom'];
			else echo "non renseigné"?> </span> <br/>
			<span> <?php echo "<b>Adresse e-mail:</b> ". $infos['Mail']." adresse à cacher si besoin !!";  ?></span><br/>
			<span><?php if ($infos['DoB']!="0000-00-00") echo "<b>Date de naissance: </b>". $infos['DoB']; else echo " <b>Date de naissaince</b> non renseignée" ; ?> </span><br/> 
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
			correspondant à votre recherche</h2>


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
	
	<h4 class="resultNames"><?php echo $infos['Nom'];?></h4>

			<div>
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


            <span> <?php if($_POST['styleMusique']!="NonSpecifie")echo "Genre musical: ".$_POST['styleMusique'];  ?></span>
				</span>
				</span>
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
    
             <?php foreach ($resultats as $infos): ?>
<div>
			<h2><?php echo $infos['Date'];?></h2>
			<div>
				<span> <span> <?php echo $infos['Nom']; ?>
	
			
			</div>
		</div>

<?php endforeach; ?>
<!-- ------------------------------------------- -->
		<!-- ------------------------------------------- -->


		<!-- ------------------------------------------- -->
		<!-- 	AFFICHAGE DES RESULTATS SUR LES SALLES	 -->
		<!-- ------------------------------------------- -->
<?php   elseif (($nb_resultats != "0")&&($_POST['kindOfObject']=="salle")): ?>
    <h2 class="SubtitlesForSearchResults">Salles de concert
			correspondant à votre recherche</h2>
		<div>
    <?php
	for($i = 0; $i < 26; $i ++) {
		?>

    <h3><?php echo $alphabet[$i]?></h3>
			<hr />
<?php foreach ($resultats as $infos): ?>
<?php
		
$check = new checkDataBase ();
$resultatSalle = $check->checkRecherche ( "salle", "Nom LIKE '" . $alphabet [$i] . "%' AND REPLACE (Nom, ' ', '-')='" . str_replace(' ','-',$infos ['Nom']) . "'" );
			$nb_resultatsSalle = count ( $resultatSalle);
			?>

<?php
			
if ($nb_resultatsSalle!= 0) :
				?>
	
	<h4 class="resultNames"><?php echo $infos['Nom'];?></h4>

		<div>
		<p> <?php echo "L'adresse de la salle est: ".$infos['Adresse']."."; ?>
		<p> <?php echo "Dans le département: ".$infos['Departement']."."; ?>
		<br/> <?php echo "Il y a ".$infos['NbPlaces']." places."; ?>
		<br/> <?php echo "Le proprietaire est: ".$infos['Proprietaire']; ?>
	
			
			</div>
<?php endif;
		
endforeach;?> <?php }?>
<!-- fin de la boucle -->

		<!-- ------------------------------------------- -->
		<!-- ------------------------------------------- -->


		<!-- ------------------------------------------- -->
		<!-- 		AFFICHAGE QUAND AUCUN RESULTAT		 -->
		<!-- ------------------------------------------- -->
									 
 <?php else :
	echo "<h2>Aucun résultat ne correspond à votre recherche</h2>";
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
