

<?php 
include("./../layout/basic_header.php");
?>

<!--Allez vers la liste des artistes suivant le nom!-->

 <a href="A.html"> A </a>
 <a href="B.html"> B </a> 
 <a href="C.html"> C </a> 
 <a href="Redirection.php"> D </a> 
 <a href="E.html"> E </a> 
 <a href="F.html"> F </a> 
 <a href="G.html"> G </a> 
 <a href="H.html"> H </a> 
 <a href="I.html"> I </a> 
 <a href="J.html"> J </a> 
 <a href="K.html"> K </a> 
 <a href="L.html"> L </a> 
 <a href="M.html"> M </a> 
 <a href="N.html"> N </a> 
 <a href="O.html"> O </a> 
 <a href="P.html"> P </a> 
 <a href="Q.html"> Q </a> 
 <a href="R.html"> R </a> 
 <a href="S.html"> S </a> 
 <a href="T.html"> T </a> 
 <a href="U.html"> U </a> 
 <a href="V.html"> V </a> 
 <a href="W.html"> W </a> 
 <a href="X.html"> X </a> 
 <a href="Y.html"> Y </a> 
 <a href="Z.html"> Z </a> 
 <a href="#.html"> # </a> 

<br />
<br />
<!-- Rechercher un groupe -->
		
		<div class="search">		
				<form  class="search" method="post">
			
				<input class="search_data" name="saisie" type="search" placeholder="Le nom du groupe" required />
				<input class="btn-right-loupe" name="go" type="submit" />
				</form></div>
				
<!-- Affichage des Groupes en D -->
<br />
<br />

<div class="Liste-groupes" >
  <ul>
  	<li><a href="AffichageGroupe.php">Daft Punk</a>
  	<li><a href="DBSK.html">DBSK</a>
  	<li><a href="Deftones.html">Deftones</a>
  	<li><a href="Delays.html">Delays</a>
  	<li><a href="Destiny's Child.html">Destiny's Child</a>
  </ul>   
</div> 

	<?php 
	include("./../layout/basic_footer.php");
	?>