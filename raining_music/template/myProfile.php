<?php 
include("./../layout/basic_header.php");
include_once("../db_connect.inc.php");
include("./../model/alert.php");
if(isset($_SESSION['user']))
{
	$user = unserialize($_SESSION['user']);
}
//$alerts = Array();
$alerts = Alert::getAlert($user->login);
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
				Mes notifications : 
				<ul>
					<?php 
					$i=1;
					while(isset($alerts[$i]) )
					{
						$a = unserialize($alerts[$i]);
						$i++;
						if(!$a->Flag_lecture)
						{
						echo "<li>";
						echo $a->Description;
						echo "<a href=\"./../index.php?action='accepter_adhesion_membre_groupe'&amp;type=".$a->Type."\"> accepter</a> &nbsp 
									<a href=\"./../index.php?action='refuser_adhesion_membre_groupe'&amp;type=".$a->Type."\">refuser</a> ";
						echo "</li>";
						}
					}?>
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
				
				
				<input class="btn-right-loupe" Id="modif" name="go" type="submit" value="modifier"  onclick="modifInfoMyProfile()" />
				<input class="btn-right-loupe" Id="validModif" style="display:none"; name="go" type="submit" value="Valider" />
				
			</fieldset>
			</form>
		</div>
		
</div>

<form action="./../template/creerRejoindreGroupe.php" method="post">
	<input class="btn-right-loupe" name="go" type="submit" value="Creer groupe" />
</form>		<br />

<form action="./../template/creerSalle.php" method="post">
	<input class="btn-right-loupe" name="go" type="submit" value="Creer salle" />
</form>	
	</div>
	
</div>
<?php 
include("./../layout/basic_footer.php");
?>

