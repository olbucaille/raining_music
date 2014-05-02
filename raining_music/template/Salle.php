<?php 
include("./../layout/basic_header.php");
?>


<div class="conteneur" style="margin-left:5%; width:90%; min-height:500px; height:100%; background-color:#c0c0c0; ">
	

   
<p> 
<center><font size = 18> Le Falstaff </font></center>
        <li><font size =5><font color = "black"> Adresse :</font></font>
        <font size =5><font color = "black">42 rue du Montparnasse, 75014 Paris</font></font>
        <br />
        <li><font size =5><font color = "black">Téléphone : 01 43 35 38 29</font></font>
        <br />
        <li><font size = 5><font color = "black"> Horaires : 8h30 - 5h00</font></font>
<br /><img src="./../pictures/Falstaff.jpg" alt="Le Falstaff" border=":#0b8dca thick solid" height="200" width="300" style="position:relative;top:5px; margin-right:10px ; margin-bottom: 15px;"  /></p>
<img src="./../pictures/falstaff2.jpg" alt="Le Falstaff" border=":#0b8dca thick solid" height="200" width="300" style="position:relative;top:5px; margin-right:10px ; margin-bottom: 15px;"  /></p>
<font size = 5><font color= "black"> Concerts à venir dans cette salle :</font></font>
<br />
<li><font size = 5><font color= "black"> 5 mai à 21h : Metallica</font></font>
<br />
<li><font size = 5><font color= "black"> 18 mai à 21h : ACDC</font></font>
<br />
<br />
<br />
<br />

<?
if(isset($_POST['requete']) && $_POST['requete'] != NULL) // on vérifie d'abord l'existence du POST et aussi si la requete n'est pas vide.
{
mysql_connect('localhost','root','');
mysql_select_db('bd_raining_music'); // on se connecte à MySQL.
$requete = htmlspecialchars($_POST['requete']); // on crée une variable $requete pour faciliter l'écriture de la requête SQL
$query = mysql_query("SELECT * FROM concert WHERE id LIKE '%$requete%' ORDER BY id DESC") or die (mysql_error()); 
$nb_resultats = mysql_num_rows($query); // on utilise la fonction mysql_num_rows pour compter les résultats pour vérifier après
if($nb_resultats != 0) // si le nombre de résultats est supérieur à 0, on continue
{
// maintenant, on va afficher les résultats et la page qui les donne ainsi que leur nombre
?>
<h3>Résultats de votre recherche.</h3>
<p>Nous avons trouvé <? echo $nb_resultats; // on affiche le nombre de résultats 
if($nb_resultats > 1) { echo 'résultats'; } else { echo 'résultat'; } // on vérifie le nombre de résultats pour orthographier correctement. 
?>
dans notre base de données. Voici les fonctions que nous avons trouvées :<br/>
<br/>
<?
while($donnees = mysql_fetch_array($query)) // on fait un while pour afficher la liste des fonctions trouvées, ainsi que l'id qui permettra de faire le lien vers la page de la fonction
{
?>
<a href="fonction.php?id=<? echo $donnees['id']; ?>"><? echo $donnees['nom_fonction']; ?></a><br/>
<?
} // fin de la boucle
?><br/>
<br/>
<a href="rechercher.php">Faire une nouvelle recherche</a></p>
<?
} 
else
{ 
?>
<h3>Pas de résultats</h3>
<p>Nous n'avons trouvé aucun résultat pour votre requête "<? echo $_POST['requete']; ?>". <a href="rechercher.php">Réessayez</a> avec autre chose.</p>
<?
}
mysql_close();
}
else
{ 
?>
<p>Vous allez faire une recherche dans notre base de données concernant les fonctions PHP. Tapez une requête pour réaliser une recherche.</p>
<form action="rechercher.php" method="Post">
<input type="text" name="requete" size="10">
<input type="submit" value="Ok">
</form>
<?
}

?>
    </li>
    </div>
        
       <?php 
include("./../layout/basic_footer.php");
	?>
        