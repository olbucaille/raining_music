<?php

//inclusion du fichier checkDataBase
//(fichier requestSQL incut dans
//celui-ci)
include '../model/checkDataBase.php';
/*
 * Ce fichier php permet de traiter les elements saisies sur la page de recherche
 * (simple et avancee).
 */

//ces declarations ne sont pas obligatoires, les variables sont toutes initialisées vides.

$Motcle = ''; //variable ou sera recuperer la saisie des mots clés (zone de texte) par l'utilisateur
$Checkbox = ''; //variable ou sera recuperer la saisie des checkbox "types d'evenements" par l'utilisateur







if (isset($_POST['kindOfObject'])) {  //Vrai si au moins un moins un checkbox a été coché
    $choice = $_POST['kindOfObject'];

    for ($i = 0; $i < sizeof($choice); $i++) {
        if (isset($choice[$i])) {
            if ($i == 0) {
                $Checkbox = "$choice[$i]";
            } else {
                $Checkbox .= " OR $choice[$i]";
            }
        }
    }

    //Ici à  chaque passage $kindOfObject contiendra la valeur de l'attribut value d'une des cases à  cocher
}

//---------------------------------------------------------------------------//
//----------Récuperation et vérification des valeurs dans la ----------------//
//------------------------zone de texte de mots clés-------------------------//
//---------------------------------------------------------------------------//


if (isset($_POST['motcleSearch']) && (strlen($_POST['motcleSearch']) <= 80 )) {
    $Motcle = $_POST['motcleSearch'];
} else {
    exit("Saisie incorrecte d un mot cle car plus de 80 caractÃ¨res !");
}


//--------------------------------------------------------------------------//
//-----------------------fonction remplirCondition--------------------------//
//--------------------------------------------------------------------------//


$cond = remplirCondition($Motcle, $Checkbox);

function remplirCondition($Motcle,$Checkbox) {

    //renvoie des données de la base en fonction des élements saisies par 
    //l'utilisateur

    $Recherche = ''; // variable Fonction de condition
	if ($Motcle != "") { // -------------------------- /!\ NE PAS CHERCHER A COMPRENDRE CA MARCHE, C EST TOUT ! :D /!\ --------------------------
		
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
      
   	if ($_POST ['kindOfObject'] == "groupe") {
    	$musicStyle = $_POST ['styleMusique'];
    
    	if ($musicStyle != "NonSpecifie") {
    		
    		// ex: SELECT * From groupe Where Id in (SELECT Id_groupe From groupe_genre_musical where Nom_genre_musical = 'Rock')
    		//echo "Requete recherche : ".$Recherche;
    		//echo"\n Requete avec le reste : ".$Recherche."AND  IN (SELECT Id_groupe From groupe_genre_musical where Nom_genre_musical = '" . $musicStyle."')";
    		$Recherche .= "AND Id IN (SELECT Id_groupe From groupe_genre_musical where Nom_genre_musical = '" . $musicStyle."')";
    	}
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////CHOIX SUR OU FAIRE LA RECHERCHE POUR UN USER //////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    
    if ($_POST ['kindOfObject'] == "membre") {
    	$userParam = $_POST ['userParam'];
    
    	if ($userParam != "NonSpecifie") {
    		$Recherche .= " AND Login IN (SELECT Login From membre where ";
                foreach ($RMotClef as $V) {
                    $V = str_replace("'", "''", $V);
                    $Recherche.= $userParam . " LIKE '%$V%'";
                   
                   
                }
           $Recherche.=")";
    	}
    }
    //echo "La condition de recherche est la suivante : ".$Recherche;
    return $Recherche;
}

	$check = new checkDataBase();
 
   
    $resultats = $check->checkRecherche($_POST['kindOfObject'], $cond);
    
    $nb_resultats = count($resultats);
    require_once('../template/resultatRecherche.php');

?>
