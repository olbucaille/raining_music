<?php
include("./../layout/basic_header.php");
include("./../db_connect.inc.php");
include("./../model/group.php");



//récupération de l'URL de l'ancienne page (groupe sur lequel on était avant le vote)
$URL=$_POST ['adresseURL'];
//echo "Adresse url pour la redirection => " . $URL . "<br/>";
//récupération de l'ID du groupe
$idGroupe=$_POST['iDGroup'];
//echo "L'ID du groupe sur lequel le vote est effectué est : ".$idGroupe."<br/><br/>";

//inputs param
$NbVotesBefore = $_POST ['NombreVotes'];
$ScoreTotalBefore = $_POST ['ScoreTotal'];
//calcul de la popularite AVANT vote
if ($NbVotesBefore != 0) {
	$temp = $ScoreTotalBefore / $NbVotesBefore;
	$popuBefore = ceil ( $temp * 2 ) / 2;
} else
	$popuBefore = 0;

/*echo "Nombre de votes sur cet artiste avant vote actuel => " . $NbVotesBefore . "<br/>";
echo "Score total avant vote actuel => " . $ScoreTotalBefore . "<br/>";
echo "PopulariteMoyenne=(ScoreTotal/NbVotes) => ".$popuBefore."<br/><br/>";*/

//nombre de votes réactualisé => à insérer en BDD
$NbVotesAfter=$NbVotesBefore+1;
// echo "Nombre de votes sur cet artiste après vote actuel => " . $NbVotesAfter . "<br/><br/>";

 
 // traitement en fonction du vote
 
if ($_POST ['btnVote'] == 1) {
	//echo "VOTE = 1 <br/>";
	//Nouveau score total
	$ScoreTotalAfter=$ScoreTotalBefore+1;
} elseif ($_POST ['btnVote'] == 2) {
	//echo "VOTE = 2 <br/>";
	//Nouveau score total
	$ScoreTotalAfter=$ScoreTotalBefore+2;
} elseif ($_POST ['btnVote'] == 3) {
	//echo "VOTE = 3 <br/>";
	//Nouveau score total
	$ScoreTotalAfter=$ScoreTotalBefore+3;
} elseif ($_POST ['btnVote'] == 4) {
	//echo "VOTE = 4 <br/>";
	//Nouveau score total
	$ScoreTotalAfter=$ScoreTotalBefore+4;
} else {
	//echo "VOTE = 5 <br/>";
	//Nouveau score total
	$ScoreTotalAfter=$ScoreTotalBefore+5;
}
//echo "Le nouveau score est : ".$ScoreTotalAfter." (".$ScoreTotalBefore."+".$_POST ['btnVote'].")<br/>";
//nouvelle cote de popularite
$popuAfter=$ScoreTotalAfter/$NbVotesAfter;
$popuAfterRounded= ceil ($popuAfter*2)/2;
//Secho "La nouvelle popularite est : ".$popuAfterRounded;//." (~ ".$ScoreTotalAfter."/".$NbVotesAfter.")";



// MISE A JOUR DE LA BDD !!!
//updateGroupPopularite($idGroupe,$newPop, $newScore, $newNbVotes)

Group::updateGroupPopularite($idGroupe, $popuAfterRounded, $ScoreTotalAfter, $NbVotesAfter);

//insertVote($idGroupe,$Login)
$userLogin=$user->login;
//echo "Login du membre actif:".$userLogin;
Group::insertVote($idGroupe, $userLogin);


echo "<br/>Votre vote a bien été pris en compte. <br/>La nouvelle cote de popularité pour cet artiste est : ".$popuAfterRounded."/5 <br/>";
echo "Vous allez être redirigé vers la page du groupe dans 5 secondes. <br/>Si la redirection ne s'effectue pas, <a href=" . $URL . ">cliquez ici</a>."?><?php

	header ( "Refresh: 5;URL=".$URL );
	exit ();


//echo "<a href='$URL'>Retour à la page du groupe</a>"


?>