<?php

include_once 'requestSQL.php';

class checkDataBase {
	/*
	 * 	Test si l'utilisateur possède un compte actif. 
	* 	Return :	0 <-- son compte n'est pas actif
	* 				1 <-- son compte est actif.
	* */
	function isActive ($table, $login){
        $request = new requestSQL();          //	Instance de la classe requestSQL permettant de cr�er des requ�tes.
        $data = $request->select($table, '*', "Mail = '" . $login . "'"); //	�mission de la requ�te � la base de donn�e
        $request = null;
        $temp = $data->fetch();
        $actived = $temp['Activated'];
        return $actived;
	}
	
    function checkUser($login) {
        /*
         * 	Test si un utilisateur ayant comme login la valeur pass� en argument existe.
         * 	Return :	0 <-- l'utilisateur n'existe pas
         * 				1 <-- l'utilisateur existe
         * */
        $request = new requestSQL();          //	Instance de la classe requestSQL permettant de cr�er des requ�tes.
        $data = $request->select('users', '*', "Mail = '" . $login . "'"); //	�mission de la requ�te � la base de donn�e
        $request = null;
        if ($data->fetch() != null)          //	LIGNE A COMPRENDRE : On fait un fetch, ce qui nous retourne un tableau associatif de la ligne si elle est dispo
        //	Ce qui signifie une cha�ne de caract�re si la requ�te nous a remis un r�sultat, nul si c'est un objet (cas o� elle nous a rien remis) 
            return 1;
        else
            return 0;
    }

    function checkOrganizers($login) {
        /*
         * 	Test si un organisateur ayant comme login la valeur pass� en argument existe.
         * 	Return :	0 <-- l'organisateur n'existe pas
         * 				1 <-- l'organisateur existe
         * */
        $request = new requestSQL();          //	Instance de la classe requestSQL permettant de cr�er des requ�tes.
        $data = $request->select('organizers', '*', "Mail = '" . $login . "'"); //	�mission de la requ�te � la base de donn�e
        $request = null;
        if ($data->fetch() != null)          //	LIGNE A COMPRENDRE : On fait un fetch, ce qui nous retourne un tableau associatif de la ligne si elle est dispo
        //	Ce qui signifie une cha�ne de caract�re si la requ�te nous a remis un r�sultat, nul si c'est un objet (cas o� elle nous a rien remis) 
            return 1;
        else
            return 0;
    }
    
    function checkAdmins($login) {
    	/*
    	 * 	Test si un organisateur ayant comme login la valeur pass� en argument existe.
    	* 	Return :	0 <-- l'admin n'existe pas
    	* 				1 <-- l'admin existe
    	* */
    	$request = new requestSQL();          //	Instance de la classe requestSQL permettant de cr�er des requ�tes.
    	$data = $request->select('admins', '*', "Mail = '" . $login . "'"); //	�mission de la requ�te � la base de donn�e
    	$request = null;
    	if ($data->fetch() != null)          //	LIGNE A COMPRENDRE : On fait un fetch, ce qui nous retourne un tableau associatif de la ligne si elle est dispo
    		//	Ce qui signifie une cha�ne de caract�re si la requ�te nous a remis un r�sultat, nul si c'est un objet (cas o� elle nous a rien remis)
    		return 1;
    	else
    		return 0;
    }

    function checkUserPassword($login){
        $request = new requestSQL();
        $data = $request->select('users', 'Password', "Mail = '" . $login . "'");
        $temp = $data->fetch();
        $request = null;
        return ($temp['Password']);
    }

    function checkOrganizersPassword($login) {
        /*
         * Cette m�thode doit �tre appell� QUE si l'utilisateur existe
         * Return : l'empreinte du mot de passe crypt� */
        $request = new requestSQL();
        $data = $request->select('organizers', 'Password', "Mail = '" . $login . "'");
        $temp = $data->fetch();
        $request = null;
        return ($temp['Password']);
    }
    
    function checkAdminsPassword($login) {
    	/*
    	 * Cette m�thode doit �tre appell� QUE si l'utilisateur existe
    	* Return : l'empreinte du mot de passe crypt� */
    	$request = new requestSQL();
    	$data = $request->select('admins', 'Password', "Mail = '" . $login . "'");
    	$temp = $data->fetch();
    	$request = null;
    	return ($temp['Password']);
    }

