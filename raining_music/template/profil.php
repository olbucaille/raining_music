<?php 
include("./../layout/basic_header.php");
if(isset($_SESSION['user']))
{
	$user = unserialize($_SESSION['user']);
}

/*
 * 
pour la technique, je fait pas d'appel au controleur, en fait quand tu t'identifie,
j'ai sérialisé l'objet user il suffi de le déserialiser à l'arrivée (veut dire qu'il faut inclure le modele mais bon) 
et toutes les infos sont dans la variable session ! 
et PAF ça fait des chocapics \o/
 */
?>

<!-- script relatif à la page, permet par exemple de gerer la modification :) -->
<script src="./../js/js_MyProfile.js"></script>

<!-- debut de la page en elle meme-->
<div class="conteneur"
	style="margin-left: 5%; width: 90%; min-width: 800px; height: 100%; background-color: #c8c8c8;">

	<div class="right" style="margin-top: 217px;">
		<div
			style="border: 11px solid #236586; border-radius: 0px 7px 7px 7px; position: relative; bottom: 25px; padding: 20px;">
			<span style="font-weight: bold;">Actu</span> <br />

			<fieldset>
				mes musiques preferés :
				<ul>
					<li>tata</li>
					<li>tata</li>
					<li>tata</li>
					<li>tata</li>
				</ul>
				
				mes derniers concerts :
				<ul>
					<li>tata</li>
					<li>tata</li>
					<li>tata</li>
					<li>tata</li>
				</ul>

				<br />
			</fieldset>
		</div>

	</div>

	<div class="left">

		<span class="profile">&nbsp;<?php echo $user->login?> </span> <img class="profile"
			src="../pictures/WorldOf.jpg" height="180" width="250" alt="toto"
			align="baseline" />
		<div
			style="border: 11px solid #236586; border-radius: 0px 7px 7px 7px; position: relative; bottom: 25px; padding: 20px;">
			<span style="font-weight: bold; font-size:25px; "> -> Fiche d'identité</span> <br /><br /><br />

			<fieldset>
				<span style="font-weight: bold;"> pseudo</span> : <span id="Info"><?php echo $user->login?></span><br /><br />
			    <span style="font-weight: bold;"> Nom</span> :  <?php echo $user->nom?><br /><br />
			    <span style="font-weight: bold;">mail </span>: <?php echo $user->mail?><br /><br />
			    <span style="font-weight: bold;">Sexe </span>: <?php if ($user->sexe==0) echo 'Masculin'; else echo'Feminin'; ?><br /><br />
				<span style="font-weight: bold;">Date de naissance </span>: <?php echo $user->DoB; ?> <br /><br />
				<span style="font-weight: bold;">Habite à </span>: <?php echo $user->localisation?><br /><br />
				<span style="font-weight: bold;">commentaire </span>: <?php echo $user->commentaire?>

				<br /><br />
				
				
				<input class="btn-right-loupe" name="go" type="submit" value="modifier"  onclick="modifInfoMyProfile()" />
				
			</fieldset>
		</div>

	</div>
</div>
<?php 
include("./../layout/basic_footer.php");
?>

