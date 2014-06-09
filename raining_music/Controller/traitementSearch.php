<?php

// inclusion du fichier checkDataBase
// (fichier requestSQL incut dans
// celui-ci)
include '../model/checkDataBase.php';
/*
 * Ce fichier php permet de traiter les elements saisies sur la page de recherche (simple et avancee).
 */

// ces declarations ne sont pas obligatoires, les variables sont toutes initialisées vides.

$Motcle = ''; // variable ou sera recuperer la saisie des mots clés (zone de texte) par l'utilisateur
$Checkbox = ''; // variable ou sera recuperer la saisie des checkbox "types d'evenements" par l'utilisateur

if (isset ( $_POST ['kindOfObject'] )) { // Vrai si au moins un moins un checkbox a été coché
	$choice = $_POST ['kindOfObject'];
	
	for($i = 0; $i < sizeof ( $choice ); $i ++) {
		if (isset ( $choice [$i] )) {
			if ($i == 0) {
				$Checkbox = "$choice[$i]";
			} else {
				$Checkbox .= " OR $choice[$i]";
			}
		}
	}
	
	// Ici à  chaque passage $kindOfObject contiendra la valeur de l'attribut value d'une des cases à  cocher
}

// ---------------------------------------------------------------------------//
// ----------Récuperation et vérification des valeurs dans la ----------------//
// ------------------------zone de texte de mots clés-------------------------//
// ---------------------------------------------------------------------------//

if (isset ( $_POST ['motcleSearch'] ) && (strlen ( $_POST ['motcleSearch'] ) <= 80)) {
	$Motcle = $_POST ['motcleSearch'];
} else {
	exit ( "Saisie incorrecte d un mot cle car plus de 80 caractÃ¨res !" );
}

// --------------------------------------------------------------------------//
// -----------------------fonction remplirCondition--------------------------//
// --------------------------------------------------------------------------//
if ($_POST ['kindOfObject'] != "menuSearchBarre")
	$cond = remplirCondition ( $Motcle, $Checkbox );
else {
	$condGroupe = remplirConditionGroupeOnly ( $Motcle );
	$condSalle = remplirConditionSalleOnly ( $Motcle );
}

