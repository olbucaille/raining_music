<?php
include("./../layout/basic_header.php");
include("./../db_connect.inc.php");
include("./../model/salle2.php");
include("./../model/requestSQL.php");
$listeSalles = Salle::getsalle();
$concerts = RequestSQL::getAllConcerts();
   ?>
   
   

 <div class="left" style="min-height: 400px;" padding-left:10px; " >
  <div style="text-align:justify; border-top:#236586 thick solid; border-radius: 0px 7px 7px 7px;	box-shadow: 0 2px 4px 5px #424346;  padding:10px; margin:10px;">
 
 
   
   <?php echo '
<form  style="margin-left : 2%;" method="post" action="traitement.php">
	<p class="search">Ajout d\'un concert</p>
	<fieldset id="coordonnees"> 
	<label>Nom : </label>
	<input type="text" name="nom"/><br />
	<label>Date  : </label>
	<input placeholder="YYYY-MM-DD" type="date" name="date" /><br />
	<label>Heure  : </label>
	<input type="heure" name="heure" /><br />
	<input type="hidden" name="id" value="'.$concerts.'" />
	<label>Salle  : </label><br/>
	';	
	echo'<select name="salle">';
	
	for($i=0;$i<count($listeSalles);$i++)
	{
		echo '<option value="'.$listeSalles[$i]->Nom.'" >'.$listeSalles[$i]->Nom.'</option>';
	}
	echo 
	'</select>
	</fieldset>
	<p class="search">description</p>
	<fieldset id="description">
	<textarea name="description" rows="5" cols="40"></textarea>
	</fieldset>
	<p id="bouton">
	<input type="submit" value="Ajouter" /> 
	</p>
</form> ';

	?>
</div>
	</div>
	<?php 
	include("./../layout/basic_footer.php");
?>