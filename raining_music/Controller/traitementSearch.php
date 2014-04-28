<?php

//inclusion du fichier checkDataBase
//(fichier requestSQL incut dans
//celui-ci)
include '../model/checkDataBase.php';
/*
 * Ce fichier php permet de traiter les elements saisies sur la page de recherche
 * (simple et avancee).
 */


///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////déclaration des variables////////////////////////
//////////////////////de récupération des données formulaires//////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
//ces declarations ne sont pas obligatoire les variables sont toutes initialisées vides.

$Date = ''; //variable ou sera recuperer la saisie de la date (zone de texte) par l'utilisateur
$Motcle = ''; //variable ou sera recuperer la saisie des mots clés (zone de texte) par l'utilisateur
$Departement = ''; //variable ou sera recuperer la saisie du d�partement ou trouver des evenements (liste) saisis par l'utilisateur
$Style=''; //variable ou sera recuperee la saisie du style de musique (menu deroulant) saisi par l'utilisateur 
$Reserv = ''; //variable ou sera recuperer la saisie des mots clés (zone de texte) par l'utilisateur
$Checkbox = ''; //variable ou sera recuperer la saisie des checkbox "types d'evenements" par l'utilisateur
$Km = ''; //variable ou sera recuperer la saisie du nombre de km autour de... (liste deroulante) par l'utilisateur
$Periode = ''; //variable ou sera recuperer la saisie d'une période (liste deroulante) par l'utilisateur
$Condition = ''; //variable Fonction  remplirCondition
$Categorie='';
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
//////VERIFICATION PUIS RECUPERATION DES ELEMENTS SAISIES SUR LE FORMULAIRE////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
//if(($_POST['motclé']=="ex: afterwork, epic event...") && empty($_POST['date']) &&  empty($_POST['ville'])) 
//  {
//}
//--------------------------------------------------------------------------------//
//----------vérification puis recupération des valeurs dans la zone --------------//
//-de texte de saisie du code postal ou de la ville ou est effectuer la recherche-//
//--------------------------------------------------------------------------------//

/*
if (isset($_POST['ville'])) {

    $VilleCp = $_POST['ville'];
    // echo "Récupération nom de ville : $VilleCp !";
} else {

    echo "Saisie incorrecte d un code postal ou d un nom de ville !";
}
*/

//--------------------------------------------------------------------------------//
//-recupérer et  vérifier les valeurs saisies sur la listes déroulante kilometres-//
//-------------------------------autour de...-------------------------------------//
//--------------------------------------------------------------------------------//
/*
if (isset($_POST['km'])) {

    $Km = $_POST['km'];
}

*/
//---------------------------------------------------------------------------------//
//----------------vérification puis recuperation des valeurs saisies---------------//
//-------------------dans les checkbox du formulaire de recherche------------------//
//---------------------------------------------------------------------------------//



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

    //Ici à chaque passage $tabCheckbox contiendra la valeur de l'attribut value d'une des cases à cocher
}

//---------------------------------------------------------------------------//
//----------Récuperation et vérification des valeurs dans la ----------------//
//-----------------zone de texte de saisie de la date------------------------//
//---------------------------------------------------------------------------//
/*
if (isset($_POST['date'])) {
    $Date = $_POST['date'];       
    }   
 if (empty($Date)){
    $Date= date('Y-m-d');
 }
 
*/
//---------------------------------------------------------------------------//
//----------Récuperation et vérification des valeurs dans la ----------------//
//------------------------zone de texte de mots clés-------------------------//
//---------------------------------------------------------------------------//


if (isset($_POST['motcleSearch']) && (strlen($_POST['motcleSearch']) <= 80 )) {
    $Motcle = $_POST['motcleSearch'];
} else {
    exit("Saisie incorrecte d un mot cle car plus de 80 caractères !");
}


