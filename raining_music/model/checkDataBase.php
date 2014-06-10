<?php

include_once 'requestSQL.php';

class checkDataBase {

    function checkRecherche($table, $condition) {
        $request = new requestSQL();        // 	Création d'un objet Request SQL permettant de faire une requete SQL pré-construite 
        $data = $request->select($table, '*', $condition);  //	Recherche de toutes les entrées de la table selon les conditions passés en arguments		       
        
        
        if($data !=null)
        $temp = $data->fetchAll();        //	Puisque l'on recherche tous les user/groupe/concert, il y a un risque d'y avoir plus d'une entrée. C'est pour cette raison que l'on utilise fetchall
        else $temp="voidObject";
        $request = null;
        //	Destruction de l'objet requestSQL
        return ($temp);            //	Renvoie de la donnée contenue dans la base de donnée sous le format STRING
    }
     
    function checkTable($table) { // on recherche dans la table les différentes colonnes
        $request = new requestSQL();
        $data = $request->show($table);
        $temp = $data->fetchAll();
        $request = null;
        return ($temp);
    }
    
        // FONCTION INUTILE....
    function checkMusicStyle($nomGroupe){
    	//SELECT `Nom_genre_musical` FROM groupe_genre_musical WHERE `Id_groupe`=(SELECT `Id` FROM `groupe` WHERE `Nom`='Hey Dude !')
    	$requestMusicStyle=new requestSQL();
    	$allDataFromMusicStyle=$requestMusicStyle ->select('groupe_genre_musical', 'Id_groupe',"`Id_groupe`=(SELECT `Id` FROM `groupe` WHERE `Nom`='".$nomGroupe.")" );
    	$temp=$allDataFromMusicStyle/*->fetchAll()*/;
    	$requestMusicStyle=null;
    	
    	
    	
    	/*$requestMusicGroupsFromThisStyle=new requestSQL;
    	$allMusicGroupsFromThisStyle=$requestMusicGroupsFromThisStyle ->select('groupe', 'Nom', "Id IN (".$allDataFromMusicStyle.")");
    	$temp=$allMusicGroupsFromThisStyle->fetchAll();
    	$requestMusicGroupsFromThisStyle=null;*/
    	
    	return ($temp);
    	//return $allDataFromMusicStyle;
    }

    function getMusicStyle($nomGroupe) {
    	//SELECT Nom_genre_musical FROM `groupe_genre_musical` WHERE Id_groupe=(SELECT Id FROM groupe WHERE Nom='CoreanBand')
    	$requestStyle=new requestSQL();
    	//$param1=$requestID ->select('groupe', 'Id',"Nom='".$nomGroupe."'" );
    	$param1=$requestStyle->select('groupe_genre_musical','Nom_genre_musical', "Id_groupe=(SELECT Id FROM groupe WHERE Nom='".$nomGroupe."')" );
    	$temp=$param1->fetchAll();
    	$requestStyle=null;

    	

    	return ($temp);
    }

}
?>
