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
<!-- 
<script language="Javascript">
// ==================
//	Activations - Désactivations
// ==================
function GereControle(Controleur, Controle, Masquer) {
var objControleur = document.getElementById(Controleur);
var objControle = document.getElementById(Controle);
	if (Masquer=='1')
		objControle.style.visibility=(objControleur.checked==true)?'visible':'hidden';
	else
		objControle.disabled=(objControleur.checked==true)?false:true;
	return true;
}
</script>
-->
            
<form method="post" action="../Controller/traitementSearch.php" style="margin-left: 90px;">
	<label>Vous recherchez :</label><br/><br/>
		une salle <input type= "radio" name="kindOfObject" value="salle" onClick="GereControle('radio_01', 'styleMusique', '1');"> <br />
		un concert <input type= "radio" name="kindOfObject" value="concert" onClick="GereControle('radio_01', 'styleMusique', '1');">  <br/>
		styleMusiqueConcert
		
		<select class="selectStyle" id="styleMusiqueConcert" name ="styleMusiqueConcert">
                    Style de musique:
                    	<option value="NonSpecifie">Non spécifié</option>
                        <option value="Hip-Hop">Hip-Hop</option>
                        <option value="Rock">Rock</option>
                        <option value="J-Pop">J-Pop</option>
                        <option value="Blues">Blues</option>
                        <option value="Dancehall">Dancehall</option>
                        
                        
		<input type= "radio" name="kindOfObject" value="groupe" id="radio_01" onClick="GereControle('radio_01', 'styleMusique', '1');" CHECKED>  <label for="radio_01"> un groupe </label><br/>
		
                    <select class="selectStyle" id="styleMusique" name ="styleMusique">
                    Style de musique:
                    	<option value="NonSpecifie">Non spécifié</option>
                        <option value="Hip-Hop">Hip-Hop</option>
                        <option value="Rock">Rock</option>
                        <option value="J-Pop">J-Pop</option>
                        <option value="Blues">Blues</option>
                        <option value="Dancehall">Dancehall</option>
                     
                    </select ><br/>
		un utilisateur <input type= "radio" name="kindOfObject" value="membre" onClick="GereControle('radio_01', 'styleMusique', '1');">  <br/>
				Dont
                    <select class="selectUserParam" id="userParam" name ="userParam">
                   		<option value="NonSpecifie">N'importe quel champ</option>
                    	<option value="Login">le pseudo</option>
                    	<option value="Nom">le (vrai) nom</option>
                        <option value="Mail">l'adresse mail</option>
                        <option value="Localisation">la ville</option> 
                         </select >contient le(s) mot(s) clé(s) suivant(s)<br/>
	Entrez un mot clé:<!--<span style=" font-size: small; color: red; font-weight:bold;"> /!\ Attention, pour le moment, il est impératif de remplir le champ de mot clé pour ne pas générer d'erreur. /!\</span>--><br> <input type="text" name="motcleSearch" size="15"> <input
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