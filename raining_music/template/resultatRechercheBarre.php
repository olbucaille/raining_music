<?php
// on inclut le header
include ("./../layout/basic_header.php");
?>

<div>
	<h1>Résultats de la recherche </H1>
</div>



<div>
	</br>
         <?php   if ($nb_resultatsGroupes != "0"): ?>
    
             <?php foreach ($resultatsGroupes as $infosGroupes): ?>
             
    <div>
		<h1><?php echo"<a href='../template/AffichageGroupeAdmin.php?id_groupe=".$infosGroupes['Id']."'>".htmlentities($infosGroupes['Nom'])."</a>";?></h1>

		<div>
			<span> <span> <span> <?php echo "Dont la popularité est:".$infosGroupes['Popularite']; ?> </span> 
			</span>
			</span>
		</div>

	</div>

<?php endforeach; ?></div>
<!-- fin de la boucle -->
<?php
else :
										echo "<h2>Aucun résultat ne correspond à  votre recherche pour les artistes enregistrés sur notre site</h2>";
										?>
           
        <?php endif;?>


 <?php  if ($nb_resultatsSalles != "0"): ?>
    
             <?php foreach ($resultatsSalles as $infosSalles): ?>
             
    <div>
		<h1><?php echo "La salle '".htmlentities($infosSalles['Nom'])."' appartient à: ". htmlentities($infosSalles['Proprietaire']);?></h1>

		<div>
			<span> <span> <span> <?php echo "Elle se situe au: ". htmlentities($infosSalles['Adresse']); ?> </span> 
			<span> <?php echo "\nDispose de ". $infosSalles['NbPlaces']." places maximum";  ?></span>
			<span> <?php echo "\nL'ouverture de la salle s'effectue le: ". $infosSalles['Horaires'];  ?></span>
			</span>
			</span>
			
		</div>

	</div>

<?php endforeach; ?></div>
<!-- fin de la boucle -->



									 <?php
else :
										echo "<h2>Aucun résultat ne correspond à  votre recherche pour les salles de concert enregistrées sur notre site</h2>";
										?>
           
        <?php endif;?>



<!-- PIED DE PAGE -->
<?php
// ... puis le footer
include ("./../layout/basic_footer.php");
?>