// Pour les checkbox et les listes déroulantes, on récupère uniquement les
// valeurs, il n'est pas obligatoire de les vérifier.
//---------------------------------------------------------------------------//
//----------------Récuperation de la liste deroulante -----------------------//
//------------------------de reservation en ligne----------------------------//
//---------------------------------------------------------------------------//
//Pour les checkbox et les listes déroulantes, on récupère uniquement les
//valeurs, il n'est pas obligatoire de les vérifier.
/*
if (isset($_POST['reserv'])) {


    $Reserv = $_POST['reserv'];
    //   echo "Récupération de la valeur de reservation en ligne : $Reserv !";
    //  echo '<br>';
}

*/
//--------------------------------------------------------------------------//
//---------------Récuperation de la liste deroulante -----------------------//
//--------------------------plage de prix-----------------------------------//
//--------------------------------------------------------------------------//

/*
if (isset($_POST['prix'])) {

    $Prix = $_POST['prix'];
    // echo "Récupération du prix : $Prix !";
    // echo '<br>';
}*/
//--------------------------------------------------------------------------//
//----------Récuperation et vérification de la liste deroulante ------------//
//--------------------------de la catégorie ----------------------------------//
//--------------------------------------------------------------------------//
/*
if (isset($_POST['categorie'])) {

    $Categorie = $_POST['categorie'];
}
*/
//--------------------------------------------------------------------------//
//----------Récuperation et vérification de la liste deroulante ------------//
//--------------------------de la période ----------------------------------//
//--------------------------------------------------------------------------//
/*

if (isset($_POST['periode'])) {

    //  echo '<br>';
    $Periode = $_POST['periode'];
//    echo "Récupération de la période : $Periode !";
    //   echo '<br>';
} else {

    exit("Saisie incorrecte de la période !");
}*/

//--------------------------------------------------------------------------//
//-----------------------fonction remplirCondition--------------------------//
//--------------------------------------------------------------------------//


$cond = remplirCondition($Motcle, $Checkbox);

