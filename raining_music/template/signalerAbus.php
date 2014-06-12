<?php
//on inclut le header 
include("./../layout/basic_header.php");
?>

<!-- -->


<div class="conteneur" style="margin-left:5%; width:90%; min-width:800px; height:100%; background-color:#c8c8c8; ">
	
   	<div class="main">

    	<table style="border-top:#236586 thick solid; border-radius: 0px 7px 7px 7px;   padding-left:10px;">
    <tr><td><p>   	            <?php 
            //affichage d'un message si besoin
            if(isset($_SESSION['message']))
            {
            echo "<p style=\"color:green; font-weight:bold;\">";
            echo $_SESSION['message'];
            echo "</p>";
            //destruction pour ne pas retrouver un vieux message plus tard
            $_SESSION['message']='';
            }
            ?></p>
      <p>
      Cet espace est dédié à la signalisation d'abus sur le site. Cela peut concerner le forum (langage grossier, insultes, haine, etc.),
      le contenu des médias partagés par les différents membres (artistes,
      propriétaires de salles de concerts) ou encore des pseudos inapropriés (insultant, pornographique, etc.). <br/>Veuillez, lors de votre signalement, essayer de n'omettre aucun détail pour que l'on puisse sanctionner
      les fauteurs de trouble.<br/>
      Merci à vous de nous aider à modérer ce site ! :)
      <br/><br/>
      L'équipe.</p>
</td>
<td>
 
</p></td>
</tr>
  </table>
  
    </div>

<div class="infoGray" style="margin:auto;margin-bottom:50px;font-style:italic; font-family: serif; width: 90%;border-radius:5px; padding:10px;background-color: #808080; color: #fff;">
<img alt="info" src="../pictures/info.png"/>
<span style="margin-left: 10px;">
Pour signaler un abus, renseignez le formulaire ci-dessous. N'oubliez pas de lire l'encart situé à droite pour vérifier que vous n'omettez rien !</span>
</div>


 <div class="right" style="min-height: 400px;" padding-left:10px; " >
 
 
 <div style="text-align:justify; font-size:14px; border:#236586 thick solid; border-radius: 0px 7px 7px 7px;	margin-top:15px; ;  padding:10px;">
    
  		 <span style="font-weight:bold;border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; padding-top:11px; font-family:Arial, Helvetica, sans-serif;
    		font-size:16px;" >&nbsp;Signaler un abus </span><br/><br/> 
    		<p>Pour que votre signalement soit correctement pris en compte, veuillez respecter les consignes suivantes:</p>
    		<ul style="list-style-type: square;">
    		<li>Ne pas être grossier</li>
    		<li>Pas de langage SMS (<i>nous ne sommes pas équipés de décodeurs dédiés à cet effet</i>)</li>
    		</ul>
    		<p>N'oubliez pas non plus que si vous ne nous renseignez pas bien sur l'abus commis, nous ne serons pas en mesure de valider votre signalement et de faire le nécessaire pour y remédier.</p>
    		
    		<span style="font-weight:bold;border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; padding-top:11px; font-family:Arial, Helvetica, sans-serif;
    		font-size:16px;" >&nbsp;Conseils pour bien remplir le formulaire</span><br/><br/> 
    		
    		<p></p>
    		<ul style="list-style-type: square;">
    		<li>Précisez le nom du membre/artiste/propriétaire que vous souhaitez signaler</li>
    		<li>Précisez la raison pour laquelle vous le signalez (grossier, insultant, propos incitants à la haine, etc.)</li>
    		<li>Si cela se situe sur le forum, merci de préciser la catégorie, le topic et la date (si possible) relatifs à la signalisation</li>
    		</ul>
    		</div>
  
    
  
 		
    	</div>
    	
    	
    
    <!-- deuxieme colone(gauche) !-->	
   	  <div class="left" style="width: 56% ;min-height: 400px; min-width: 56%">  
   	  
   	
   	  <span style=" background-color:#236586;font-weight:bold;border-radius: 7px 7px 0px 0px; padding-top:11px; font-family:Arial, Helvetica, sans-serif; font-size:20px; position:relative;top:-8px; " >&nbsp;Formulaire&nbsp;</span> 
     <br/>
     <!-- ------- FORMULAIRE DE SIGNALEMENT ------------ -->
    <article id="formulaireContact" style="border:11px solid #236586;margin-top:15px; border-radius: 0px 7px 7px 7px; position:relative; bottom:25px; padding:10px; width=100%">
     <form action="../Controller/signalerForm.php" method="post">
         <p style="font-style: italic;font-size: 10px"> Les champs suivis d'une * sont obligatoires.</p>
         
         <?php 
         if (isset($_SESSION['user']))         
         $loginUserActif=$user->login;
         else $loginUserActif="Visiteur";?>
            <fieldset> 
            <label for="login" >Votre login</label>
   			<?php echo "<input type='text' name='login' value='".$loginUserActif."'readonly=\"readonly\" /><span class='requiredStar'>"?>*</span><br/><br/>
            
             
            <label for="nomSignale">Nom de l'entité à signaler</label> 
   			<input type="text" name="nomSignale"  placeholder="" /> <br/><br/>
             		    
		    <label for="subjectChoice">Sujet:</label>
		    <input type="text" name="subjectChoice" disabled="disabled" value="Signaler un abus"/>
		    <span class="requiredStar">*</span> <br/><br/>
		    	
		    
			<label for="Message">Message:</label>
		    <textarea name="messageContact" id="Message" required placeholder="Saisissez ici votre message. Restez poli. Pas de langage SMS. Merci." style="max-height:60px; max-width: 90%"></textarea><span class="requiredStar">*</span> 
           <br/><br/><br/><br/><br/>
<?php echo $loginUserActif;?>
           <input id="sendButton" type="submit" value="Envoyer"/>
             
            </fieldset>
         
        </form>
        
    </article>
    
   	 </div>
   
    


<!-- PIED DE PAGE -->
<?php 
//... puis le footer
include("./../layout/basic_footer.php");
?>
