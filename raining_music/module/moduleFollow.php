<!-- MODULE DE VOTE A IMPLEMENTER DANS LES PAGES DE GROUPES -->
<!-- Ce module peut être modifier pour être étendu aux salles et concerts -->


<?php
?>


<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- Côte de popularité pour les groupes (vote possible uniquement pour les Membres inscrits) Le parametre de popularité existe déjà en BDD-->
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->


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


			 //CHECK IF USER CONNECTE
			 if(isset($_SESSION['user'])){
			 ?>		
			 <a href="#" style="background-color: #379BC6; width: 150px; height: 150px; color: white;margin-top:50px; padding:4px;border-radius: 5px; ">&nbsp;Suivre cet artiste&nbsp;</a>
</div>

<?php
	}//SI USER NON CONNECTE
	else{
?>

<p>Pour suivre cet artiste, veuillez vous connecter à l'aide du menu déroulant <b>connexion</b> situé <a href="#hautpage">en haut à droite</a> du site ! :)</p>
<?php
}
	
	
	
	
	}?>
	

<?php
}
?>


<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->