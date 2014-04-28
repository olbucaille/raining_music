<?php 
include("./../layout/basic_header.php");
?>
<!-- debut de la page en elle meme-->
<div class="main">

<!-- boite de musique-->
<script src="./../js/Music_box.js"></script>
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
    <div class="ProcessYet"></div> <!-- temps jou��-->
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
    
    <div class="Single" > 
    <span class="SongName" KV="Moves Like Jagger" >01.Maroon 5 - Moves Like Jagger</span>
    </div> 
    <div class="Single" > 
    <span class="SongName" KV="Let It Go" >02.Demi Lovato - Let It Go</span>
    </div> 

    
    </div>
    </div>

	<br /> 
	<br />
	<p class="text">
		<big><big><strong>Revivez les moments emotionnels</strong> </big> </big>
	</p>
	
		<section id="slideshow">

			<div class="container">
				<div class="c_slider"></div>
				<div class="slider">
					<figure>
						<img src="../pictures/slideshow.jpg" alt="" width="640"
							height="310" />
						<figcaption>concert</figcaption>

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


	<br />

				
				<br />
			
			</p>
	  
      	

		</div>



	</div>
	<?php 
	include("./../layout/basic_footer.php");
	?>