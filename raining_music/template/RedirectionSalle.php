<?php 
include("./../layout/basic_header.php");
include("./../db_connect.inc.php");
?>

<!--Allez vers la liste des salles suivant le nom!-->
<!-- envoyer la lettre comme parametre en URL  -->

 <a href="RedirectionSalle.php?lettre=a"> A </a>
 <a href="RedirectionSalle.php?lettre=b"> B </a> 
 <a href="RedirectionSalle.php?lettre=c"> C </a> 
 <a href="RedirectionSalle.php?lettre=d"> D </a> 
 <a href="RedirectionSalle.php?lettre=e"> E </a> 
 <a href="RedirectionSalle.php?lettre=f"> F </a> 
 <a href="RedirectionSalle.php?lettre=g"> G </a> 
 <a href="RedirectionSalle.php?lettre=h"> H </a> 
 <a href="RedirectionSalle.php?lettre=i"> I </a> 
 <a href="RedirectionSalle.php?lettre=j"> J </a> 
 <a href="RedirectionSalle.php?lettre=k"> K </a> 
 <a href="RedirectionSalle.php?lettre=l"> L </a> 
 <a href="RedirectionSalle.php?lettre=m"> M </a> 
 <a href="RedirectionSalle.php?lettre=n"> N </a> 
 <a href="RedirectionSalle.php?lettre=o"> O </a> 
 <a href="RedirectionSalle.php?lettre=p"> P </a> 
 <a href="RedirectionSalle.php?lettre=q"> Q </a> 
 <a href="RedirectionSalle.php?lettre=r"> R </a> 
 <a href="RedirectionSalle.php?lettre=s"> S </a> 
 <a href="RedirectionSalle.php?lettre=t"> T </a> 
 <a href="RedirectionSalle.php?lettre=u"> U </a> 
 <a href="RedirectionSalle.php?lettre=v"> V </a> 
 <a href="RedirectionSalle.php?lettre=w"> W </a> 
 <a href="RedirectionSalle.php?lettre=x"> X </a> 
 <a href="RedirectionSalle.php?lettre=y"> Y </a> 
 <a href="RedirectionSalle.php?lettre=z"> Z </a> 
 <a href="#.html"> # </a> 


<br />
<br />
<!-- Rechercher une salle -->
		
		<div class="search">		
				<form  class="search" method="post" action="RedirectionSalle.php">
			
				<input class="search_data" name="saisie" type="search" placeholder="Le nom de la salle" required />
				<input class="btn-right-loupe" name="go" type="submit" />
				</form></div>
				
<!-- Affichage des Salles en D -->
<br />
<br />

	<?php
	$requete_faite = 0; 
	/* se connecter à la base de données */
	

    mysql_connect("localhost","root","");
	mysql_select_db("bd_raining_music");
	
	/*  */
	if (isset($_POST["saisie"]) && !empty($_POST["saisie"])) {  
		$saisie=$_POST["saisie"];
	}else{  
	$saisie=null;
	}
	
		if($saisie==null && isset($_GET['lettre']))
		{
		/* récuperer toutes les salles dont la premiere lettre commence par la lettre selectionnée */
			
			$sql = 'SELECT * FROM salle WHERE LEFT(Nom,1) = "'.$_GET['lettre'].'"';
			$req = mysql_query($sql);
			$requete_faite= 1;
		}
		else if($saisie!=null) {
		/* récuperer toutes les salles dont le nom contient le texte saisi */
		$sql = "SELECT * FROM salle WHERE Nom LIKE CONCAT('%','".$saisie."','%')";
		$req = mysql_query($sql);
		$requete_faite = 1;
		}
		
		if($requete_faite)
		{
			echo"<div class='Liste-salles' >
			<ul>";
			while($ligne = mysql_fetch_assoc($req)) {
			echo"<li><a href='Salle.php?Nom=".$ligne['Nom']."'>";echo $ligne['Nom'].'<br />' ; echo"</a></li>";
			}
		}
		mysql_close();
	
	echo"</ul>   
	</div>";
	

	include("./../layout/basic_footer.php");
	?>