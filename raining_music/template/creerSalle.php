<?php
//on inclut le header 
include("./../layout/basic_header.php");
include("./../db_connect.inc.php");
include("./../model/salle2.php");
$liste = Salle::getsalle();


if(isset($_SESSION['user']))
{
	$user = unserialize($_SESSION['user']);
}

?>

<!-- debut de la page en elle meme-->


<div class="conteneur" style="margin-left:5%; width:90%; min-width:800px; height:100%; background-color:#c8c8c8; ">
	
	
    <p class="text"><big><big><strong>INSCRIPTION</strong></big></big><br /><br />Bienvenue sur RAINING MUSIC, nous sommes heureux de vous compter bientot parmis nos membres </p>	<div class="main">
    	
    	
    	<br /> <br />	
    	
 <div class="right" style="min-height: 400px; padding-left:10px; padding-top:20px; " >
 
 
 <div style="text-align:justify; border-top:#236586 thick solid; border-radius: 0px 7px 7px 7px;	box-shadow: 0 2px 4px 5px #424346;  padding:10px;">
    
  	 <span style="font-weight:bold;border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; padding-top:11px; font-family:Arial, Helvetica, sans-serif;
    		font-size:20px;" >&nbsp;Liste des salles existantes</span><br/><br/>
    		<?php 
    		$i=0;
    		while(isset($liste[$i])) 
    		{
    			echo $liste[$i]->Nom;
    		//	echo"<a href=\"./../index.php?action='rejoindre_salle'&salle=".$liste[$i]->Nom."\"style=\"float:right;\">rejoindre</a>";
    			echo"<hr />";
    			$i++;
			}
    		?>		
  	 </div>
    
  
 		
    	</div>
    	
    	
    
    <!-- deuxieme colone(gauche) !-->	
   	  <div class="left" style="width: 56% ;min-height: 400px; min-width: 56%">  
   	  
   	
   	  <span style=" background-color:#236586;font-weight:bold;border-radius: 7px 7px 0px 0px; padding-top:11px; font-family:Arial, Helvetica, sans-serif; font-size:20px; position:relative;top:-8px; " >&nbsp;Formulaire de creation de salle&nbsp;</span> 
     <br/>
     <!-- ------- FORMULAIRE D'un CONTACT ------------ -->
    <article id="formulaireContact" style="border:11px solid #236586;margin-top:15px; border-radius: 0px 7px 7px 7px; position:relative; bottom:25px; padding:10px; width=100%">
     <form action="../index.php?action='creerSalle'" method="post">
         
            <fieldset> 
            
            <?php 
            //affichage d'un message d'erreur si besoin
            if(isset($_SESSION['messageErreur']))
            {
            echo "<p style=\"color:red; font-weight:bold;\">";
            echo $_SESSION['messageErreur'];
            echo "</p>";
            //destruction pour ne pas retrouver un vieux message plus tard
            $_SESSION['messageErreur']='';
            }?>
        
            
		    <label for="Nom">Nom de la salle*:</label>
		    <input type="text" name="Nom" required/><br/><br/>
		    
		    <label for="Propriétaire">Proprietaire*:</label>
		    <input type="text" name="Proprietaire" required/><br/><br/>
						
        	<label for="Departement">Departement*:</label>
		    <input type="text" name="Departement" required/><br/><br/>
		  										
		    <label for="Adresse">Adresse postale*:</label>
		    <input type="text" name="Adresse" required/><br/><br/>
		    
			<label for="NbPlaces">Nombre de places*:</label>
		    <input type="int" name="NbPlaces" required/><br/><br/>
		    
		    <label for="Telephone">Telephone*:</label>
		    <input type="int" name="Telephone" required/><br/><br/>
		    
		    <label for="Horaires">Horaires d'ouverture*:</label>
		    <input type="text" name="Horaires" required/><br/><br/>
	    
			<br /> <br />
			
            <input id="sendButton" type="submit" value="Valider"/>
             
            </fieldset>
         
        </form>
        
    </article>
    
   	 </div>
       
   
      
</div>

<?php
//... puis le footer
include("./../layout/basic_footer.php");
?>