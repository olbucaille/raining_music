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
		avec comme mot(s) clï¿½(s) : "<i><?php echo $_POST['motcleSearch']?></i>" et un filtre sur : 
		<?php
		
if ($_POST ['kindOfObject'] == "membre") :
			echo $_POST ['userParam'];
		 elseif ($_POST ['kindOfObject'] == "groupe") :
			echo "le style de musique => " . $_POST ['styleMusique'];
		 elseif ($_POST ['kindOfObject']== "concert") :
		 	echo "rien";
		 elseif ($_POST['kindOfObject']=="salle"):
		 	echo "le département: ".$_POST['dep'];
		 else :
			echo "aucun paramï¿½tre filtrï¿½";
		endif;
		?></p>
<!-- ------------------------------------------- -->
<!-- ------------------------------------------- -->
		
		
		
		
<!-- ------------------------------------------- -->
<!-- 	AFFICHAGE DES RESULTATS SUR LES MEMBRES	 -->
<!-- ------------------------------------------- -->


<div>
	</br>
         <?php   if (($nb_resultats != "0")&&($_POST['kindOfObject']=="membre")): ?>
    
             <?php foreach ($resultats as $infos): ?>
             
    <div>
		<h1><?php echo $infos['Login'];?></h1>

		<div>
			<span> <span> <span> <?php echo $infos['Nom']; ?> </span> <span> <?php echo $infos['Mail'];  ?></span>
			</span>
			</span>
			<div>
				<span><?php echo $infos['DoB'];  ?> </span> <span> <?php echo $infos['Localisation'];  ?>  </span>
			</div>
		</div>

	</div>

<?php endforeach; ?></div>
<!-- fin de la boucle -->

<!-- ------------------------------------------- -->
<!-- ------------------------------------------- -->

		
<!-- ------------------------------------------- -->
<!-- 	AFFICHAGE DES RESULTATS SUR LES GROUPES	 -->
<!-- ------------------------------------------- -->

<?php   elseif (($nb_resultats != "0")&&($_POST['kindOfObject']=="groupe")): ?>
    <h2 class="SubtitlesForSearchResults">Groupes de musique correspondants à votre recherche</h2>
    
    
    <div>
    <?php 
    $alphabet=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    
        for ($i = 0; $i < 26; $i++) {?>

    <h3><?php echo $alphabet[$i]?></h3><hr/>
             <?php foreach ($resultats as $infos): ?>
<?php $check = new checkDataBase ();
$resultatGroupe = $check->checkRecherche ( "groupe", "Nom LIKE '".$alphabet[$i]."%' AND Nom='".$infos['Nom']."'");
$nb_resultatsGroup = count ( $resultatGroupe );?>

<?php if ($nb_resultatsGroup!=0):
	?>
	
	<h4 class="resultNames"><?php echo $infos['Nom'];?></h4>

	<div>
		<span> <span>
             <?php if( $infos['Popularite']!=null):?>
            	<span> <?php echo "Popularite: ".$infos['Popularite'];
            	else :echo "Popularite: cet(te) artiste n'est pas encore ï¿½valuï¿½(e)";  ?></span>
            <?php endif;?>
            
            <?php $checkStyle = new checkDataBase ();
			$resultatStyle = $checkStyle->getMusicStyle($infos['Nom']);
			//$temp=$resultatStyle->fetchAll();
			$nb_resultatStyle = count ( $resultatStyle );?>


            <span> <?php if($_POST['styleMusique']!="NonSpecifie")echo "Genre musical: ".$_POST['styleMusique'];  ?></span>
		</span>
		</span>
		<?php endif;?>





<?php endforeach;
?> <?php   }
    
    ?>
</div>


<div>
	

	</div>


</div>
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
    
             <?php foreach ($resultats as $infos): ?>
<div>
	<h2><?php echo "La salle ".$infos['Nom']." se trouve dans le département: ".$infos['Departement'];?></h2>
	 <div>
		<span> <span> <?php echo "L'adresse de la salle est: ".$infos['Adresse']." - "; ?>
		<span> <?php echo "Il y a ".$infos['NbPlaces']." places - "; ?>
		<span> <?php echo "Le proprietaire est: ".$infos['Proprietaire']; ?>
	</div>
</div>

<?php endforeach; ?>
<!-- fin de la boucle -->

<!-- ------------------------------------------- -->
<!-- ------------------------------------------- -->

		
<!-- ------------------------------------------- -->
<!-- 		AFFICHAGE QUAND AUCUN RESULTAT		 -->
<!-- ------------------------------------------- -->
									 <?php
else :
										echo "<h2>Aucun rï¿½sultat ne correspond ï¿½ votre recherche</h2>";
										?>
           
        <?php endif;?>

<!-- ------------------------------------------- -->
<!-- ------------------------------------------- -->
</div> <!-- class="containerSearchResults" -->

<!-- PIED DE PAGE -->
<?php
// ... puis le footer
include ("./../layout/basic_footer.php");
?>
