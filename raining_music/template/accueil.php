<?php 
include("./../layout/basic_header.php");
include("./../db_connect.inc.php");
include("./../model/song.php");
include ("./../model/group.php");
$liste= array();
$liste = Song::getSongName('abc');

?>
<script src="./../js/Music_box.js"></script>
<!-- debut de la page en elle meme-->
<div class="main">
	<br />

	<div class="conteneur" style="margin-left:5%; width:90%; min-width:800px; height:100%; background-color:#c8c8c8; ">
	
   	<div class="main">

    	<table style="border-top:#236586 thick solid; border-radius: 0px 7px 7px 7px;   padding-left:10px;">
    <tr><td><p>   	            <?php 
            //affichage d'un message si besoin
            if(isset($_SESSION['message']))
            {
            echo "<p style=\"color:green; font-weight:bold;\">";
            echo $_SESSION['message'];
            echo "</p>";
            //destruction pour ne pas retrouver un vieux message plus tard
            $_SESSION['message']='';
            }
            ?></p>
<p ><b style="font-family: ; font-size: 22px;">Bonjour et bienvenue sur <b style="color: #174156">Raining Music</b>, site communautaire d�di� � la musique.</b>
	<br/><br/>Depuis plusieurs semaines maintenant,<b> Raining Music </b>facilite la mise en relation des artistes, groupes de musique, 
	organisateurs de concerts et amateurs de musique.
<br/><br/>
Avec votre profil, vous pouvez contacter les autres abonn�s, cr�er un espace personnel pour votre propre groupe ou salle de concert,
voter pour vos artistes pr�f�r�s, �changer via notre forum, effectuer des recherches avanc�es, �couter des extraits de musique post�s par les artistes et groupes. 
<br/><br/>Pour cr�er votre profil, cliquez d�s maintenant sur le menu d�roulant <b>connexion</b> en haut � droite puis sur 
<b style="background-color: #174156; width: 150px; height: 150px; color: white; padding:4px;border-radius: 5px; ">&nbsp;S'inscrire&nbsp;</b>
	</p>
</td>
<td>
 
</p></td>
</tr>
  </table>
  
    </div>


	<span id="sl_play" class="sl_command">&nbsp;</span>
	<span id="sl_pause" class="sl_command">&nbsp;</span>
	<span id="sl_i1" class="sl_command sl_i">&nbsp;</span>
	<span id="sl_i2" class="sl_command sl_i">&nbsp;</span>
	<span id="sl_i3" class="sl_command sl_i">&nbsp;</span>
	<span id="sl_i4" class="sl_command sl_i">&nbsp;</span>
	
<div id="slideshow">
	
		<a class="play_commands pause" href="#sl_pause" title="pause">Pause</a>
		<a class="play_commands play" href="#sl_play" title="play">Play</a>
	
			<div class="container">
				<div class="c_slider"></div>
				<div class="slider">
					<figure>
						<img src="../pictures/slideshow.jpg" alt="" width="640"
							height="310"  />
						<figcaption>concert1</figcaption>

					</figure>
					<figure>
						<img src="../pictures/slideshow1.jpg" alt="" width="640"
							height="310" />
						<figcaption>concert2</figcaption>
					</figure>
					<figure>
						<img src="../pictures/slideshow3.jpg" alt="" width="640"
							height="310" />
						<figcaption>concert3</figcaption>
					</figure>
					<figure>
						<img src="../pictures/slideshow2.jpg" alt="" width="640"
							height="310" />
						<figcaption>concert4</figcaption>
					</figure>
				</div>

			</div>

			<span id="timeline"></span>
				<ul class="dots_commands"><!--
			--><li><a title="Show slide 1" href="#sl_i1">Slide 1</a></li><!--
			--><li><a title="Show slide 2" href="#sl_i2">Slide 2</a></li><!--
			--><li><a title="Show slide 3" href="#sl_i3">Slide 3</a></li><!--
			--><li><a title="Show slide 4" href="#sl_i4">Slide 4</a></li>
		</ul>
			

		</div>

<div class="conteneur"
	style="margin-left: 5%; width: 90%; min-width: 800px; height: 100%; background-color: #c8c8c8;">
	
	</span>
	<br />
			
	
	<div
				style="border-top: #174156 thick solid; border-radius: 0px 7px 7px 7px; box-shadow: 0 2px 4px 5px #424346; padding: 10px; margin-bottom: 30px; width:40%; float: left;">

				<span
					style="background-color:#174156; font-weight: bold; color: #fff;
					border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; 
					padding: 11px; font-family: Arial, Helvetica, sans-serif; 
					font-size: 20px;">&nbsp;Les artistes les mieux not�s !
				
				</span>
			<br/>
			<br/>
			
			<?php $les3PlusPopulaires=Group::getBestGroupByPop(3)?>
			<?php //echo "TEST AVANT foreach";
			//print_r($les3PlusPopulaires)?>
			<?php foreach ($les3PlusPopulaires as $Row){
				
				$idGroupe=$Row['Id'];
				$nomGroupe=$Row['Nom'];
				$populariteGroupe=$Row['Popularite'];

				//if ($populariteGroupe!=null&&$populariteGroupe!="")
				//{
					$genreMusicalGroupe=Group::getGenreMusicalGroupe($nomGroupe);
					//echo"<br/><br/>";
					//print_r($genreMusicalGroupe);
					
					foreach ($genreMusicalGroupe as $Row2){
						$genreMusicalGrp=$Row2['Nom_genre_musical'];
					
					echo "<h4 class=resultNames><a href='../template/AffichageGroupeAdmin.php?id_groupe=".$Row['Id']."'>".$nomGroupe."</a></h4>";
					
					echo "Dans la cat�gorie <b>".$genreMusicalGrp."</b> dont la popularit� est de : <b>".$populariteGroupe."</b></p><hr />";
					}
				//}
			}?>
			
			</div>
				<div
				style="border-top: #174156 thick solid; border-radius: 0px 7px 7px 7px; box-shadow: 0 2px 4px 5px #424346; padding: 10px; margin-bottom: 30px; width:40%; float: right;">

				<span
					style="background-color:#174156; font-weight: bold; color: #fff;
					border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; 
					padding: 11px; font-family: Arial, Helvetica, sans-serif; 
					font-size: 20px;">&nbsp;Nos nouveaux inscrits !
				
				</span>
			<br/>
			<br/>
			
			<?php $les3PlusRecents=User::getLastRegisteredUsers(3)?>
			<?php //echo "TEST AVANT foreach";
			//print_r($les3PlusRecents)?>
			<?php foreach ($les3PlusRecents as $Row){
				
				$idMembre=$Row['Id'];
				$loginMembre=$Row['Login'];
				$sexeMembre=$Row['Sexe'];
				$LocalisationMembre=$Row['Localisation'];
				$doBMembre=$Row['DoB'];
				$dateInscriptionMembre=$Row['DateInscription'];

				$link =  "../index.php?action='visualiser_User'&Nom=".$loginMembre;
		
					echo "<h4 class=resultNames><a href=".$link.">".$loginMembre."</a></h4>";
					if ($sexeMembre!=1)
						echo "nouvel inscrit";
   					else 
   						echo "nouvelle inscrite";
   					echo" du ".$dateInscriptionMembre." qui habite pr�s de ".$LocalisationMembre.". <br/>On lui souhaite la bienvenue !</p><hr />";
					}
				//}
			?>
			
			</div>
	<br />
	
		</div>
		


	</div>

	<?php 
	include("./../layout/basic_footer.php");
	?>