    function checkRecherche($table, $condition) {
        $request = new requestSQL();        // 	Cr�ation d'un objet Request SQL permettant de faire une requ�te SQL pr�-construite 
        $data = $request->select($table, '*', $condition);  //	Recherche de toutes les entr�es de la table membre selon les conditions pass�s en arguments		       
        
        $temp = $data->fetchAll();        //	Puisque l'on recherche tous les users, il y a un risque d'y avoir plus d'une entr�e. C'est pour cette raison que l'on utilise fetchall
        $request = null;
        //	Destruction de l'objet requestSQL
        return ($temp);            //	Renvoie de la donn�e contenue dans la base de donn�e sous le format STRING
    }

    function checkVille($condition) {
        /* 	Pr�paration de la requ�te SQL	 */
        
        $request = new requestSQL();        // 	Cr�ation d'un objet Request SQL permettant de faire une requ�te SQL pr�-construite 
        $data = $request->select('maps_ville','nom,cp',$condition);  //	Recherche de toutes les entr�es de la table �venement selon les conditions pass�s en arguments		
        //var_dump($data);
        $temp = $data->fetchAll();
        //var_dump($temp); //	Puisque l'on recherche tous les �v�nements, il y a un risque d'y avoir plus d'une entr�e. C'est pour cette raison que l'on utilise fetchall
        $request = null;
        //	Destruction de l'objet requestSQL
        return ($temp);            //	Renvoie de la donn�e contenue dans la base de donn�e sous le format STRING
    }

       function checkkm ($km,$localite, $cp) // on recupere les différentes villes situées à l'intérieur du périmetre spécifié en km
      {
      $requestkm = new requestSQL(); // 	Cr�ation d'un objet Request SQL permettant de faire une requ�te SQL pr�-construite 
      
      //var_dump($UserLat); 
      $chlat = new checkDataBase();
      $UserLat=$chlat -> checklat($localite,$cp);
      $chlng = new checkDataBase();
      $UserLng=$chlng -> checklon($localite,$cp);
      
      $formule="6366*ACos( Cos(RADIANS(lat)) * Cos(RADIANS('".$UserLat['lat']."'))
      * Cos(RADIANS('".$UserLng['lon']."') - RADIANS(lon)) + Sin(RADIANS(lat)) * Sin(RADIANS('".$UserLat['lat']."')) )";
      $data = $requestkm ->select('maps_ville','nom', "$formule <= '".$km."'");      
      
      //Recherche de toutes les entr�es de la table �venement selon les conditions pass�s en arguments
      $temp = $data -> fetchAll();
  
//	Puisque l'on recherche tous les �v�nements, il y a un risque d'y avoir plus d'une entr�e. C'est pour cette raison que l'on utilise fetchall
      $requestkm = null;
  //    var_dump($temp);
      //	Destruction de l'objet requestSQL
      return ($temp);	
      //	Renvoie de la donn�e contenue dans la base de donn�e sous le format STRING
     }

    function checklat($loc,$cp) // on recupere la latitude de la ville
    {
      $requestlat = new requestSQL(); 
      $Lat=$requestlat ->select ('maps_ville','lat'," nom='".$loc."' AND cp='".$cp."'"); // recupere la la
      $temp= $Lat->fetch();
      $requestlat = null;
      return($temp);
        
    }
    function checklon($loc,$cp) // on recupere la longitude de la ville
    {
      $requestlng = new requestSQL();
      $Lng=$requestlng ->select('maps_ville','lon',"nom= '".$loc."' AND cp='".$cp."' " );
      $temp= $Lng -> fetch();
      $requestlng = null; 
      return($temp);
        
    }       
    function checkTable($table) { // on recherche dans la table les différentes colonnes
        $request = new requestSQL();
        $data = $request->show($table);
        $temp = $data->fetchAll();
        $request = null;
        return ($temp);
    }
	function Req_encodage() {
	    $request = new requestSQL();        // 	Cr�ation d'un objet Request SQL permettant de faire une requ�te SQL pr�-construite 
	    $request->encodage();
	    $request = null;
	}

}
?>