function remplirCondition($Motcle,$Checkbox) {

    //renvoie des données de la base en fonction des élements saisies par 
    //l'utilisateur

    $Recherche = ''; //variable Fonction de condition

    if ($Motcle != "") {

        $matable = "membre";

        $Recherche = '(';
        $RMotClef = explode(" ", $Motcle);
        $NbMotClef = count($RMotClef);
        $check = new checkDataBase();      //	Instance d'un objet checkDataBase (Voir le fichier checkDataBase.php pour plus d'informations
        $RequeteTri = $check->checkTable($matable);
        $I = "0";
        foreach ($RequeteTri as $Row) {
            $Type = preg_replace("[^a-z]", "", $Row['Type']);
            $Type= explode("(" , $Type);
            $I2 = "0";
            //if ((( $Type == "varchar(50)") || ( $Type == "varchar(2500)") || $Type == "varchar(80)" || $Type == "varchar(100)")) { // recherche uniquement dans les colonnes de ces types
                       if ($Type[0] == 'varchar') { // recherche uniquement dans les colonnes de ces types
                       if ($I != "0") {
                    $Recherche.= " OR ";
                }
                reset($RMotClef);
                foreach ($RMotClef as $V) {
                    $I2++;
                    $V = str_replace("'", "''", $V);
                    $Recherche.= $Row['Field'] . " LIKE '%$V%'";
                    // var_dump($Recherche);
                    if ($I2 != $NbMotClef) {
                        $Recherche.= " OR ";
                    }
                }
                $I++;
            }
        }
        $Recherche .= ')';
    }
      

    if (!empty($Date)) {

        if (!empty($Recherche)) {
            $Recherche .= " AND Date >= '" . $Date . "'";
        } else {
            $Recherche .= "Date >= '" . $Date . "'";
        }
    }
   

   /*if ($VilleCp != "ex: Ville ou Code postal...") {
        if (!empty($Recherche)) {
            $Recherche .= " AND ";
        }
        $localite = explode(" (", $VilleCp); // divise en deux parties ville - cp
        $localite[0] = str_replace("'", "''", $localite[0]);
        $Recherche .= "city LIKE '%" . $localite[0] . "%' OR CP LIKE '%" . $localite[0] . "%'";

        if ($Km != "0") {
            $cp = '';
            $lieu = $localite[0];
            if (!empty($localite[1])) {
                $cp = str_replace(")", "", $localite[1]); // supprime la parenthese de fin
            }

            $checkvilles = new checkDataBase(); // nouvelle connection
            $resultsvilles = $checkvilles->checkkm($Km, $lieu, $cp);
            foreach ($resultsvilles as $Villes) {
                $Villes['nom'] = str_replace("'", "''", $Villes['nom']); // gestion des apostrophes
                $Recherche .= " OR city LIKE '%" . $Villes['nom'] . "%'"; // recuperation de toutes les villes
            }
        }
    }*/

   /* if ($Prix != "0") {

        if (!empty($Recherche)) {
            $Recherche.="AND ";
        }
        if ($Prix == "1") {
            $Recherche.= "Price = '0'  ";
        }
        if ($Prix == "2") {
            $Recherche.= "Price BETWEEN '1' AND  '29' ";
        } else if ($Prix == "3") {
            $Recherche.= "Price BETWEEN '30' AND  '100' ";
        } else if ($Prix == "4") {
            $Recherche.= "Price >'100'";
        }
    }*/


    /*if ($Reserv != "0") {
        if (!empty($Recherche)) {
            $Recherche.=" AND ";
        }

        $Recherche .= "Reservable = '%" . $Reserv . "%'";
    }*/
     /*if ($Categorie != "0") {
         if (!empty($Recherche)) {
            $Recherche.="AND ";
        }
        if ($Categorie == "1") {
            $Recherche.= "(AgeMin <'3'||ISNULL(AgeMin))AND (AgeMax>='0' || ISNULL(AgeMax))"; 
        }
        if ($Categorie== "2") {
          $Recherche.=  "(AgeMin<='13'|| ISNULL(AgeMin)) AND (AgeMax >='3'|| ISNULL(AgeMax)) ";
        }  
        else if ($Categorie== "3") {
            $Recherche.= "(AgeMin<='17'|| ISNULL(AgeMin)) AND (AgeMax>'13' || ISNULL(AgeMax)) ";
        }
         else if ($Categorie== "4") {
            $Recherche.= "(AgeMin<='25'|| ISNULL(AgeMin)) AND (AgeMax>'18' || ISNULL(AgeMax)) ";
        }
         else if ($Categorie== "5") {
            $Recherche.= "(AgeMin<='50'|| ISNULL(AgeMin)) AND (AgeMax>'26' || ISNULL(AgeMax)) ";
        }
          else if ($Categorie== "6") {
            $Recherche.= "AgeMin<='51'|| ISNULL(AgeMin)) AND (AgeMax>'51' || ISNULL(AgeMax)) ";
        }
     }*/

   /* if (!empty($Checkbox)) {
        if (!empty($Recherche)) {
            $Recherche.="AND ";
        }

        $Recherche .= "Type = '" . $Checkbox . "'";
    }*/


   /* if ($Periode != "0") {
        if (!empty($Recherche)) {
            $Recherche.="AND ";
        }

        if ($Periode == "1") {
            $Recherche .= "Time BETWEEN '06:00:00' AND '11:59:00' ";
        }
        if ($Periode == "2") {
            $Recherche .= "Time BETWEEN '12:00:00' AND '18:59:00'  ";
        } else if ($Periode == "3") {
            $Recherche .= "Time BETWEEN '19:00:00' AND '22:59:00' ";
        } else if ($Periode == "4") {
            $Recherche .= "Time BETWEEN '23:00:00' AND '05:59:00' ";
        }
    }*/

    //var_dump($Recherche);
    return $Recherche;
}

	$check = new checkDataBase();
 
    //$cond .="Order by Date";
    $resultats = $check->checkRecherche("membre", $cond);
    $nb_resultats = count($resultats);
    require_once('../template/resultatRecherche.php');

?>
