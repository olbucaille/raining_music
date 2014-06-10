<?php 
include("./../layout/basic_header.php");
include("./../db_connect.inc.php");
include("./../model/song.php");
$liste= array();
$liste = Song::getSongName('abc');

?>
<script src="./../js/Music_box.js"></script>
<!-- debut de la page en elle meme-->
<div class="main">


<!-- boite de musique-->

<audio id="myMusic" > </audio> 

<input id="PauseTime"  type="hidden" />


    <div class="MusicBox" >

    <div class="LeftControl" ></div> <!-- icone morceau precedent -->
    <div id="MainControl" class="MainControl" ></div> <!-- icone jouer et arreter -->
    <div class="RightControl" ></div> <!-- icone morceau suivant -->
    
    <div class="ProcessControl"><!-- barre d'avancement -->
    <div class="SongName">Music Box!</div> <!-- titre du morceau-->
    <div class="SongTime">00:00&nbsp;|&nbsp;00:00</div> <!-- duration -->
    <div class="Process" ></div> <!-- barre de duree du morceau -->
    <div class="ProcessYet"></div> <!-- temps jou¨¦-->
    </div>
    
    <div class="VoiceEmp"></div> <!-- icone muet -->
    <div class="VoidProcess" ></div><!-- barre de son --> 
    <div class="VoidProcessYet" ></div> <!-- son choisi -->
    <div class="VoiceFull" ></div><!-- son max -->
    <div class="ShowMusicList" ></div> <!-- montrer ou masquer la liste de musique -->
    </div>
    
    
    <div class="MusicList">  
    <div class="Author">
    
    </div> 
    <div class="List"> 
	<input TYPE="button" VALUE="Ajouter une chanson" OnClick='document.location.href="UploadMusic.php";'>
	</br>
	</br>
<?php 
    $i=0;
    while (isset($liste[$i])){
	?>
	<div class="Single" >
	<span class="SongName" KV="<?php echo $liste[$i]->nom; ?>" > <?php echo $liste[$i]->nom; ?></span>
	</div>
   <?php  
  	$i++;
 	 }
 	 ?> 	
    </div>
    </div>
    </div>
	<br />
	<br /> 
	<br />
	<p class="text">
		<big><big><strong>Revivez les moments emotionnels</strong> </big> </big>
	</p>

	<span id="sl_play" class="sl_command">&nbsp;</span>
	<span id="sl_pause" class="sl_command">&nbsp;</span>
	<span id="sl_i1" class="sl_command sl_i">&nbsp;</span>
	<span id="sl_i2" class="sl_command sl_i">&nbsp;</span>
	<span id="sl_i3" class="sl_command sl_i">&nbsp;</span>
	<span id="sl_i4" class="sl_command sl_i">&nbsp;</span>
	
<section id="slideshow">
	
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
			

		</section>

<div class="conteneur"
	style="margin-left: 5%; width: 90%; min-width: 800px; height: 100%; background-color: #c8c8c8;">
	
	</span>
	<br />
			<hr />
	
	<p
				style="border-top: #147fb2 thick solid; border-radius: 0px 7px 7px 7px; box-shadow: 0 2px 4px 5px #424346; padding: 10px;">

				<span
					style="background-image: url(../pictures/back.png); font-weight: bold; 
					border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; 
					padding-top: 11px; font-family: Arial, Helvetica, sans-serif; 
					font-size: 20px;">&nbsp;A Monparnasse Paris, le 28/04/14
				
				</span>
			<br/>
			<br/>
			
			s a nulla vitae nisi suscipit tincidunt. Ut rutrum ipsum vitae sem
			tempus lobortis. Nullam porttitor turpis at risus placerat
			scelerisque. Praesent sed lectus metus, non elementum neque. Duis
			consequat imperdiet iaculis. Sed scelerisque elit at augue mollis
			tincidunt. In hac habitasse platea dictumst. Maecenas
			
			<hr />
			nulla vitae nisi suscipit tincidunt. Ut rutrum ipsum vitae sem tempus
			lobortis. Nullam porttitor turpis at risus placerat scelerisque.
			Praesent sed lectus metus, non elementum neque. Duis consequat
			imperdiet iaculis. Sed scelerisque elit at augue mollis tincidunt. In
			hac habitasse platea dictumst.Maecenas a nulla vitae nisi suscipit
			tincidunt. Ut rutrum ipsum vitae s
			<hr />
			em tempus lobortis. Nullam porttitor turpis at risus placerat
			scelerisque. Praesent sed lectus metus, non elementum neque. Duis
			consequat imperdiet iaculis. Sed scelerisque elit at augue mollis
			tincidunt. In hac habitasse platea dictumst.
			</p>
			
	<br />
	<span style="background-color: #236586; font-weight: bold; border-radius: 7px 7px 0px 0px; padding-top: 11px; font-family: Arial, Helvetica, sans-serif; font-size: 20px; position: relative; top: -8px;">&nbsp;Concerts&nbsp;</span>
			<p
				style="border: 11px solid #236586; border-radius: 0px 7px 7px 7px; position: relative; bottom: 25px; padding: 10px;" />
			<iframe
				src="https://mapsengine.google.com/map/embed?mid=zcDbx-dwquYs.kZPouQMZ2Ma0"
				width=100% height=350px></iframe>
			<br />
			</p>
			</p>
			
		</div>
		


	</div>

	<?php 
	include("./../layout/basic_footer.php");
	?>
