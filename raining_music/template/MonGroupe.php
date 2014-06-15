<?php
include("./../layout/basic_header.php");
include ("./../db_connect.inc.php");
include ("./../model/group.php");
$id=array();
if(isset ( $_SESSION ['user'] )){
$user = unserialize($_SESSION['user']);
$resultat=Group::getmonGroupe($user->login);

}
?>

<div
style="border-top: #174156 thick solid; border-radius: 0px 7px 7px 7px; box-shadow: 0 2px 4px 5px #424346; padding: 10px; margin-left:30px ; margin-bottom: 30px; width: 40%; float: left;">
<span
style="background-color:#174156; font-weight: bold; color: #fff;
					border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px;
					padding: 11px; font-family: Arial, Helvetica, sans-serif;
					font-size: 20px;">&nbsp;Mes groupes !

					</span>
					<br/>
					<br/>
					

 <?php 
 if (empty ( $resultat )) {
echo "Vous n'avez pas encore de groupe. Venez vite rejoindre un groupe ou en créer un!";
 }
 else{
 foreach ( $resultat as $Row ) {
$mongroupe = $Row ['Nom_groupe'];
$i=0;

$id[$i] =Group::getgroupid($mongroupe);

?>
<tb>
<li><span style="font-weight: bold;"> <a href="affichageGroupeAdmin.php?id_groupe=<?php echo $id[$i]->Id ?>"><?php echo $mongroupe?></a> </span></li><br /> 
<?php 
$i++;
?>

</tb>
<?php }
}

?>
</div>
<div
				style="border-top: #174156 thick solid; border-radius: 0px 7px 7px 7px; box-shadow: 0 2px 4px 5px #424346; padding: 10px; margin-right:30px; margin-bottom: 30px; width:40%; float: right;">

				<span
					style="background-color:#174156; font-weight: bold; color: #fff;
					border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; 
					padding: 11px; font-family: Arial, Helvetica, sans-serif; 
					font-size: 20px;">&nbsp;Envie de créer ou rejoindre un groupe ?
				
				</span>
			<br/>
			<br/>
<form action="./../template/creerRejoindreGroupe.php" method="post">
<input class="btn-right-loupe" name="go" type="submit"
		value="Creer groupe" />
		</form>
		<br />
</div>
