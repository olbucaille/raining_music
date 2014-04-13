<?php
// on inclut le header
include ("./../layout/basic_header.php");
?>
          <?php 
            //affichage d'un message d'erreur si besoin
            if(isset($_SESSION['messageErreur']))
            {
            echo "<p style=\"color:red; font-weight:bold;\">";
            echo $_SESSION['messageErreur'];
            echo "</p>";
            //destruction pour ne pas retrouver un vieux message plus tard
            $_SESSION['messageErreur']='';
            }?>
            <?php 
            //affichage d'un message si besoin
            if(isset($_SESSION['message']))
            {
            echo "<p style=\"color:green; font-weight:bold;\">";
            echo $_SESSION['message'];
            echo "</p>";
            //destruction pour ne pas retrouver un vieux message plus tard
            $_SESSION['message']='';
            }?>


<form method="post" action="../index.php?action='recherche_avancee'">
	<label>Vous recherchez :</label><br/>
		une salle <input type= "radio" name="kindOfObject" value="0"> <br />
		un concert <input type= "radio" name="kindOfObject" value="1">  <br/>
		un groupe <input type= "radio" name="kindOfObject" value="2">  <br/>
		un utilisateur <input type= "radio" name="kindOfObject" value="3">  <br/>
	Entrez un mot clé:<br> <input type="text" name="motcleSearch" size="15"> <input
		type="submit" value="Rechercher" alt="Lancer la recherche!"><br/>
		
			
</form>


<?php

/*if (! isset ( $_SESSION ['user'] ))
	SELECT *
	FROM faq
	WHERE MATCH(permalien, titre) AGAINST ('+tutoriel +mysql -wordpress' IN BOOLEAN MODE)
;
*/?>
</body>

</html>