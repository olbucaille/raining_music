<?php
include ("./../layout/basic_header.php");
include ("./../db_connect.inc.php");
include ("./../model/group.php");
include ("./../model/song.php");
if (isset ( $_GET ['id_groupe'] )) {
	$liste = array ();
	$liste = Group::getgroupname ( $_GET ['id_groupe'] );
}

$liste_song = array ();
$liste_song = Song::getSongName ( $liste [0]->nom );
if (isset ( $liste_song [0]->nom )) {
	echo 'ok';
} else
	echo 'nok';

?>
<script src="./../js/Music_box.js"></script>
<!-- debut de la page en elle meme-->

<script type="text/javascript">
   afficherFormulaire = function () {
    var form = document.getElementById("formModification");
    var etat=form.style.visibility; 
    if(etat=="hidden")
        form.style.visibility="visible";
    else
        form.style.visibility="hidden";
  };


</script>
</header>
<div class="conteneur"
	style="margin-left: 5%; width: 90%; min-height: 500px; height: 100%; background-color: #c0c0c0;">
	<p>
	
	
	<center>
		<font size=18> <?php echo $liste[0]->nom; ?> </font>
	</center>

	<!-- boite de musique-->

	<audio id="myMusic">
	</audio>

	<input id="PauseTime" type="hidden" />


	<div class="MusicBox">

		<div class="LeftControl"></div>
		<!-- icone morceau precedent -->
		<div id="MainControl" class="MainControl"></div>
		<!-- icone jouer et arreter -->
		<div class="RightControl"></div>
		<!-- icone morceau suivant -->

		<div class="ProcessControl">
			<!-- barre d'avancement -->
			<div class="SongName">Music Box!</div>
			<!-- titre du morceau-->
			<div class="SongTime">00:00&nbsp;|&nbsp;00:00</div>
			<!-- duration -->
			<div class="Process"></div>
			<!-- barre de duree du morceau -->
			<div class="ProcessYet"></div>
			<!-- temps jou¨¦-->
		</div>

		<div class="VoiceEmp"></div>
		<!-- icone muet -->
		<div class="VoidProcess"></div>
		<!-- barre de son -->
		<div class="VoidProcessYet"></div>
		<!-- son choisi -->
		<div class="VoiceFull"></div>
		<!-- son max -->
		<div class="ShowMusicList"></div>
		<!-- montrer ou masquer la liste de musique -->
	</div>


	<div class="MusicList">
		<div class="Author"></div>
		<div class="List"> 
    <?php $link = "document.location.href=\"UploadMusic.php?groupename=".$liste[0]->nom."\" ";?>
	<input TYPE="button" VALUE="Ajouter une chanson"
				OnClick='<?php echo $link;?>'";'> </br> </br>
<?php
$i = 0;
while ( isset ( $liste_song [$i]->nom ) ) {
	?>
	<div class="Single">
				<span class="SongName" KV="<?php echo $liste_song[$i]->nom; ?>"> <?php echo $liste_song[$i]->nom; ?></span>
			</div>
   <?php
	$i ++;
}
?> 	
    </div>
	</div>
	</br> </br> </br>

<?php
$groupe = null;
$autorise = false;

if (isset ( $_GET ['id_groupe'] ) && isset ( $_SESSION ['user'] )) {
	$id_groupe = $_GET ["id_groupe"];
	$user = unserialize ( $_SESSION ['user'] );
	$liste = Group::getgroupById ( $id_groupe );
	if (count ( $liste ) > 0) {
		$groupe = $liste [0];
		// verifier que le membre a le droit de visulaiser
		$autorise = Group::verifyMemberValidate ( $user->login, $groupe->nom );
	}
	
	/* debut de la partie autorisée */
	if ($groupe != null) {
		echo '<center><font size = 18>' . $groupe->nom . '</font></center>';
		
		$name = $_GET ['id_groupe'] . "_groupe.JPG";
		
		if (file_exists ( './upload_pictures/' . $name )) {
			echo "<img src='img/photos/$name' width='90' height='90' border='2'/>";
		} else
			echo "<img src='img/no_photo.png' width='90' height='90' border='2'/>";
		
		echo "<img src='./upload_pictures/$name' alt=' ' border=':#0b8dca thick solid' height='200' width='250' style='position:relative;top:5px; margin-right:10px ; margin-bottom: 15px;'  />";
		
		echo '</p>';
		// changer la photo du groupe si on est autorisé
		if ($autorise) {
			echo '<form action="imageUpload.php" method="post" enctype="multipart/form-data"  target="hiddeniframe" >
              <input type="hidden" name="id_groupe" value="' . $_GET ['id_groupe'] . '"> 
              <input type="file" name="imgfile" /> 
              <input type="submit" name="uploadButton" value="Changer la photo" />
            </form>';
		}
		echo '
              <div class="left" style="padding-left:10px;"/>
              	<p>
              	<img src="./../pictures/playlist1.jpeg" alt=" " border=":#0b8dca thick solid" height="50" width="200" style="position:relative;top:15px; margin-right:5px ; margin-bottom:15px;"  /></p>
            
              	</div>
                  <div class="right">
                  <p>
                  </div>
                  <br />
                  <br />
                  <br />
                  <br />
                  <font color = "black">';
		if (null != $groupe)
			echo $groupe->description;
			// modifier la description si on est autorisé
		if ($autorise) {
			// mettre un bouton pour modifier la description
			echo '<button type="button" onclick="afficherFormulaire();">Modifier la description</button> ';
			echo '<form style="visibility:hidden;" id="formModification" action="modifierDescriptionGroupe.php" method="post"  >
                          <input  type="hidden" name="nom_groupe" value="' . $groupe->nom . '" />
                          <input  type="text" name="description_groupe" value="' . $groupe->description . '" />
                          <input type="submit" name="ajouter concert" value="Modifier" />
                        </form>';
		}
		
		echo '
                  </font>
                  <br />
                  <br />
                  <br />
                  <font color="blue"><font size = 6> Dates de concert</font></font>
                  <br />
      
          ';
		// ajouter un concert si on est autorisé
		if ($autorise) {
			echo '<form action="formconcert.php" method="post"  >
              <input type="submit" name="ajouter concert" value="ajouter concert" />
            </form>';
		}
	}
}
?>
</div>




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
				echo "La popularité actuelle de l'artiste est " . $popGrp . "<br/>";
				
				for($note = 1; $note <= 5; $note += 0.5) {
					if ($popGrp == $note) {
						$chemin="./../pictures/".$note."tr100px.png";
						echo "<img alt='.$note.' src='$chemin'/> <br/>";
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
			echo "Nombre de votes pour cet artiste: " . $nb_alreadyVoted . "<br/><br/>";
			
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
						echo "<b>Vous</b> avez déjà voté pour cet artiste<br/>";
					}
				endforeach
				;
				// echo "le compteur est à : " . $compteur . "<br/>";
				if ($compteur != $nb_alreadyVoted) {
					echo "<b>ERREUR : Vous ne pouvez pas re-voter pour cet artiste!</b>";
				} else {
					echo "Vous pouvez voter<br/>";
					
					echo "Si vous souhaitez voter, cliquez sur une note ci-dessous";
					
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
				echo "Vous pouvez voter<br />";
				echo "Si vous souhaitez voter,
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

<p>Pour pouvoir noter cet artiste, veuillez vous connecter à l'aide du menu déroulant <b>connexion</b> situé <a href="#hautpage">en haut à droite</a> du site ! :)</p>
<?php
}
	
	
	
	
	}?>
	

<?php
}
?>


<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->


<?php
include ("./../layout/basic_footer.php");
?>
        