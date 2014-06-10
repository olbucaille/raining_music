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
if(isset($liste_song[0]->nom)){
	echo 'ok';
}
else echo 'nok';

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
    <div class="Author">
    
    </div> 
    <div class="List"> 
    <?php $link = "document.location.href=\"UploadMusic.php?groupename=".$liste[0]->nom."\" ";?>
	<input TYPE="button" VALUE="Ajouter une chanson" OnClick='<?php echo $link;?>'";'>

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
    $groupe = null ;
    $autorise = false;

    if(isset($_GET['id_groupe']) && isset($_SESSION['user']))
    {
      $id_groupe = $_GET["id_groupe"];
      $user = unserialize($_SESSION['user']);
      $liste = Group::getgroupById($id_groupe);
      if(count($liste)>0)
      {
          $groupe = $liste[0];        
          // verifier que le membre a le droit de visulaiser
          $autorise = Group::verifyMemberValidate($user->login,$groupe->nom);
      }

      /* debut de la partie autorisée */
      if($groupe != null)
      {
            echo '<center><font size = 18>'.$groupe->nom.'</font></center>';

             $name=$_GET['id_groupe']."_groupe.JPG";

          	if (file_exists('./upload_pictures/'.$name))
          	{
          	 echo"<img src='img/photos/$name' width='90' height='90' border='2'/>";
          	}
          	else 
          	 echo"<img src='img/no_photo.png' width='90' height='90' border='2'/>";
          	
          echo"<img src='./upload_pictures/$name' alt=' ' border=':#0b8dca thick solid' height='200' width='250' style='position:relative;top:5px; margin-right:10px ; margin-bottom: 15px;'  />";
          
          echo '</p>';
          // changer la photo du groupe si on est autorisé
          if($autorise)
          {
            echo  
            '<form action="imageUpload.php" method="post" enctype="multipart/form-data"  target="hiddeniframe" >
              <input type="hidden" name="id_groupe" value="'.$_GET['id_groupe'].'"> 
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
                  if(null != $groupe )
                      echo $groupe->description;
                  // modifier la description si on est autorisé
                  if($autorise)
                    {
                      // mettre un bouton pour modifier la description
                      echo '<button type="button" onclick="afficherFormulaire();">Modifier la description</button> ';
                      echo 
                        '<form style="visibility:hidden;" id="formModification" action="modifierDescriptionGroupe.php" method="post"  >
                          <input  type="hidden" name="nom_groupe" value="'.$groupe->nom.'" />
                          <input  type="text" name="description_groupe" value="'.$groupe->description.'" />
                          <input type="submit" name="ajouter concert" value="Modifier" />
                        </form>';
                    }
                    
                    

                  echo 
                  '
                  </font>
                  <br />
                  <br />
                  <br />
                  <font color="blue"><font size = 6> Dates de concert</font></font>
                  <br />
      
          ';
          // ajouter un concert si on est autorisé
          if($autorise)
          {
          echo 
            '<form action="formconcert.php" method="post"  >
              <input type="submit" name="ajouter concert" value="ajouter concert" />
            </form>';
          }
       }

     }
 ?>
</div>
<div>
<!-- Côte de popularité pour les groupes (vote possible uniquement pour les Membres inscrits) Le parametre de popularité existe déjà en BDD-->

<?php if(isset($_SESSION['user'])){?>
<div style="text-align:center;" id="votesGroupe">
</div>

<?php }?>

</div>
   		
	<?php 
	include("./../layout/basic_footer.php");
	?>
        