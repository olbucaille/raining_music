<?php 
include("./../layout/basic_header.php");
include("./../db_connect.inc.php");
include("./../model/song.php");
$liste_song= array();
$liste_song = Song::getSongName($_GET['groupename']);
?>
<h1 align ="center"><b>Supprimer une chanson</b></h1> <br />
<form enctype="multipart/form-data" action="../index.php?action='delete_music'" method="POST">
<label for="groupe">Groupe: </label><span><?php echo $_GET['groupename']?></span>
<input type="hidden" id="groupe" name="groupe" value="<?php echo $_GET['groupename']?>"/><br />


<label> Supprimer une chanson :</label>


<select name="chansons">
<?php 
    $i=0;
    
    while (isset($liste_song[$i]->nom)){
	?>

<option value=<?php echo $liste_song[$i]->nom; ?>> <?php echo $liste_song[$i]->nom; ?> </option>


   <?php  
  	$i++;
 	 }
 	 ?> 
</select>	
<br/>
<input type="hidden" name="posted" value="1">
<input type="submit" value="Supprimer">
<input TYPE="button" VALUE="Retour" OnClick='document.location.href="Redirection.php";'>
</form>

