<!-- MODULE DE VOTE A IMPLEMENTER DANS LES PAGES DE GROUPES -->
<!-- Ce module peut être modifier pour être étendu aux salles et concerts -->


<?php
?>


<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- Côte de popularité pour les groupes (vote possible uniquement pour les Membres inscrits) Le parametre de popularité existe déjà en BDD-->
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->

<div style="border-top: #174156 thick solid; border-radius: 0px 7px 7px 7px; box-shadow: 0 2px 4px 5px #424346; padding: 10px; margin-bottom: 30px; ; width: 40%; float: left;">

<span	style="background-color: #174156; font-weight: bold; color: #fff; border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; padding: 11px; font-family: Arial, Helvetica, sans-serif; font-size: 20px;">&nbsp;Évaluer cet artiste </span> <br /> <br />
<div style="text-align: left;" id="votesGroupe">
	<!-- Script permettant de récupérer les résultats des votes et le nombre de votes en BDD pour calculer la popularité d'un groupe-->

		<?php
	$resultat = Group::getPopulariteGroup ( $_GET ['id_groupe'] );
	// print_r($resultat);
	$nb_resultats = count ( $resultat );
	?>
			
		<?php
	if ($nb_resultats != 0) {
		foreach ( $resultat as $Row ) {
			// parsing des valeurs récupérées
			$Nvotes = $Row ['NbVotes'];
			$ScoreTot = $Row ['ScoreTotal'];
			// ligne de débug a disable quand opérationnel
			// echo "Nombre de votes pour cet artiste: " . $Row ['NbVotes'] . "<br/>";
			// echo "Score total : " . $Row ['ScoreTotal'] . "<br/>";
			
			// récupération de l'adresse URL
			$adresse = $_SERVER ['REQUEST_URI'];
			// echo '' .$adresse."<br />";
			
			// calcul de la popularite actuelle du groupe
			if ($Nvotes != 0) {
				$temp = $ScoreTot / $Nvotes;
				$popGrp = ceil ( $temp * 2 ) / 2;
			} else
				$popGrp = 0;
			if ($popGrp != 0) {
				echo "Popularité actuelle de l'artiste: " .  "<br/>";
				
				for($note = 1; $note <= 5; $note += 0.5) {
					if ($popGrp == $note) {
						$chemin="./../pictures/".$note."tr100px.png";
						echo "<img style='float:right; margin-right:30%;' alt='.$note.' src='$chemin'/> <br/>";
					}
				}
			} else
				echo "L'artiste n'a pas encore été noté. Soyez le premier !<br/>";
				// function alreadyVoted ($idGroupe)

			 //CHECK IF USER CONNECTE
			 if(isset($_SESSION['user'])){
			
			$alreadyVoted = Group::alreadyVoted ( $id_groupe );
			// print_r ( $alreadyVoted );
			// echo "<br/>";
			$nb_alreadyVoted = count ( $alreadyVoted );
			echo "Cet artiste a été évalué " . $nb_alreadyVoted . " fois.<br/><br/>";
			
			if ($nb_alreadyVoted != 0) {
				$compteur = 0;
				// affichage de tous les membres ayant déjà voté
				foreach ( $alreadyVoted as $Row2 ) :
					// parsing des valeurs récupérées
					$LoginInDB = $Row2 ['LoginMembre'];
					
					if ($LoginInDB != $user->login) {
						// ligne de débug a disable quand opérationnel
						// echo "" . $LoginInDB . " a déjà voté pour cet artiste<br/>";
						$compteur += 1;
					} 

					else {
						echo "Vous avez déjà voté pour cet artiste<br/>";
					}
				endforeach
				;
				// echo "le compteur est à : " . $compteur . "<br/>";
				if ($compteur != $nb_alreadyVoted) {
					echo "<b>Vous ne pouvez pas re-voter pour cet artiste!</b>";
				} else {
					//echo "Vous pouvez voter<br/>";
					
					echo "Si vous souhaitez évaluer cet artiste, cliquez sur une note ci-dessous";
					
					?>
			<form action="../Controller/vote.php" method="post">
			<?php echo"<input type='text' name='adresseURL' value=$adresse hidden >"?>
			<?php echo"<input type='text' name='NombreVotes' value=$Nvotes hidden >"?>
			<?php echo"<input type='text' name='ScoreTotal' value=$ScoreTot hidden >"?>
			<?php echo"<input type='text' name='iDGroup' value=$id_groupe hidden >"?>
			<input type="image" name="btnVote" value="1" class="submitbtn"
			id="submit1"> <input type="image" name="btnVote" value="2"
			class="submitbtn" id="submit2"> <input type="image" name="btnVote"
			value="3" class="submitbtn" id="submit3"> <input type="image"
			name="btnVote" value="4" class="submitbtn" id="submit4"> <input
			type="image" name="btnVote" value="5" class="submitbtn" id="submit5">
	</form><?php
				}
			} else {
				//echo "Vous pouvez voter<br />";
				echo "Si vous souhaitez évaluer cet artiste,
	cliquez sur une note ci-dessous";
				?>
	<form action="../Controller/vote.php" method="post">
			<?php echo"<input type='text' name='adresseURL' value=$adresse hidden >"?>
			<?php echo"<input type='text' name='NombreVotes' value=$Nvotes hidden >"?>
			<?php echo"<input type='text' name='ScoreTotal' value=$ScoreTot hidden >"?>
			<?php echo"<input type='text' name='iDGroup' value=$id_groupe hidden >"?>
			<input type="image" name="btnVote" value="1" class="submitbtn"
			id="submit1"> <input type="image" name="btnVote" value="2"
			class="submitbtn" id="submit2"> <input type="image" name="btnVote"
			value="3" class="submitbtn" id="submit3"> <input type="image"
			name="btnVote" value="4" class="submitbtn" id="submit4"> <input
			type="image" name="btnVote" value="5" class="submitbtn" id="submit5">
	</form>

	

	<?php } ?>		
</div>

<?php
	}//SI USER NON CONNECTE
	else{
?>

<p>Pour pouvoir évaluer cet artiste, veuillez vous connecter à l'aide du menu déroulant <b>connexion</b> situé <a href="#hautpage">en haut à droite</a> du site ! :)</p>
<?php
}
	
	
	
	
	}?>
	

<?php
}
?>
</div>

<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->