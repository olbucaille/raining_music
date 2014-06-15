<?php 
include("./../layout/basic_header.php");
include_once("../db_connect.inc.php");
include("./../model/alert.php");
include ("./../model/group.php");
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
<script
	src="./../js/js_MyProfile.js"></script>

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

					$i=1;
					while(isset($alerts[$i]) )
					{
						$a = unserialize($alerts[$i]);
						$i++;
						if(!$a->Flag_lecture)
						{
							// ici je traite seuelement les alert de demande de salle
							$type =  explode("_",$a->Type);
							if($type[0]=="ASKSALLE"||$type[0]=="ASKGROUPE")
							{
								echo "<li>";
								echo $a->Description;
								echo "<a href=\"./../index.php?action='accepter_demande_salle'&amp;type=".$a->Type."\"> accepter</a> &nbsp
								<a href=\"./../index.php?action='refuser_demande_salle'&amp;type=".$a->Type."\">refuser</a> ";
								echo "</li>";
							}

							// alert pour notifier l'acceptation de la demande de salle
							elseif($type[0]=="demandeAccepte")
							{
								echo "<li>";
								echo $a->Description;
								echo "<a href=\"./../index.php?action='lire_notification'&amp;type=".$a->Type."\"> Ok</a> &nbsp";
								echo "</li>";
							}


							else

							{
								// les autres alerts
								echo "<li>";
								echo $a->Description;
								echo "<a href=\"./../index.php?action='accepter_adhesion_membre_groupe'&amp;type=".$a->Type."\"> accepter</a> &nbsp
								<a href=\"./../index.php?action='refuser_adhesion_membre_groupe'&amp;type=".$a->Type."\">refuser</a> ";
								echo "</li>";
							}

						}
}?>
				</ul>

			
				<br />
			</fieldset>
		</div>

	</div>

	<div class="left">


		<span class="profile">&nbsp;<?php echo $user->login?>
		</span><img class="profile" src="<?php echo $user->picture ?>"
			height="180" width="250" alt="toto" align="baseline" />
		<div
			style="border: 11px solid #236586; border-radius: 0px 7px 7px 7px; position: relative; bottom: 25px; padding: 20px;">
			<span style="font-weight: bold; font-size: 25px;"> -> Fiche
				d'identité</span> <br /> <br /> <br />
			<div Id="futureForm">
				<fieldset>
					<span Id="profileimg"></span> <span style="font-weight: bold;">
						pseudo</span> : <span Id="InfoLogin"><?php echo $user->login?> </span><br />
					<br /> <span style="font-weight: bold;"> Nom</span> : <span
						Id="InfoNom"><?php echo $user->nom?> </span><br /> <br /> <span
						style="font-weight: bold;">mail </span>: <span Id="InfoMail"><?php echo $user->mail?>
					</span><br /> <br /> <span style="font-weight: bold;">Sexe </span>:
					<span Id="InfoSexe"><?php if ($user->sexe==0) echo 'Masculin'; else echo'Feminin'; ?>
					</span><br /> <br /> <span style="font-weight: bold;">Date de
						naissance </span>: <span Id="InfoDoB"><?php echo $user->DoB; ?> </span>
					<br /> <br /> <span style="font-weight: bold;">Habite à </span>: <span
						Id="InfoLocalisation"><?php echo $user->localisation?> </span><br />
					<br /> <span style="font-weight: bold;"> Departement</span> : <span
						Id="InfoDep"><?php echo $user->departement?> </span><br /> 
					<br /> <span style="font-weight: bold;">commentaire </span>: <span
						Id="InfoCommentaire"><?php echo $user->commentaire?> </span> <br />
					<br /> <input class="btn-right-loupe" Id="modif" name="go"
						type="submit" value="modifier" onclick="modifInfoMyProfile()" /> <input
						class="btn-right-loupe" Id="validModif" style="display: none"
						; name="go" type="submit" value="Valider" />

				</fieldset>
				</form>
			</div>

		</div>

		<form action="./../template/creerRejoindreGroupe.php" method="post">
			<input class="btn-right-loupe" name="go" type="submit"
				value="Creer groupe" />
		</form>
		<br />

		<form action="./../template/creerSalle.php" method="post">
			<input class="btn-right-loupe" name="go" type="submit"
				value="Creer salle" />
		</form>
			<?php 
	
		if(isset($_SESSION['admin']))
			if($_SESSION['admin'])
		{
			?>
			<br/>
			<form action="./../index.php?action='reset_user'&user=<?php echo $user->login;?>" method="post">
			<input class="btn-right-loupe"  type="submit"
			value="desactiver le compte" />
			</form>
			
			
		<?php }?>
	
	
		
	</div>
	

	
	
	
<!-- AFFICHAGE DES ARTISTES SUIVIS -->
			<div
				style="border-top: #174156 thick solid; border-radius: 0px 7px 7px 7px; box-shadow: 0 2px 4px 5px #424346; padding: 10px; margin-bottom: 30px; width: 40%; float: right;">

				<span
					style="background-color: #174156; font-weight: bold; color: #fff; border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; padding: 11px; font-family: Arial, Helvetica, sans-serif; font-size: 20px;">&nbsp;Les
					artistes que je suis ! </span> <br /> <br />

			<?php $resultUserId = User::getUserId ( $user->login );
			foreach ( $resultUserId as $Row ) {
				$userId = $Row ['Id'];
			}?>
			<?php $groupsIfollow=User::getAllGroupsIFollow($userId)?>
			<?php $nb_groupsIfollow= count($groupsIfollow);?>
			<?php
			 //echo "TEST AVANT foreach";
			 //print_r($allDataFromConcertAroundMe)			?>
			<?php
			if ($nb_groupsIfollow!=0){
			foreach ( $groupsIfollow as $Row ) {
				
				$idGroupe = $Row ['Id'];
				$nomGroupe = $Row ['Nom'];
				$popGroupe = $Row ['Popularite'];

				$link = "../template/AffichageGroupeAdmin.php?id_groupe=".$idGroupe;
				


						echo "<h4 class=resultNames><a href=".$link.">" . $nomGroupe . "</a></h4>";
						
						echo "<p>Dont la popularité est de " .$popGroupe."</p><hr />";
					
				
			}
			}else{
				echo"Vous ne suivez actuellement aucun artiste. <br/><br/>Pour en suivre un, rendez-vous sur sa page d'artiste et cliquez sur le bouton \"Suivre cet artiste\"";
			}
			// }
			?>
			
			
			</div>
</div>
<?php 
include("./../layout/basic_footer.php");
?>

