<?php 
include("./../layout/basic_header.php");
include_once("../db_connect.inc.php");
include("./../model/alert.php");
if(isset($_SESSION['userToShow']))
{
	$user = unserialize($_SESSION['userToShow']);
}
?>
<?php if(isset($_SESSION['user'])){?>

<!-- debut de la page en elle meme-->
<div class="conteneur"
	style="margin-left: 5%; width: 90%; min-width: 800px; height: 100%; background-color: #c8c8c8;">

<div class="conteneur"
	style="margin-left: 5%; width: 90%; min-width: 800px; height: 100%; background-color: #c8c8c8;">

	<div class="right" style="margin-top: 217px;">
		<div
			style="border: 11px solid #236586; border-radius: 0px 7px 7px 7px; position: relative; bottom: 25px; padding: 20px;">
			<span style="font-weight: bold;">Actions</span> <br />

			<fieldset>
				<ul>
					<?php 
					$i=0;
					if(isset($_SESSION['listeGroup']))
					{
						$listeGroup = $_SESSION['listeGroup'];
						while(isset($listeGroup[0][$i]))
						{
								
							echo "<li>";
							echo "<a href=\"./../index.php?action='proposer_adhesion_membre_groupe'&amp;groupe=".$listeGroup[0][$i]."&amp;user=".$user->login."\"> inviter cette personne dans le groupe ".$listeGroup[0][$i]."</a> &nbsp";
							echo "</li><br />";
							
								
							
							$i++;
						}
						
					}
					
					while(isset($alerts[$i]) )
					{
						$a = unserialize($alerts[$i]);
						$i++;
						if(!$a->Flag_lecture)
						{
						}
					}?>
				</ul>
				
			
				<br />
			</fieldset>
		</div>

	</div>
	

	<div class="left">

     
		<span class="profile">&nbsp;<?php echo $user->login?> </span><img class="profile"
			src="<?php echo $user->picture ?>" height="180" width="250" alt="toto"
			align="baseline" />
		<div
			style="border: 11px solid #236586; border-radius: 0px 7px 7px 7px; position: relative; bottom: 25px; padding: 20px;">
			<span style="font-weight: bold; font-size:25px; "> -> Fiche d'identité</span> <br /><br /><br />
		<div Id="futureForm">
			<fieldset>
				<span Id="profileimg"></span>
				<span style="font-weight: bold;"> pseudo</span> : <span Id="InfoLogin"><?php echo $user->login?></span><br /><br />
			    <span style="font-weight: bold;"> Nom</span> :  <span Id="InfoNom"><?php echo $user->nom?></span><br /><br />
			    <span style="font-weight: bold;">mail </span>: <span Id="InfoMail"><?php echo $user->mail?></span><br /><br />
			    <span style="font-weight: bold;">Sexe </span>: <span Id="InfoSexe"><?php if ($user->sexe==0) echo 'Masculin'; else echo'Feminin'; ?></span><br /><br />
				<span style="font-weight: bold;">Date de naissance </span>: <span Id="InfoDoB"><?php echo $user->DoB; ?></span> <br /><br />
				<span style="font-weight: bold;">Habite à </span>: <span Id="InfoLocalisation"><?php echo $user->localisation?></span><br /><br />
				<span style="font-weight: bold;">commentaire </span>: <span Id="InfoCommentaire"><?php echo $user->commentaire?></span>

				<br /><br />
				
				
				
			</fieldset>
			</form>
		</div>
		
</div>

	</div>
	
</div>
<?php }else{?><h1 class="SearchResults">Oops !</h1>
<p class="OhOhMessage">Vous devez être connecté en tant que membre de Raining Music pour pouvoir visualiser les profils des autres membres.<br/>
Pour vous connecter, cliquez sur le menu déroulant <b>connexion </b>situé en haut à droite de votre écran ! ;)
<br/><br/>
L'équipe.</p>
<?php }?>
<?php 
include("./../layout/basic_footer.php");
?>

