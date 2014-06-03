<?php
// on inclut le header
include ("./../layout/basic_header.php");
?>
          <?php
										// affichage d'un message d'erreur si besoin
										if (isset ( $_SESSION ['messageErreur'] )) {
											echo "<p style=\"color:red; font-weight:bold;\">";
											echo $_SESSION ['messageErreur'];
											echo "</p>";
											// destruction pour ne pas retrouver un vieux message plus tard
											$_SESSION ['messageErreur'] = '';
										}
										?>
            <?php
												// affichage d'un message si besoin
												if (isset ( $_SESSION ['message'] )) {
													echo "<p style=\"color:green; font-weight:bold;\">";
													echo $_SESSION ['message'];
													echo "</p>";
													// destruction pour ne pas retrouver un vieux message plus tard
													$_SESSION ['message'] = '';
												}
												?>

<script language="Javascript">
// ==================
//	Activations - D�sactivations
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


<form method="post" action="../Controller/traitementSearch.php"
	style="margin-left: 90px;">
	<label>Vous recherchez :</label><br /> <br /> <input type="radio"
		name="kindOfObject" value="salle"> <label>une salle </label><br />
	<?php
	function departements() {
		$departements = array (
				'(00) Non Specifie',
				'(01) Ain',
				'(02) Aisne',
				'(03) Allier',
				'(04) Alpes de Haute Provence',
				'(05) Hautes Alpes',
				'(06) Alpes Maritimes',
				'(07) Ard�che',
				'(08) Ardennes',
				'(09) Ari�ge',
				'(10) Aube',
				'(11) Aude',
				'(12) Aveyron',
				'(13) Bouches du Rh�ne',
				'(14) Calvados',
				'(15) Cantal',
				'(16) Charente',
				'(17) Charente Maritime',
				'(18) Cher',
				'(19) Corr�ze',
				'(2A) Corse du Sud',
				'(2B) Haute-Corse',
				'(21) C�te d\'Or',
				'(22) C�tes d\'Armor',
				'(23) Creuse',
				'(24) Dordogne',
				'(25) Doubs',
				'(26) Dr�me',
				'(27) Eure',
				'(28) Eure et Loir',
				'(29) Finist�re',
				'(30) Gard',
				'(31) Haute Garonne',
				'(32) Gers',
				'(33) Gironde',
				'(34) H�rault',
				'(35) Ille et Vilaine',
				'(36) Indre',
				'(37) Indre et Loire',
				'(38) Is�re',
				'(39) Jura',
				'(40) Landes',
				'(41) Loir et Cher',
				'(42) Loire',
				'(43) Haute Loire',
				'(44) Loire Atlantique',
				'(45) Loiret',
				'(46) Lot',
				'(47) Lot et Garonne',
				'(48) Loz�re',
				'(49) Maine et Loire',
				'(50) Manche',
				'(51) Marne',
				'(52) Haute Marne',
				'(53) Mayenne',
				'(54) Meurthe et Moselle',
				'(55) Meuse',
				'(56) Morbihan',
				'(57) Moselle',
				'(58) Ni�vre',
				'(59) Nord',
				'(60) Oise',
				'(61) Orne',
				'(62) Pas de Calais',
				'(63) Puy de D�me',
				'(64) Pyr�n�es Atlantiques',
				'(65) Hautes Pyr�n�es',
				'(66) Pyr�n�es Orientales',
				'(67) Bas Rhin',
				'(68) Haut Rhin',
				'(69) Rh�ne',
				'(70) Haute Sa�ne',
				'(71) Sa�ne et Loire',
				'(72) Sarthe',
				'(73) Savoie',
				'(74) Haute Savoie',
				'(75) Paris',
				'(76) Seine Maritime',
				'(77) Seine et Marne',
				'(78) Yvelines',
				'(79) Deux S�vres',
				'(80) Somme',
				'(81) Tarn',
				'(82) Tarn et Garonne',
				'(83) Var',
				'(84) Vaucluse',
				'(85) Vend�e',
				'(86) Vienne',
				'(87) Haute Vienne',
				'(88) Vosges',
				'(89) Yonne',
				'(90) Territoire de Belfort',
				'(91) Essonne',
				'(92) Hauts de Seine',
				'(93) Seine Saint Denis',
				'(94) Val de Marne',
				'(95) Val d\'Oise',
				'(971) Guadeloupe',
				'(972) Martinique',
				'(973) Guyane',
				'(974) R�union',
				'(975) Saint Pierre et Miquelon',
				'(976) Mayotte' 
		);
		
		$departements_length = count ( $departements );
		echo '<select name="dep">';
		for($i = 0; $i < $departements_length; $i ++) {
			echo '<option value="' . $i . '">' . $departements [$i] . '</option>';
		}
		echo '</select>';
	}
	departements ();
	?>
	<br /> <input type="radio" name="kindOfObject" value="concert"
		id="radio_02"> <label for="radio_02">un concert </label><br /> <select
		class="selectStyle" id="styleMusiqueConcert"
		name="styleMusiqueConcert"> Style de musique:
		<option value="NonSpecifie">Non sp�cifi�</option>
		<option value="Hip-Hop">Hip-Hop</option>
		<option value="Rock">Rock</option>
		<option value="J-Pop">J-Pop</option>
		<option value="Blues">Blues</option>
		<option value="Dancehall">Dancehall</option>
	</select><br /> <input type="radio" name="kindOfObject" value="groupe"
		id="radio_01" onClick="GereControle('radio_01', 'styleMusique', '1');"
		CHECKED> <label for="radio_01"> un groupe </label><br /> <select
		class="selectStyle" id="styleMusique" name="styleMusique"> Style de
		musique:
		<option value="NonSpecifie">Non sp�cifi�</option>
		<option value="Hip-Hop">Hip-Hop</option>
		<option value="Rock">Rock</option>
		<option value="J-Pop">J-Pop</option>
		<option value="Blues">Blues</option>
		<option value="Dancehall">Dancehall</option>

	</select><br /> un utilisateur <input type="radio" name="kindOfObject"
		value="membre"> <br /> Dont <select class="selectUserParam"
		id="userParam" name="userParam">
		<option value="NonSpecifie">N'importe quel champ</option>
		<option value="Login">le pseudo</option>
		<option value="Nom">le (vrai) nom</option>
		<option value="Mail">l'adresse mail</option>
		<option value="Localisation">la ville</option>
	</select>contient le(s) mot(s) cl�(s) suivant(s)<br /> Entrez un mot
	cl�:
	<!--<span style=" font-size: small; color: red; font-weight:bold;"> /!\ Attention, pour le moment, il est imp�ratif de remplir le champ de mot cl� pour ne pas g�n�rer d'erreur. /!\</span>-->
	<br> <input type="text" name="motcleSearch" size="15"> <input
		type="submit" value="Rechercher" alt="Lancer la recherche!"><br />


</form>


<?php

/*
 * if (! isset ( $_SESSION ['user'] )) SELECT * FROM faq WHERE MATCH(permalien, titre) AGAINST ('+tutoriel +mysql -wordpress' IN BOOLEAN MODE) ;
 */
?>
</body>

</html>