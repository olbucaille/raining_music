<?php
// on inclut le header
include ("./../layout/basic_header.php");
?>

<div>
	<H1>Rï¿½sultats de la recherche</H1>
</div>
<p>
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
		 	echo $_POST ['Nom'];
		 elseif ($_POST['kindOfObject']=="salle"):
		 	echo "le département: ".$_POST['dep'];
		 else :
			echo "aucun paramï¿½tre filtrï¿½";
		endif;
		?></p>



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

<?php   elseif (($nb_resultats != "0")&&($_POST['kindOfObject']=="groupe")): ?>
    
             <?php foreach ($resultats as $infos): ?>

<div>
	<h2><?php echo $infos['Nom'];?></h2>

	<div>
		<span> <span> <span> <?php echo "ID du groupe en BdD: ".$infos['Id']; ?> </span>
             <?php if( $infos['Popularite']!=null):?>
            	<span> <?php echo "Popularite: ".$infos['Popularite'];
            	else :echo "Popularite: cet(te) artiste n'est pas encore ï¿½valuï¿½(e)";  ?></span>
            <?php endif;?>
            <span> <?php if($_POST['styleMusique']!="NonSpecifie")echo "Genre musical: ".$_POST['styleMusique'];  ?></span>
		</span>
		</span>

	</div>


<?php endforeach; ?></div>

<?php   elseif (($nb_resultats != "0")&&($_POST['kindOfObject']=="concert")): ?>
    
             <?php foreach ($resultats as $infos): ?>
<div>
	<h2><?php echo $infos['Date'];?></h2>
	 <div>
		<span> <span> <?php echo $infos['Nom']; ?>
	</div>
</div>

<?php endforeach; ?></div>

<!-- fin de la boucle -->

									 <?php
else :
										echo "<h2>Aucun rï¿½sultat ne correspond ï¿½ votre recherche</h2>";
										?>
           
        <?php endif;?>



<!-- PIED DE PAGE -->
<?php
// ... puis le footer
include ("./../layout/basic_footer.php");
?>
