<?php
// on inclut le header
include ("./../layout/basic_header.php");
include '../model/checkDataBase.php';
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
<div class="conteneur" style="margin-left:5%; width:90%; min-width:800px; height:100%;  ">
	<br/><br/><br/><br/>
	<div class="right" style="width: 45% ;min-height: 400px; min-width: 45%">  
   	  
   	
   	  <span style=" background-color:#236586;font-weight:bold;border-radius: 7px 7px 0px 0px; padding-top:11px; font-family:Arial, Helvetica, sans-serif; font-size:20px; position:relative;top:-8px; " >&nbsp;Utilisation de la Recherche Avanc�e&nbsp;</span> 
     <br/>
     <div style="border:11px solid #236586;margin-top:15px; border-radius: 0px 7px 7px 7px; position:relative; bottom:25px; padding:10px; width=100%">
    <p > La <b>recherche avanc�e</b> vous permet de choisir ce sur quoi votre recherche doit porter et le degr� d'affinage de la recherche. <br/>Pour :
    <ol><li>Un groupe de musique</li>
    	<ul><li>Choisir le style de musique du groupe</li></ul>
    	<li>Une salle de concert</li>
    	<ul><li>D�finir la zone de recherche</li></ul>
    	<li>Un membre</li>
    	<ul><li>La recherche est effectu�e sur le <i>login</i> du membre</li></ul>
    	<li>Un concert</li>
    	<ul><!-- <li>D�finir la zone de recherche</li>-->
    	<li>Choisir le style de musique du concert </li></ul>
    </ol>
    </p></div>
    
   	 </div>
	
   	<div class="main">

    	<table style="border-top:#236586 thick solid; border-radius: 0px 7px 7px 7px;	box-shadow: 0 2px 4px 5px #424346;  min-width:45%; padding-left:10px;">
    <tr><td style="text-align: justify; padding-right: 20px;">
<?php if(isset($_SESSION['user'])){?>
   
<div>
<H1 class="SearchResults">Vous recherchez :</H1>
</div>

<form method="post" action="../Controller/traitementSearch.php" style="margin-left: 10%;" 
class="containerSearchResults";>
	<ul>
	<li><input type="radio" name="kindOfObject" value="groupe"
		id="radio_01" onClick="GereControle('radio_01', 'styleMusique', '1');"
		CHECKED> <label for="radio_01" class="filter_1"> un groupe </label><br /> <select
		class="selectStyle" id="styleMusique" name="styleMusique">
		<option value="NonSpecifie">Non sp�cifi�</option>
		
		<!-- --------------------------------------------------------------------- -->
		<!-- SCRIPT QUI PERMET DE VISUALISER UNIQUEMENT LES STYLES PRESENTS EN BDD -->
		<!-- --------------------------------------------------------------------- -->
		<?php 
		$check = new checkDataBase ();
		$resultatGenre = $check->checkRecherche ( 'genre_musical', "" );
		
		$check = new checkDataBase (); // Instance d'un objet checkDataBase (Voir le fichier checkDataBase.php pour plus d'informations
		$resultatGenre = $check->checkRecherche ( 'genre_musical', "" );
		print_r($resultatGenre);
			$nb_resultatsGenre = count ( $resultatGenre );

		?>
		<?php 
		if ($nb_resultatsGenre!=0) {
			foreach ($resultatGenre as $Row):
				echo "<option value='".$Row['Nom']."'>".$Row['Nom']."</option>";
			endforeach;
		}
		?>
		<!-- --------------------------------------------------------------------- -->
		<!-- --------------------------------------------------------------------- -->

	</select></li><br />
	
	<li><input type="radio"
		name="kindOfObject" value="salle"> <label class="filter_1">une salle </label><br />
	<?php
	function departements() {
		$departements = array (
				'(00) Non Specifi�',
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
				'(20) Corse',
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
				'(95) Val d\'Oise'
		);
		
		$departements_length = count ( $departements );
		echo '<select name="dep">';
		for($i = 0; $i < $departements_length; $i ++) {
			echo '<option value="' . $i . '">' . $departements [$i] . '</option>';
		}
		echo '</select>';
	}
	departements ();
	?></li>
	<br /><input type="radio" name="kindOfObject"
		value="membre"><label class="filter_1">un utilisateur </label> <br /><br />
		
		
		<li> <input type="radio" name="kindOfObject" value="concert"
		id="radio_02"> <label for="radio_02" class="filter_1">un concert </label><br /> <select
		class="selectStyle" id="styleMusiqueConcert"
		name="styleMusiqueConcert">
		<option value="NonSpecifie">Non sp�cifi�</option>
		
		<!-- --------------------------------------------------------------------- -->
		<!-- SCRIPT QUI PERMET DE VISUALISER UNIQUEMENT LES STYLES PRESENTS EN BDD -->
		<!-- --------------------------------------------------------------------- -->
		<?php 
		$check = new checkDataBase ();
		$resultatGenre = $check->checkRecherche ( 'genre_musical', "" );
		
		$check = new checkDataBase (); // Instance d'un objet checkDataBase (Voir le fichier checkDataBase.php pour plus d'informations
		$resultatGenre = $check->checkRecherche ( 'genre_musical', "" );
		print_r($resultatGenre);
			$nb_resultatsGenre = count ( $resultatGenre );

		?>
		<?php 
		if ($nb_resultatsGenre!=0) {
			foreach ($resultatGenre as $Row):
				echo "<option value='".$Row['Nom']."'>".$Row['Nom']."</option>";
			endforeach;
		}
		?>
		<!-- --------------------------------------------------------------------- -->
		<!-- --------------------------------------------------------------------- -->
	</select></li><br />  Entrez un mot
	cl�:
	<!--<span style=" font-size: small; color: red; font-weight:bold;"> /!\ Attention, pour le moment, il est imp�ratif de remplir le champ de mot cl� pour ne pas g�n�rer d'erreur. /!\</span>-->
	<br> <input type="text" name="motcleSearch" size="15"> <input
		type="submit" value="Rechercher" alt="Lancer la recherche!"><br />

</ul>
</form>
<?php }else{
?>

      <p>Pour acc�der � la Recherche Avanc�e, veuillez vous identifier via l'onglet <b>connexion</b> situ� en haut � droite de votre �cran.<br/>
      Si vous n'�tes pas encore inscrit, cliquez sur l'onglet <b>connexion</b> puis sur <b>S'inscrire</b>.<br/><br/>
      Actuellement, vous pouvez uniquement effectuer des recherches "simples" via la barre de Recherche situ�e dans la barre de menu. Les recherches effectu�es 
      concernent uniquement les groupes et les salles.<br/>
      La Recherche Avanc�e vous permettra donc de faire d'autres recherches concernant les concerts organis�s via notre site et les utilisateurs existants.
      <br/><br/>
      Pour toute question, n'h�sitez pas � nous contacter via l'onglet <b>Nous contacter</b> situ�e dans la barre de menu.
      <br/><b>L'�quipe Raining Music</b>
      
      


<?php }?>
</td>

</p></td>
</tr>
</table>
<br /><br />
</div>



<?php /*
 * if (! isset ( $_SESSION ['user'] )) SELECT * FROM faq WHERE MATCH(permalien, titre) AGAINST ('+tutoriel +mysql -wordpress' IN BOOLEAN MODE) ;
 */
?>
</body>

</html>