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
  }

</script>
<div class="main">
	<div class="conteneur" style="margin-left:5%; width:90%; min-width:800px; height:100%; background-color:#c8c8c8; ">

	


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
		echo "<center><font size = 18>" . $groupe->nom . "</font></center>";
		$name = $_GET ['id_groupe'] . "_groupe.JPG";
}
?>

<div class="center">
<font color="blue"><font size = 6> Galerie de photos </font></font>
<br/>

<?php   
   	if (file_exists ( './upload_pictures/' . $name )) {
	echo "<img src='./upload_pictures/$name' alt=' ' border=':#0b8dca thick solid' height='200' width='250' style='position:relative;top:5px; margin-right:10px ; margin-bottom: 15px;'  />";
			// changer la photo du groupe si on est autorisé
			}
?>
<?php if ($autorise) {
?>
	<form action="imageUpload.php" method="post" enctype="multipart/form-data"  target="hiddeniframe" >
		<input type="hidden" name="id_groupe" value=" <?php echo $_GET ['id_groupe']?>">
		<input type="file" name="imgfile" /> 
		<input type="submit" name="uploadButton" value="Changer la photo" />
	</form>
<?php }
?> 
	</div>       
	
	<br/>

	<div
				style="border-top: #174156 thick solid; border-radius: 0px 7px 7px 7px; box-shadow: 0 2px 4px 5px #424346; padding: 10px; margin-bottom: 30px; width:40%; float: left;">

				<span
					style="background-color:#174156; font-weight: bold; color: #fff;
					border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; 
					padding: 11px; font-family: Arial, Helvetica, sans-serif; 
					font-size: 20px;">&nbsp;Notre histoire !
				
				</span>
			<br/>
			<br/>
			<?php 
        if (null != $groupe)
				
			echo $groupe->description;
			// modifier la description si on est autorisé
		
		if ($autorise) {
			// mettre un bouton pour modifier la description
		?>
			<button type="button" onclick="afficherFormulaire();">Modifier la description</button>
			<form style="visibility:hidden;" id="formModification" action="modifierDescriptionGroupe.php" method="post"  >
            	<input  type="hidden" name="nom_groupe" value="<?php echo $groupe->nom?>"/>
          		<input  type="text" name="description_groupe" value="<?php echo $groupe->description ?>" />
            	<input type="submit" name="ajouter concert" value="Modifier" />
            </form>
<?php }?>		

			
			</div>	

<div
				style="border-top: #174156 thick solid; border-radius: 0px 7px 7px 7px; box-shadow: 0 2px 4px 5px #424346; padding: 10px; margin-bottom: 30px; width:40%; float: right;">

				<span
					style="background-color:#174156; font-weight: bold; color: #fff;
					border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; 
					padding: 11px; font-family: Arial, Helvetica, sans-serif; 
					font-size: 20px;">&nbsp;Nos dates de concert !
				
				</span>
			<br/>
			<br/>
			<?php          
      	// ajouter un concert si on est autorisé


		if ($autorise) {
?>
			<form action="formconcert.php?Groupe=<?php echo $groupe->nom ; ?>" method="post"  >
            <input type="submit" name="ajouter concert" value="ajouter concert" />
            </form>
<?php }?>	

            </div>
                  
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />


	<!-- boite de musique-->

	<audio id="myMusic">
	</audio>

	<input id="PauseTime" type="hidden" />


	<div class="MusicBox">
    <div class="LeftControl" ></div> <!-- icone morceau precedent -->
    <div id="MainControl" class="MainControl" ></div> <!-- icone jouer et arreter -->
    <div class="RightControl" ></div> <!-- icone morceau suivant -->
    
    <div class="ProcessControl"><!-- barre d'avancement -->
    <div class="SongName">Music Box!</div> <!-- titre du morceau-->
    <div class="SongTime">00:00&nbsp;|&nbsp;00:00</div> <!-- duration -->
    <div class="Process" ></div> <!-- barre de duree du morceau -->
    <div class="ProcessYet"></div> <!-- temps jou¨¦-->
    </div>
    
    <div class="VoiceEmp"></div> <!-- icone muet -->
    <div class="VoidProcess" ></div><!-- barre de son --> 
    <div class="VoidProcessYet" ></div> <!-- son choisi -->
    <div class="VoiceFull" ></div><!-- son max -->
    <div class="ShowMusicList" ></div> <!-- montrer ou masquer la liste de musique -->
    </div>
    
    
    <div class="MusicList">  
    <div class="Author" >
    <img src="../pictures/musique.jpg" alt="" width="158" height="200"/>
    </div> 
    <div class="List"> 
    <?php $link = "document.location.href=\"UploadMusic.php?groupename=".$liste[0]->nom."\" ";
    	$link_sup = "document.location.href=\"DeleteMusic.php?groupename=".$liste[0]->nom."\" ";
if ($autorise) {
echo'	<input TYPE="button" VALUE="Ajouter une chanson" OnClick="'.$link.'">
	<input TYPE="button" VALUE="Supprimer une chanson" OnClick="'.$link_sup.'">';
		}
?>   
	</br>
	</br>


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


<?php }
else{
	$id_groupe = $_GET ["id_groupe"];	
	$liste = Group::getgroupById ( $id_groupe );
	if (count ( $liste ) > 0) {
		$groupe = $liste [0];
	}

	/* debut de la partie autorisée */
	if ($groupe != null) {
		echo "<p align = center > <font size = 18>" . $groupe->nom . "</font></p>" ;
		echo "<p> Bienvenu sur notre page de groupe ! Pour visualiser notre page, à l'aide du menu déroulant <b>connexion</b> situé en haut à droite du site ! :) </p>" ;
		
}		
}

?>	
</div>


<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- Côte de popularité pour les groupes (vote possible uniquement pour les Membres inscrits) Le parametre de popularité existe déjà en BDD-->
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->

<?php include '../module/moduleVote.php';?>


<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->


<?php
include ("./../layout/basic_footer.php");
?>
        
