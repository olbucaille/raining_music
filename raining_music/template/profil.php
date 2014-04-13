<?php 
include("./../layout/basic_header.php");
if(isset($_SESSION['user']))
{
	$user = unserialize($_SESSION['user']);
}
?>
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
				<span style="font-weight: bold;"> pseudo</span> : <?php echo $user->login?><br /><br />
			    <span style="font-weight: bold;"> Nom</span> :  <?php echo $user->nom?><br /><br />
			    <span style="font-weight: bold;">mail </span>: <?php echo $user->mail?><br /><br />
			    <span style="font-weight: bold;">Sexe </span>: <?php if ($user->sexe==0) echo 'Masculin'; else echo'Feminin'; ?><br /><br />
				<span style="font-weight: bold;">Date de naissance </span>: <?php echo $user->DoB; ?> <br /><br />
				<span style="font-weight: bold;">Habite à </span>: <?php echo $user->localisation?><br /><br />
				<span style="font-weight: bold;">commentaire </span>: <?php echo $user->commentaire?>

				<br /><br />
				
				<form  class="search" method="post">
				<input class="btn-right-loupe" name="go" type="submit" value="modifier" />
				</form>
			</fieldset>
		</div>

	</div>
</div>
<?php 
include("./../layout/basic_footer.php");
?>
