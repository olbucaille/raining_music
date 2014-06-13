<?php
//on inclut le header 
include("./../layout/basic_header.php");
include("./../db_connect.inc.php");
include("./../model/salle2.php");
$liste = Salle::getsalle();


if(isset($_SESSION['user']))
{
	$user = unserialize($_SESSION['user']);
}

?>

<!-- debut de la page en elle meme-->


<div class="conteneur" style="margin-left:5%; width:90%; min-width:800px; height:100%; background-color:#c8c8c8; ">
	
	<div style="border-top:#236586 thick solid; border-radius: 0px 7px 7px 7px;   padding-left:10px;">
    <p ><strong>Création d'une salle de concert</strong><br /><br />L'équipe de Raining Music est heureuse de vous 
    proposer ce service de gestion de salle de concert. Pour toutes questions, rendez-vous sur notre F.A.Q. 
    Si vous n'y trouvez pas de réponse satisfaisante, vous pouvez toujours consulter notre Forum ou bien nous 
    contacter à l'aide de la rubrique <b>Nous contacter</b>.<br/><br/> L'équipe.</p>	
    </div>
    
    
    
    <div class="main">
    	
    	
    	<br /> <br />	
    	
 <div class="right" style="min-height: 400px; padding-left:10px; padding-top:20px; " >
 
 
 <div style="text-align:justify; border-top:#236586 thick solid; border-radius: 0px 7px 7px 7px;	box-shadow: 0 2px 4px 5px #424346;  padding:10px;">
    
  	 <span style="font-weight:bold;border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; padding-top:11px; font-family:Arial, Helvetica, sans-serif;
    		font-size:20px;" >&nbsp;Liste des salles existantes</span><br/><br/>
    		<?php 
    		$i=0;
    		while(isset($liste[$i])) 
    		{
    			echo $liste[$i]->Nom;
    		//	echo"<a href=\"./../index.php?action='rejoindre_salle'&salle=".$liste[$i]->Nom."\"style=\"float:right;\">rejoindre</a>";
    			echo"<hr />";
    			$i++;
			}
    		?>		
  	 </div>
    
  
 		
    	</div>
    	
    	
    
    <!-- deuxieme colone(gauche) !-->	
   	  <div class="left" style="width: 56% ;min-height: 400px; min-width: 56%">  
   	  
   	
   	  <span style=" background-color:#236586;font-weight:bold;border-radius: 7px 7px 0px 0px; padding-top:11px; font-family:Arial, Helvetica, sans-serif; font-size:20px; position:relative;top:-8px; " >&nbsp;Formulaire de creation de salle&nbsp;</span> 
     <br/>
     <!-- ------- FORMULAIRE D'un CONTACT ------------ -->
    <article id="formulaireContact" style="border:11px solid #236586;margin-top:15px; border-radius: 0px 7px 7px 7px; position:relative; bottom:25px; padding:10px; width=100%">
     <form action="../index.php?action='creerSalle'" method="post">
         
            <fieldset> 
            
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
        <?php //DEBUG
            /*if (!empty($_POST)) {
            	print_r($_POST);
            }*/?>
            
		    <label for="Nom">Nom de la salle*</label>
		    <input type="text" name="Nom" value=""/><br/><br/>
		    
		    <label for="Proprietaire">Propriétaire*</label>
		    <input type="text" name="Proprietaire" value="<?php echo $user->login?>" readonly="readonly" required/><br/><br/>
						
        	<label for="Departement">Département*</label>
		    <br/>	<?php
	function departements() {
		$departements = array (
				'Choisir un département',
				'(01) Ain',
				'(02) Aisne',
				'(03) Allier',
				'(04) Alpes de Haute Provence',
				'(05) Hautes Alpes',
				'(06) Alpes Maritimes',
				'(07) Ardèche',
				'(08) Ardennes',
				'(09) Ariège',
				'(10) Aube',
				'(11) Aude',
				'(12) Aveyron',
				'(13) Bouches du Rhône',
				'(14) Calvados',
				'(15) Cantal',
				'(16) Charente',
				'(17) Charente Maritime',
				'(18) Cher',
				'(19) Corrèze',
				'(20) Corse',
				'(21) Côte d\'Or',
				'(22) Côtes d\'Armor',
				'(23) Creuse',
				'(24) Dordogne',
				'(25) Doubs',
				'(26) Drôme',
				'(27) Eure',
				'(28) Eure et Loir',
				'(29) Finistère',
				'(30) Gard',
				'(31) Haute Garonne',
				'(32) Gers',
				'(33) Gironde',
				'(34) Hérault',
				'(35) Ille et Vilaine',
				'(36) Indre',
				'(37) Indre et Loire',
				'(38) Isère',
				'(39) Jura',
				'(40) Landes',
				'(41) Loir et Cher',
				'(42) Loire',
				'(43) Haute Loire',
				'(44) Loire Atlantique',
				'(45) Loiret',
				'(46) Lot',
				'(47) Lot et Garonne',
				'(48) Lozère',
				'(49) Maine et Loire',
				'(50) Manche',
				'(51) Marne',
				'(52) Haute Marne',
				'(53) Mayenne',
				'(54) Meurthe et Moselle',
				'(55) Meuse',
				'(56) Morbihan',
				'(57) Moselle',
				'(58) Nièvre',
				'(59) Nord',
				'(60) Oise',
				'(61) Orne',
				'(62) Pas de Calais',
				'(63) Puy de Dôme',
				'(64) Pyrénées Atlantiques',
				'(65) Hautes Pyrénées',
				'(66) Pyrénées Orientales',
				'(67) Bas Rhin',
				'(68) Haut Rhin',
				'(69) Rhône',
				'(70) Haute Saône',
				'(71) Saône et Loire',
				'(72) Sarthe',
				'(73) Savoie',
				'(74) Haute Savoie',
				'(75) Paris',
				'(76) Seine Maritime',
				'(77) Seine et Marne',
				'(78) Yvelines',
				'(79) Deux Sèvres',
				'(80) Somme',
				'(81) Tarn',
				'(82) Tarn et Garonne',
				'(83) Var',
				'(84) Vaucluse',
				'(85) Vendée',
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
		echo '<select name="Departement">';
		for($i = 0; $i < $departements_length; $i ++) {
			echo '<option value="' . $i . '">' . $departements [$i] . '</option>';
		}
		echo '</select>';
	}
	departements ();
	?><br/><br/>
		  										
		    <label for="Adresse">Adresse postale complète *</label>
		    <input type="text" name="Adresse" required/><br/><br/>
		    
			<label for="NbPlaces">Nombre de places*</label>
		    <input type="number" name="NbPlaces"  required/><br/><br/>
		    
		    <label for="Telephone">Téléphone*</label>
		    <input type="tel" name="Telephone" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required/><br/><br/>
		    
		    <label for="Horaires">Horaire d'ouverture*</label>
		    <input type="time" name="HoraireOuv" required/><br/><br/>
	    
	       <label for="Horaires">Horaire de fermeture*</label>
		    <input type="time" name="HoraireFerm" required/><br/><br/>
		    
			<br /> <br />
			
            <input id="sendButton" type="submit" value="Valider"/>
             
            </fieldset>
         
        </form>
        
    </article>
    
   	 </div>
       
   
      
</div>

<?php
//... puis le footer
include("./../layout/basic_footer.php");
?>