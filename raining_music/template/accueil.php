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
<p ><b style="font-family: ; font-size: 22px;">Bonjour et bienvenue sur <b style="color: #174156">Raining Music</b>, site communautaire dédié à la musique.</b>
	<br/><br/>Depuis plusieurs semaines maintenant,<b> Raining Music </b>facilite la mise en relation des artistes, groupes de musique, 
	organisateurs de concerts et amateurs de musique.
<br/><br/>
Avec votre profil, vous pouvez contacter les autres abonnés, créer un espace personnel pour votre propre groupe ou salle de concert,
voter pour vos artistes préférés, échanger via notre forum, effectuer des recherches avancées, écouter des extraits de musique postés par les artistes et groupes. 
<br/><br/>Pour créer votre profil, cliquez dès maintenant sur le menu déroulant <b>connexion</b> en haut à droite puis sur 
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
				style="border-top: #174156 thick solid; border-radius: 0px 7px 7px 7px; box-shadow: 0 2px 4px 5px #424346; padding: 10px; margin-bottom: 30px;">

				<span
					style="background-color:#174156; font-weight: bold; color: #fff;
					border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; 
					padding: 11px; font-family: Arial, Helvetica, sans-serif; 
					font-size: 20px;">&nbsp;Les artistes les mieux notés !
				
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
					
					echo "Dans la catégorie <b>".$genreMusicalGrp."</b> dont la popularité est de : <b>".$populariteGroupe."</b></p><hr />";
					}
				//}
			}?>
			
			
			
			
			
			
			<!-- 
						<h3>Artiste1</h3>
			<p><i>Artiste1</i> est un groupe de <i>"style_de_musique"</i> dont les membres sont les suivants : <i>Membre1Artiste1 (rôle_dans_le_groupe)</i>, 
			[<i>Membre2Artiste1 (rôle_dans_le_groupe)</i>, [<i>Membre3Artiste1 (rôle_dans_le_groupe)</i>, [...]] ]<br/>
			Leur dernier concert remonte au <i>"date_du_last_concert"</i> et s'est déroulé dans la salle <i>"nom_de_la_salle"</i></p>
			
			
			<hr />
						<h3>Artiste2</h3>
			<p><i>Artiste2</i> est un groupe de <i>"style_de_musique"</i> dont les membres sont les suivants : <i>Membre1Artiste2 (rôle_dans_le_groupe)</i>, 
			[<i>Membre2Artiste2 (rôle_dans_le_groupe)</i>, [<i>Membre3Artiste2 (rôle_dans_le_groupe)</i>, [...]] ]<br/>
			Leur dernier concert remonte au <i>"date_du_last_concert"</i> et s'est déroulé dans la salle <i>"nom_de_la_salle"</i></p>
			<hr />
						<h3>Artiste3</h3>
			<p><i>Artiste3</i> est un groupe de <i>"style_de_musique"</i> dont les membres sont les suivants : <i>Membre1Artiste3 (rôle_dans_le_groupe)</i>, 
			[<i>Membre2Artiste3 (rôle_dans_le_groupe)</i>, [<i>Membre3Artiste3 (rôle_dans_le_groupe)</i>, [...]] ]<br/>
			Leur dernier concert remonte au <i>"date_du_last_concert"</i> et s'est déroulé dans la salle <i>"nom_de_la_salle"</i></p>-->
			
			
			
			</div>
			
	<br />
	<span style="background-color: #236586; font-weight: bold; border-radius: 7px 7px 0px 0px; padding-top: 11px; font-family: Arial, Helvetica, sans-serif; font-size: 20px; position: relative; top: -8px;">&nbsp;Concerts&nbsp;</span>
			<p
				style="border: 11px solid #236586; border-radius: 0px 7px 7px 7px; position: relative; bottom: 25px; padding: 10px;" />
			<iframe
				src="https://mapsengine.google.com/map/embed?mid=zcDbx-dwquYs.kZPouQMZ2Ma0"
				width=100% height=150px></iframe>
			<br />
			</p>
			</p>
			
		</div>
		


	</div>

	<?php 
	include("./../layout/basic_footer.php");
	?>
