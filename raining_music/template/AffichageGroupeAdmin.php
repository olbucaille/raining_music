<?php 
include("./../layout/basic_header.php");
include("./../db_connect.inc.php");
include("./../model/group.php");
include("./../model/song.php");
if(isset($_GET['id_groupe'])){
$liste= array();
$liste = Group::getgroupname($_GET['id_groupe']);}

$liste_song= array();
$liste_song = Song::getSongName($liste[0]->nom);
?>
<script src="./../js/Music_box.js"></script>
<!-- debut de la page en elle meme-->
</header>
<div class="conteneur" style="margin-left:5%; width:90%; min-height:500px; height:100%; background-color:#c0c0c0; ">
	<p> 
<center><font size = 18> <?php echo $liste[0]->nom; ?> </font></center>

<!-- boite de musique-->

<audio id="myMusic" > </audio> 

<input id="PauseTime"  type="hidden" />


    <div class="MusicBox" >

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
    ?>
	<input TYPE="button" VALUE="Ajouter une chanson" OnClick='<?php echo $link;?>'";'>
	<input TYPE="button" VALUE="Supprimer une chanson" OnClick='<?php echo $link_sup;?>'";'>

	
	</br>
	</br>
<?php 
    $i=0;
    while (isset($liste_song[$i]->nom)){
	?>
	<div class="Single" >
	<span class="SongName" KV="<?php echo $liste_song[$i]->nom; ?>" > <?php echo $liste_song[$i]->nom; ?></span>
	</div>
   <?php  
  	$i++;
 	 }
 	 ?> 	
    </div>
    </div>
    	</br>
    		</br>
    			</br>
<?php


if(isset($_GET['id_groupe']))
{
  $name=$_GET['id_groupe']."_groupe.JPG";

	if (file_exists('./upload_pictures/'.$name))
	{
	 echo"<img src='img/photos/$name' width='90' height='90' border='2'/>";
	}
	else 
	{ echo"<img src='img/no_photo.png' width='90' height='90' border='2'/>";
	}
	
	}
echo"<img src='./upload_pictures/$name' alt='DP' border=':#0b8dca thick solid' height='200' width='250' style='position:relative;top:5px; margin-right:10px ; margin-bottom: 15px;'  />";
?>
</p>


<!-- tÃ©lÃ©charger une nouvelle photo pour le groupe -->

<form action="imageUpload.php" method="post" enctype="multipart/form-data"  target="hiddeniframe" >

   <input type="hidden" name="id_groupe" value="<?php echo $_GET['id_groupe']; ?>"> 
    <input type="file" name="imgfile" /> 
    <input type='submit' name="uploadButton" value="Changer la photo" />
	
</form>

    <div class="left" style="  padding-left:10px;">
    	
    	<p>
    	<img src="./../pictures/playlist1.jpeg" alt=" " border=":#0b8dca thick solid" height="50" width="200" style="position:relative;top:15px; margin-right:5px ; margin-bottom:15px;"  /></p>
   		<font size = 5><font color="black">Give life back to music</font></font> <audio src = "Give life back to music.mp3" controls width=10></audio>
   		<br />
   	
   		<font size = 5><font color="black">Instant Crush</font></font> <audio src ="instant crush.mp3" controls width=10></audio>
    	</div>
        <div class="right>
        <p>
        /div>
        <br />
        <br />
        <br />
        <br />
        <font color = "black">Daft Punk est un groupe français de musique électronique, originaire du premier arrondissement de Paris. Actifs depuis 1993, Thomas Bangalter et Guy-Manuel de Homem-Christo, les deux membres, ont allié à leurs sons electro, house et techno des tonalités rock, groove et disco, baptisé French Touch</font>
        <br />
        <br />
        <br />
        <font color="blue"><font size = 6> Dates de concert</font></font>
        <br />
   		<br />
   		<br />
   		<font size =5><font color="black">Mai 2014</font></font>
   		<br />
  		<font size = 5><font color="black"><a href ="PageEvent.php">6 et 7 Mai à Paris-Bercy</a></font></font>
   		<br />
   		<font size = 5><font color="black"><a href ="PageEvent.php">15 et 16 Mai au Bataclan</a></font></font>
<form action="formconcert.html" method="post"  >

    
    <input type='submit' name="ajouter concert" value="ajouter concert" />
	
</form>

   		
	<?php 
	include("./../layout/basic_footer.php");
	?>
        