// -- -- -- -- DEBUT DES FONCTIONS DE TRAITEMENT DE L'INFO EN INPUT -- -- -- -- //
function remplirConditionGroupeOnly($Motcle) {
	$RechercheGroupe = ''; // variable Fonction de condition
	if ($Motcle != "") {
		
		$RMotClef = explode ( " ", $Motcle );
		$NbMotClef = count ( $RMotClef );
		$check = new checkDataBase (); // Instance d'un objet checkDataBase (Voir le fichier checkDataBase.php pour plus d'informations
		
		$matableGroupe = "groupe";
		$RequeteTriGroupe = $check->checkTable ( $matableGroupe );
		
		$I = "0";
		$RechercheGroupe = '(';
		foreach ( $RequeteTriGroupe as $Row ) {
			$Type = preg_replace ( "[^a-z]", "", $Row ['Type'] );
			$Type = explode ( "(", $Type );
			$I2 = "0";
			
			if ($I != "0") {
				$RechercheGroupe .= " OR ";
			}
			reset ( $RMotClef );
			foreach ( $RMotClef as $V ) {
				$I2 ++;
				$V = str_replace ( "'", "''", $V );
				$RechercheGroupe .= $Row ['Field'] . " LIKE '%$V%'";
				
				if ($I2 != $NbMotClef) {
					$RechercheGroupe .= " OR ";
				}
			}
			$I ++;
		}
		$RechercheGroupe .= ')';
	}
	return $RechercheGroupe;
}
function remplirConditionSalleOnly($Motcle) {
	$RechercheSalle = ''; // variable Fonction de condition
	if ($Motcle != "") {
		
		$RMotClef = explode ( " ", $Motcle );
		$NbMotClef = count ( $RMotClef );
		$check = new checkDataBase (); // Instance d'un objet checkDataBase (Voir le fichier checkDataBase.php pour plus d'informations
		
		$matableSalle = "salle";
		$RequeteTriSalle = $check->checkTable ( $matableSalle );
		
		$I = "0";
		$RechercheSalle = '(';
		foreach ( $RequeteTriSalle as $Row ) {
			$Type = preg_replace ( "[^a-z]", "", $Row ['Type'] );
			$Type = explode ( "(", $Type );
			$I2 = "0";
			
			if ($I != "0") {
				$RechercheSalle .= " OR ";
			}
			reset ( $RMotClef );
			foreach ( $RMotClef as $V ) {
				$I2 ++;
				$V = str_replace ( "'", "''", $V );
				$RechercheSalle .= $Row ['Field'] . " LIKE '%$V%'";
				
				if ($I2 != $NbMotClef) {
					$RechercheSalle .= " OR ";
				}
			}
			$I ++;
		}
		$RechercheSalle .= ')';
	}
	return $RechercheSalle;
}
function remplirCondition($Motcle, $Checkbox) {
	
	// renvoie des données de la base en fonction des élements saisies par
	// l'utilisateur
	$Recherche = ''; // variable Fonction de condition
	if ($Motcle != "") {
		if ($_POST ['kindOfObject'] != "menuSearchBarre") {
			
			$matable = $_POST ['kindOfObject'];
			
			$RMotClef = explode ( " ", $Motcle );
			$NbMotClef = count ( $RMotClef );
			$check = new checkDataBase (); // Instance d'un objet checkDataBase (Voir le fichier checkDataBase.php pour plus d'informations
			$RequeteTri = $check->checkTable ( $matable );
			
			$I = "0";
			$Recherche = '(';
			foreach ( $RequeteTri as $Row ) {
				$Type = preg_replace ( "[^a-z]", "", $Row ['Type'] );
				$Type = explode ( "(", $Type );
				$I2 = "0";
				
				if ($I != "0") {
					$Recherche .= " OR ";
				}
				reset ( $RMotClef );
				foreach ( $RMotClef as $V ) {
					$I2 ++;
					$V = str_replace ( "'", "''", $V );
					$Recherche .= $Row ['Field'] . " LIKE '%$V%'";
					// var_dump($Recherche);
					if ($I2 != $NbMotClef) {
						$Recherche .= " OR ";
					}
				}
				$I ++;
			}
			$Recherche .= ')';
		} 

		else {
			
			$RMotClef = explode ( " ", $Motcle );
			$NbMotClef = count ( $RMotClef );
			$check = new checkDataBase (); // Instance d'un objet checkDataBase (Voir le fichier checkDataBase.php pour plus d'informations
			
			$matableGroupe = "groupe";
			$matableSalle = "salle";
			
			$RequeteTriGroupe = $check->checkTable ( $matableGroupe );
			$RequeteTriSalle = $check->checkTable ( $matableSalle );
			
			$I = "0";
			$RechercheGroupe = '(';
			foreach ( $RequeteTriGroupe as $Row ) {
				$Type = preg_replace ( "[^a-z]", "", $Row ['Type'] );
				$Type = explode ( "(", $Type );
				$I2 = "0";
				
				if ($I != "0") {
					$RechercheGroupe .= " OR ";
				}
				reset ( $RMotClef );
				foreach ( $RMotClef as $V ) {
					$I2 ++;
					$V = str_replace ( "'", "''", $V );
					$RechercheGroupe .= $Row ['Field'] . " LIKE '%$V%'";
					
					if ($I2 != $NbMotClef) {
						$RechercheGroupe .= " OR ";
					}
				}
				$I ++;
			}
			$RechercheGroupe .= ')';
			
			$I = "0";
			$RechercheSalle = '(';
			foreach ( $RequeteTriSalle as $Row ) {
				$Type = preg_replace ( "[^a-z]", "", $Row ['Type'] );
				$Type = explode ( "(", $Type );
				$I2 = "0";
				
				if ($I != "0") {
					$RechercheSalle .= " OR ";
				}
				reset ( $RMotClef );
				foreach ( $RMotClef as $V ) {
					$I2 ++;
					$V = str_replace ( "'", "''", $V );
					$RechercheSalle .= $Row ['Field'] . " LIKE '%$V%'";
					if ($I2 != $NbMotClef) {
						$RechercheSalle .= " OR ";
					}
				}
				$I ++;
			}
			$RechercheSalle .= ')';
		}
	} 

	else {
		$matable = $_POST ['kindOfObject'];
		$check = new checkDataBase (); // Instance d'un objet checkDataBase (Voir le fichier checkDataBase.php pour plus d'informations
		$RequeteTri = $check->checkTable ( $matable );
		
		$I = "0";
		
		foreach ( $RequeteTri as $Row ) {
			$Type = preg_replace ( "[^a-z]", "", $Row ['Type'] );
			$Type = explode ( "(", $Type );
			$I2 = "0";
			
			$I ++;
		}
	}
	// /////////////////////////////////////////////////////////////////////////////////////////////////
	// //////////////////////////CHOIX SUR OU FAIRE LA RECHERCHE POUR UN GROUPE/////////////////////////
	// /////////////////////////////////////////////////////////////////////////////////////////////////
	if ($_POST ['kindOfObject'] == "groupe") {
		$musicStyle = $_POST ['styleMusique'];
		
		if ($_POST ['motcleSearch'] != "") {
			if ($musicStyle != "NonSpecifie") {
				
				// ex: SELECT * From groupe Where Id in (SELECT Id_groupe From groupe_genre_musical where Nom_genre_musical = 'Rock')
				// echo "Requete recherche : ".$Recherche;
				// echo"\n Requete avec le reste : ".$Recherche."AND IN (SELECT Id_groupe From groupe_genre_musical where Nom_genre_musical = '" . $musicStyle."')";
				
				$Recherche .= "AND Id IN (SELECT Id_groupe From groupe_genre_musical where Nom_genre_musical = '" . $musicStyle . "')";
			}
		} else {
			if ($musicStyle != "NonSpecifie") {
				$Recherche .= "Id IN (SELECT Id_groupe From groupe_genre_musical where Nom_genre_musical = '" . $musicStyle . "')";
			}
		}
	}
	
	// /////////////////////////////////////////////////////////////////////////////////////////////////
	// //////////////////////////CHOIX SUR OU FAIRE LA RECHERCHE POUR UN MEMBRE/////////////////////////
	// /////////////////////////////////////////////////////////////////////////////////////////////////
	if ($_POST ['kindOfObject'] == "membre") {
		$userParam = $_POST ['userParam'];
		
		if (trim($_POST ['motcleSearch'], "") != "") {
			if ($userParam != "NonSpecifie") {
				
				$Recherche .= "AND Login IN (SELECT Login From membre)"; // A REPRENDRE
			}
		} else {
			if ($userParam != "NonSpecifie") {
				if ($RMotClef != "") {
					$Recherche .= " AND Login IN (SELECT Login From membre where ";
					foreach ( $RMotClef as $V ) {
						$V = str_replace ( "'", "''", $V );
						$Recherche .= $userParam . " LIKE '%$V%'";
					}
				}
				$Recherche .= ")";
			}
		}
	}
	
	// /////////////////////////////////////////////////////////////////////////////////////////////////
	// //////////////////////////CHOIX SUR OU FAIRE LA RECHERCHE POUR UN CONCERT////////////////////////
	// /////////////////////////////////////////////////////////////////////////////////////////////////
	
	if ($_POST ['kindOfObject'] == "concert") {
		$musicStyle = $_POST ['styleMusiqueConcert'];
		
		if ($_POST ['motcleSearch'] != "") {
			if ($musicStyle != "NonSpecifie") {
				
				$Recherche .= "AND Nom IN (SELECT Nom From concert Where Id IN(Select Id_concert From concert_genre_musical Where Nom_genre='" . $musicStyle . "'))";
			}
		} else {
			if ($musicStyle != "NonSpecifie") {
				$Recherche .= "Nom IN (SELECT Nom From concert Where Id IN(Select Id_concert From concert_genre_musical Where Nom_genre='" . $musicStyle . "'))";
			} else {
				$Recherche .= "";
			}
		}
	}
	
	// /////////////////////////////////////////////////////////////////////////////////////////////////
	// //////////////////////////CHOIX SUR OU FAIRE LA RECHERCHE POUR UNE SALLE ////////////////////////
	// /////////////////////////////////////////////////////////////////////////////////////////////////
	
	if ($_POST ['kindOfObject'] == "salle") {
		$selectedDep = $_POST ['dep'];
		
		if ($_POST ['motcleSearch'] == "") {
			if ($selectedDep != "0") {
				
				$Recherche .= "Departement IN (SELECT Departement From salle where Departement='" . $selectedDep . "')";
			} else {
				$Recherche .= "Adresse IN (SELECT Adresse From salle)";
			}
		} else {
			if ($selectedDep == "0") {
				if ($RMotClef != "") {
				}
			} else {
				
				$Recherche .= "AND Departement IN (SELECT Departement From salle where Departement='" . $selectedDep . "')";
			}
		}
	}
	
	// /////////////////////////////////////////////////////////////////////////////////////////////////
	// //////////////////////////RECHERCHE VIA LA BARRE DE RECHERCHE DU MENU ////////////////////////
	// /////////////////////////////////////////////////////////////////////////////////////////////////
	if ($_POST ['kindOfObject'] == "menuSearchBarre") {
		$Recherche = "";
		
		if ($_POST ['motcleSearch'] != "") {
			$Recherche .= " Login IN (SELECT * From membre)";
		} else {
			
			/*
			 * if ($RMotClef != "") { $Recherche .= " AND Login IN (SELECT Login From membre where "; foreach ( $RMotClef as $V ) { $V = str_replace ( "'", "''", $V ); $Recherche .= $userParam . " LIKE '%$V%'"; } }
			 */
			$Recherche .= ")";
		}
	}
	
	// echo "La condition de recherche est la suivante : ".$Recherche;
	return $Recherche;
}

$check = new checkDataBase ();

if ($_POST ['kindOfObject'] != "menuSearchBarre") {
	echo "La condition de recherche est la suivante: " . $cond;
	$resultats = $check->checkRecherche ( $_POST ['kindOfObject'], $cond );
	
	$nb_resultats = count ( $resultats );
	require_once ('../template/resultatRecherche.php');
} else {
	
	echo "La condition de recherche sur les salles est la suivante: " . $condSalle;
	echo "La condition de recherche sur les groupes est la suivante: " . $condGroupe;
	$resultatsGroupes = $check->checkRecherche ( "groupe", $condGroupe );
	$resultatsSalles = $check->checkRecherche ( "salle", $condSalle );
	
	$nb_resultatsGroupes = count ( $resultatsGroupes );
	$nb_resultatsSalles = count ( $resultatsSalles );
	
	require_once ('../template/resultatRechercheBarre.php');
}

?>
