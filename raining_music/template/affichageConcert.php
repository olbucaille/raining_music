<?php
include ("./../layout/basic_header.php");
include ("./../db_connect.inc.php");
include ("./../model/group.php");
if (isset ( $_GET ['id_groupe'] )) {
	$groupe = array ();
	$groupe = Group::getgroupname ( $_GET ['id_groupe'] );
}
?>
<div
style="border-top: #174156 thick solid; border-radius: 0px 7px 7px 7px; box-shadow: 0 2px 4px 5px #424346; padding: 10px; margin-left : 30px ; margin-bottom: 30px; width:80%; float: center;">

<span
style="background-color:#174156; font-weight: bold; color: #fff;
					border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px;
					padding: 11px; font-family: Arial, Helvetica, sans-serif;
					font-size: 20px;">&nbsp;Nos dates de concert !

					</span>					
					<br/>
					<br/>
					<h4 class=resultNames> <?php echo 'Voici les détails du concert : '?></h4>				
			<?php $allDataFromConcert=Group::getConcert()?>

			<?php
			
			foreach ( $allDataFromConcert as $Row ) {
				
				$idConcert = $Row ['Id'];
				$nomConcert = $Row ['Nom'];
				$dateConcert = $Row ['Date'];
				$heureConcert = $Row ['Heure'];
				$prixConcert = $Row ['Cout'];
				$descriptionConcert = $Row ['Description'];
				$salleConcert = $Row ['salle'];
				$groupeConcert = $Row ['Groupe'];
				$concertAccepte = $Row ['Concert_accepte'];
				$salleAccepte = $Row ['salle_acceptee'];
				
				// date à tester :
				$now = date ( 'Y-m-d' );
				$next = $dateConcert;
				
				// test
				$now = new DateTime ( $now );
				$now = $now->format ( 'Ymd' );
				$next = new DateTime ( $next );
				$next = $next->format ( 'Ymd' );
				
				if($groupeConcert == $groupe[0]->nom){
				if ($concertAccepte = $Row ['Concert_accepte'] == 1 && $salleAccepte = $Row ['salle_acceptee'] == 1) {
				if ($_GET['concert']==$nomConcert)	{
				if($now > $next)	{ 						
					}				
					else  {						
?>
						<fieldset>
						<span style="font-weight: bold;">Nom de concert</span> : <span><?php echo $nomConcert?> </span><br />
						<span style="font-weight: bold;">Date de concert</span> : <span><?php echo $dateConcert?> </span><br />
						<span style="font-weight: bold;">Heure de concert</span> : <span><?php echo $heureConcert?> </span><br />
						<span style="font-weight: bold;">Prix d'entrée</span> : <span><?php echo $prixConcert.'$'?> </span><br />
						<span style="font-weight: bold;">Information</span> : <span><?php echo $descriptionConcert?> </span><br />
						<span style="font-weight: bold;">Salle</span> : <span><?php echo $salleConcert?> </span><br />
						</fieldset>
						</br>
						</hr>
<?php }
}
}
}
}
?>			
</div>