<?php

include_once 'requestSQL.php';

class checkDataBase {

    function checkRecherche($table, $condition) {
        $request = new requestSQL();        // 	Création d'un objet Request SQL permettant de faire une requete SQL pré-construite 
        $data = $request->select($table, '*', $condition);  //	Recherche de toutes les entrées de la table selon les conditions passés en arguments		       
        
        $temp = $data->fetchAll();        //	Puisque l'on recherche tous les user/groupe/concert, il y a un risque d'y avoir plus d'une entrée. C'est pour cette raison que l'on utilise fetchall
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
    function checkMusicStyle($musicStyle){
    	//SELECT Id_groupe From groupe_genre_musical where Nom_genre_musical = 'Rock'
    	$requestMusicStyle=new requestSQL();
    	$allDataFromMusicStyle=$requestMusicStyle ->select('groupe_genre_musical', 'Id_groupe',"Nom_genre_musical='".$musicStyle."'" );
    	$temp=$allDataFromMusicStyle->fetchAll();
    	$requestMusicStyle=null;
    	
    	
    	
    	/*$requestMusicGroupsFromThisStyle=new requestSQL;
    	$allMusicGroupsFromThisStyle=$requestMusicGroupsFromThisStyle ->select('groupe', 'Nom', "Id IN (".$allDataFromMusicStyle.")");
    	$temp=$allMusicGroupsFromThisStyle->fetchAll();
    	$requestMusicGroupsFromThisStyle=null;*/
    	
    	return ($temp);
    	//return $allDataFromMusicStyle;
    }


}
?>
