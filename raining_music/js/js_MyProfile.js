function modifInfoMyProfile()
{

	//on rajoute l'element formulaire pour pouvoir valider ! 
	form = document.getElementById('futureForm');
	form.innerHTML = "<form action=\"../index.php?action='Modification_MyProfile'\" method=\"post\" enctype=\"multipart/form-data\"> "+ form.innerHTML;
	
	// on cache le mauvais bouton (modif) et affiche le bon (valider) 
	// on aurai pu faire autrement mais la flemme (changement value + suppression du onclick sur le button en javascript)
	// � voir si on a le temps � la fin...
	document.getElementById('modif').style.display="none"; 
	document.getElementById('validModif').style.display=""; 
	
	
	//<input type="file" name="nom" />
	span  = document.getElementById('profileimg');	
	span.innerHTML= "<span style=\"font-weight: bold;\"> Image de profil</span> : <input type=\"file\" name=\"profilePic\" /><br /><br />";
	
	//on rend InfoSexe �ditable
	span  = document.getElementById('InfoSexe');	
	span.innerHTML= "Homme <input type= \"radio\" name=\"gender\" value=\"0\"> Femme <input type= \"radio\" name=\"gender\" value=\"1\">";
	
	//on rend InfoMail �ditable
	span  = document.getElementById('InfoMail');	
	span.innerHTML= "<input type=\"email\" name=\"emailAddress\" value=\""+ span.innerHTML+"\" required>  </input>";
	
	//on rend InfoNom �ditable
	span  = document.getElementById('InfoNom');	
	span.innerHTML= "<input type=\"text\" name=\"nom\" value=\""+ span.innerHTML+"\" >  </input>";
	
	////on rend InfoDOB �ditable
	span  = document.getElementById('InfoDoB');	
	span.innerHTML= "<input type=\"date\" name=\"DoB\" value=\""+ span.innerHTML+"\" required>  </input>";
	
	//on rend InfoLocalisation �ditable
	span  = document.getElementById('InfoLocalisation');	
	span.innerHTML= "<input type=\"text\" name=\"localisation\" value=\""+ span.innerHTML+"\" >  </input>";
	
	//on rend InfoCommentaire �ditable
	span  = document.getElementById('InfoCommentaire');	
	span.innerHTML= "<input type=\"textarea\" name=\"commentaire\" value=\""+ span.innerHTML+"\" >  </input>";
	
	//on rend InfoDep �ditable
	span  = document.getElementById('InfoDep');	
	span.innerHTML= "<input type=\"number\" name=\"departement\" min =\"1\" max=\"95\"  >  </input>";
	
	
	}

