
<?php
//on inclut le header 
include("./../layout/basic_header.php");
include("./../db_connect.inc.php");
include("./../model/group.php");
$liste = Group::getgroupAndId();


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
    		font-size:20px;" >&nbsp;liste des groupes </span><br/><br/>
    		<?php 
    		$i=0;
    		while(isset($liste[$i])) 
    		{
    			echo '<a href="affichageGroupeAdmin.php?id_groupe='.$liste[$i]->id_group.'">'.$liste[$i]->nom.'</a>';
    			echo"<a href=\"./../index.php?action='rejoindre_groupe'&groupe=".$liste[$i]->nom."\"style=\"float:right;\">rejoindre</a>";
    			echo"<hr />";
    			$i++;
			}
    		?>		
  	 </div>
    
  
 		
    	</div>
    	
    	
    
    <!-- deuxieme colone(gauche) !-->	
   	  <div class="left" style="width: 56% ;min-height: 400px; min-width: 56%">  
   	  
   	
   	  <span style=" background-color:#236586;font-weight:bold;border-radius: 7px 7px 0px 0px; padding-top:11px; font-family:Arial, Helvetica, sans-serif; font-size:20px; position:relative;top:-8px; " >&nbsp;Formulaire de creation de groupe&nbsp;</span> 
     <br/>
     <!-- ------- FORMULAIRE DEn CONTACT ------------ -->
    <article id="formulaireContact" style="border:11px solid #236586;margin-top:15px; border-radius: 0px 7px 7px 7px; position:relative; bottom:25px; padding:10px; width=100%">
     <form action="../index.php?action='creerGroupe'" method="post">
         
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
            
            <label for="pseudo" >Pseudo*:</label>
   			<input type="text" disabled="disabled" name="pseudo" value="<?php echo $user->login?>" required/><br/><br/>
            <label for="role">Votre Role *</label>
		    <input type="text" name="role" required><br/><br/>
		    
            
		    <label for="nomGroupe">Nom du Groupe*:</label>
		    <input type="text" name="nomGroupe" required/><br/><br/>
		    <input type="hidden"  name="pseudo" value="<?php echo $user->login?>" required/><br/> 
        
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