<?php 
include("./../layout/basic_header.php");

?>
<h1 align ="center"><b>Ajouter une chanson</b></h1> <br />
<form enctype="multipart/form-data" action="../index.php?action='upload_music'&id_groupe=<?php echo $_GET ['id_groupe']?>" method="POST">
<label for="groupe">Groupe: </label><span><?php echo $_GET['groupename']?></span>
<input type="hidden" id="groupe" name="groupe" value="<?php echo $_GET['groupename']?>"/><br />
<label for="album">Album: </label><input type="text" id="album" name="album"/><br />

<label> Choisir une chanson :</label>
<input type="hidden" name="posted" value="1">
<input name="fichier" type="file"> <br />
<input type="submit" value="Ajouter">
<input TYPE="button" VALUE="Retour" OnClick='document.location.href="AffichageGroupeAdmin.php?id_groupe=<?php echo $_GET ['id_groupe']?>";'>
</form>

