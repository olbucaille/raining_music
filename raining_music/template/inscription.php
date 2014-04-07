
<?php
//on inclut le header 
include("./../layout/basic_header.php");
?>


<!-- debut de la page en elle meme-->


<div class="conteneur" style="margin-left:5%; width:90%; min-width:800px; height:100%; background-color:#c8c8c8; ">
	
	
    <p class="text"><big><big><strong>INSCRIPTION</strong></big></big><br /><br />Bienvenue sur RAINING MUSIC, nous sommes heureux de vous compter bientot parmis nos membres </p>	<div class="main">
    	
    	
    	<br /> <br />	
    	
 <div class="right" style="min-height: 400px;" padding-left:10px; " >
 
 
 <p style="text-align:justify; border-top:#236586 thick solid; border-radius: 0px 7px 7px 7px;	box-shadow: 0 2px 4px 5px #424346;  padding:10px;">
    
  	 <span style="font-weight:bold;border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; padding-top:11px; font-family:Arial, Helvetica, sans-serif;
    		font-size:20px;" >&nbsp;Des questions particulières ? </span><br/><br/> Aucun souci, toute l'équipe de Raining Music est à votre disposition pour répondre à vos questions quant à notre organisme, 
    		nos motivations, nos ambitions, le recrutement (pourquoi pas ?!). Et encore bien d'autres choses. N'hésitez pas à nous contacter pour tous sujets (même sans rapport direct avec le contenu même
    		 du site), nous serons heureux de pouvoir vous répondre et vous aider à mieux comprendre notre fonctionnement ou encore qui nous sommes réellement (même si, pour ce point, une page y est dédiée)
    		 , etc. Merci à vous tous de faire vivre notre communauté! <br/><br/>L'équipe.
	</p>
    
  
 		
    	</div>
    	
    	
    
    <!-- deuxieme colone(gauche) !-->	
   	  <div class="left" style="width: 56% ;min-height: 400px; min-width: 56%">  
   	  
   	
   	  <span style=" background-color:#236586;font-weight:bold;border-radius: 7px 7px 0px 0px; padding-top:11px; font-family:Arial, Helvetica, sans-serif; font-size:20px; position:relative;top:-8px; " >&nbsp;Formulaire de contact&nbsp;</span> 
     <br/>
     <!-- ------- FORMULAIRE DE CONTACT ------------ -->
    <article id="formulaireContact" style="border:11px solid #236586;margin-top:15px; border-radius: 0px 7px 7px 7px; position:relative; bottom:25px; padding:10px; width=100%">
     <form action="#" method="post">
         
            <fieldset> 
            <label for="pseudo" >Pseudo:</label>
   			<input type="text" name="prenomNom" placeholder="Jean-Michel Dumont"/><br/><br/>
             
            <label for="emailAddress">Adresse e-mail:</label> 
   			<input type="email" name="emailAddress" placeholder="Exemple@mail.com" />  <br/><br/>
             
            <label for="password">Mot de passe:</label>
		    <input  name="password" /><br/><br/>
		    
		    <label for="password2">Verification du mot de passe :</label>
		    <input name="password2" "/><br/><br/>
		    
		    <label for="password2">Verification du mot de passe :</label>
		    <input type="date" name="password2" "/><br/><br/>
		    
		 	<br/><br/>
		    	
		    
		<br/><br/><br/>

           <input id="sendButton" type="submit" value="Envoyer"/>
             
            </fieldset>
         
        </form>
        
    </article>
    
   	 </div>
       
   
      
</div>

<?php
//... puis le footer
include("./../layout/basic_footer.php");
?>