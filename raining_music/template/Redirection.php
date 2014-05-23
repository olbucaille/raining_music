<?php 
include("./../layout/basic_header.php");
include("./../db_connect.inc.php");
?>

<!--Allez vers la liste des artistes suivant le nom!-->
<!-- envoyer la lettre comme parametre en URL  -->

<a href="Redirection.php?lettre=a"> A </a>
 <a href="Redirection.php?lettre=b"> B </a> 
 <a href="Redirection.php?lettre=c"> C </a> 
 <a href="Redirection.php?lettre=d"> D </a> 
 <a href="Redirection.php?lettre=e"> E </a> 
 <a href="Redirection.php?lettre=f"> F </a> 
 <a href="Redirection.php?lettre=g"> G </a> 
 <a href="Redirection.php?lettre=h"> H </a> 
 <a href="Redirection.php?lettre=i"> I </a> 
 <a href="Redirection.php?lettre=j"> J </a> 
 <a href="Redirection.php?lettre=k"> K </a> 
 <a href="Redirection.php?lettre=l"> L </a> 
 <a href="Redirection.php?lettre=m"> M </a> 
 <a href="Redirection.php?lettre=n"> N </a> 
 <a href="Redirection.php?lettre=o"> O </a> 
 <a href="Redirection.php?lettre=p"> P </a> 
 <a href="Redirection.php?lettre=q"> Q </a> 
 <a href="Redirection.php?lettre=r"> R </a> 
 <a href="Redirection.php?lettre=s"> S </a> 
 <a href="Redirection.php?lettre=t"> T </a> 
 <a href="Redirection.php?lettre=u"> U </a> 
 <a href="Redirection.php?lettre=v"> V </a> 
 <a href="Redirection.php?lettre=w"> W </a> 
 <a href="Redirection.php?lettre=x"> X </a> 
 <a href="Redirection.php?lettre=y"> Y </a> 
 <a href="Redirection.php?lettre=z"> Z </a> 
 <a href="#.html"> # </a> 


<br />
<br />
<!-- Rechercher un groupe -->
		
		<div class="search">		
				<form  class="search" method="post" action="Redirection.php">
			
				<input class="search_data" name="saisie" type="search" placeholder="Le nom du groupe" required />
				<input class="btn-right-loupe" name="go" type="submit" />
				</form></div>
				
<!-- Affichage des Groupes en D -->
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
		/* récuperer tous les groupes dont la premiere lettre commence par la lettre selectionnée */
			
			$sql = 'SELECT * FROM groupe WHERE LEFT(Nom,1) = "'.$_GET['lettre'].'"';
			$req = mysql_query($sql);
			$requete_faite= 1;
		}
		else if($saisie!=null) {
		/* récuperer tous les groupes dont le nom contient le texte saisi */
		$sql = "SELECT * FROM groupe WHERE Nom LIKE CONCAT('%','".$saisie."','%')";
		$req = mysql_query($sql);
		$requete_faite = 1;
		}
		
		if($requete_faite)
		{
			echo"<div class='Liste-groupes' >
			<ul>";
			while($ligne = mysql_fetch_assoc($req)) {
			echo"<li><a href='AffichageGroupeAdmin.php?id_groupe=".$ligne['Id']."'>"; echo $ligne['Nom'].'<br />' ; echo"</a></li>";
			}
		}
		mysql_close();
	
	echo"</ul>   
	</div>";
	

	include("./../layout/basic_footer.php");
	?>