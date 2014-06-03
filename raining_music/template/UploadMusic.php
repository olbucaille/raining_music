<?php 
include("./../layout/basic_header.php");
?>
<h1 align ="center"><b>Ajouter une chanson</b></h1>
<form enctype="multipart/form-data" action="../index.php?action='upload_music'" method="POST">
<label for="nom">Titre de chanson:</label><input type="text" id="nom" /><br />
<label for="groupe">Groupe: </label><input type="text" id="groupe" /><br />

<p><b>Choisir une chanson :</b>

<input type="hidden" name="posted" value="1">
<input name="fichier" type="file">
<input type="submit" value="Ajouter">

</p>
</form>

