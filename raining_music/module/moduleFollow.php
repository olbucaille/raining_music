<!-- MODULE DE VOTE A IMPLEMENTER DANS LES PAGES DE GROUPES -->
<!-- Ce module peut être modifier pour être étendu aux salles et concerts -->


<?php
?>


<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- Côte de popularité pour les groupes (vote possible uniquement pour les Membres inscrits) Le parametre de popularité existe déjà en BDD-->
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->


<div style="text-align: right;" id="votesGroupe">
	<!-- Script permettant de récupérer les résultats des votes et le nombre de votes en BDD pour calculer la popularité d'un groupe-->

		<?php
		
		// CHECK IF USER CONNECTE
		if (isset ( $_SESSION ['user'] )) {
			
			$resultUserId = User::getUserId ( $user->login );
			foreach ( $resultUserId as $Row ) {
				$userId = $Row ['Id'];
			}
			//DEBUG
			//print_r ( $userId );
			$resultat = Group::getAllFollowers ( $_GET ["id_groupe"] );
			//DEBUG
			//print_r ( $resultat );
			
			if (empty ( $resultat )) {
$tempIdGrp=$_GET ["id_groupe"];
				echo "<a href=\"./../index.php?action='follow'&amp;idmembre=".$userId."&amp;idgroupe=".$tempIdGrp."&amp;todo=follow\"
style=\"background-color: #379BC6; width: 150px; height: 150px; color: white; margin-top: 50px; padding: 4px; border-radius: 5px;\">&nbspSuivre cet artiste&nbsp</a> ";
	


				} else {
				
				$nb_resultats = count ( $resultat );
				
				$counter = 0;
				?>
		<?php
				if ($nb_resultats != 0) {
					foreach ( $resultat as $Row ) {
						// parsing des valeurs récupérées
						$idMembre = $Row ['Id_membre'];
						//DEBUG
						//print_r ( $idMembre );
						//print_r ( $userId );
						if ($userId != $idMembre) {
							$counter = $counter + 1;
						}
					}
					if ($counter != $nb_resultats) {
						$tempIdGrp=$_GET["id_groupe"];
			  echo "<a href=\"./../index.php?action='follow'&amp;idmembre=".$userId."&amp;idgroupe=".$tempIdGrp."&amp;todo=stopfollow\"
			  style=\"background-color: #379BC6; width: 150px; height: 150px; color: white; margin-top: 50px; padding: 4px; border-radius: 5px;\">&nbspNe plus suivre cet artiste&nbsp</a> ";
				
					} else {
						?>		
			<?php  //affichage du bouton pour follow l'artiste ?>
			 
			 <?php $tempIdGrp=$_GET["id_groupe"];
			  echo "<a href=\"./../index.php?action='follow'&amp;idmembre=".$userId."&amp;idgroupe=".$tempIdGrp."&amp;todo=follow\"
			  style=\"background-color: #379BC6; width: 150px; height: 150px; color: white; margin-top: 50px; padding: 4px; border-radius: 5px;\">&nbspSuivre cet artiste&nbsp</a> ";
			 ?>
			 

<?php
					}
				}
			}
			?>
<?php
		} else { // SI USER NON CONNECTE
			?>

<p>
		Pour suivre cet artiste, veuillez vous connecter à l'aide du menu
		déroulant <b>connexion</b> situé <a href="#hautpage">en haut à droite</a>
		du site ! :)
	</p>

	

<?php
		}
		?>

</div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->