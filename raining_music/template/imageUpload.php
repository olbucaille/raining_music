<?php
if (isset($_POST["id_groupe"]) && !empty($_POST["id_groupe"])) {  
    $target = "upload_pictures/";
    $target = $target .$_POST["id_groupe"]."_groupe.JPG" ; 
    $ok=1; 
	/* upload de la photo */
    if (move_uploaded_file($_FILES['imgfile']['tmp_name'], $target)) 
    {
        $result=$target;
		//echo $result;
		/* redirection vers la page AffichageGroupe */
		header("location:AffichageGroupe.php?id_groupe=".$_POST["id_groupe"]."");
    } 
    else
    {
        $result=0;
    }
	}
?>
