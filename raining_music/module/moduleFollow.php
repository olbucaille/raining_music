<!-- MODULE DE VOTE A IMPLEMENTER DANS LES PAGES DE GROUPES -->
<!-- Ce module peut �tre modifier pour �tre �tendu aux salles et concerts -->


<?php
?>


<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- C�te de popularit� pour les groupes (vote possible uniquement pour les Membres inscrits) Le parametre de popularit� existe d�j� en BDD-->
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->


<div style="text-align: left;" id="votesGroupe">
	<!-- Script permettant de r�cup�rer les r�sultats des votes et le nombre de votes en BDD pour calculer la popularit� d'un groupe-->

		<?php
	$resultat = Group::getPopulariteGroup ( $_GET ['id_groupe'] );
	// print_r($resultat);
	$nb_resultats = count ( $resultat );
	?>
			
		<?php
	if ($nb_resultats != 0) {
		foreach ( $resultat as $Row ) {
			// parsing des valeurs r�cup�r�es
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

<p>Pour suivre cet artiste, veuillez vous connecter � l'aide du menu d�roulant <b>connexion</b> situ� <a href="#hautpage">en haut � droite</a> du site ! :)</p>
<?php
}
	
	
	
	
	}?>
	

<?php
}
?>


<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->