<?php
//on inclut le header 
include("./../layout/basic_header.php");
?>

<!-- -->


<div class="conteneur" style="margin-left:5%; width:90%; min-width:800px; height:100%; background-color:#c8c8c8; ">
	
   	<div class="main">

    	<table style="border-top:#236586 thick solid; border-radius: 0px 7px 7px 7px;	box-shadow: 0 2px 4px 5px #424346;   padding-left:10px;">
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
      <p>Vous pouvez, ici, poser vos questions. Nous y répondrons le plus rapidement possible soit par e-mail, soit en créant un nouveau sujet sur la F.A.Q.<br/>
Cependant, avant de poser votre question, veuillez consulter les sujets déjà présents sur la F.A.Q. Merci.
</td>
<td>
 

<a href="#"> <img src="../pictures/FAQresize.bmp" alt="Vers la F.A.Q" border=":#0b8dca thick solid" height="100" width="200" style="position:relative;top:10px; margin-right:10px;"  /></a>
</p></td>
</tr>
  </table>
  <br /><br />
    </div>




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
     <form action="../Controller/contactForm.php" method="post">
         <p style="font-style: italic;font-size: 10px"> Les champs suivis d'une * sont obligatoires.</p>
            <fieldset> 
            <label for="prenomNom" >Prénom et Nom:</label>
   			<input type="text" name="prenomNom" required placeholder="Jean-Michel Dumont"/><span class="requiredStar">*</span><br/><br/>
             
            <label for="emailAddress">Adresse e-mail:</label> 
   			<input type="email" name="emailAddress" required placeholder="Exemple@mail.com" /> <span class="requiredStar">*</span> <br/><br/>
             
            <label for="telNum">Numéro de téléphone:</label>
		    <input type="tel" name="telNum" placeholder="0123344556"/><br/><br/>
		    
		    <label for="subjectChoice">Sujet:</label>
		    <select name="subjectChoice" required>
		    	<option value="DroitsMembre">Droits en tant que membre</option>
		    	<option value="Medias">Les médias</option>
		    	<option value="ContenuDuSite">Contenu du site</option>
		    	<option value="ErgonomieSite">Ergonomie du site</option>
		    	<option value="Autre">Autre</option>
		    </select><span class="requiredStar">*</span> <br/><br/>
		    	
		    
			<label for="Message">Message:</label>
		    <textarea name="messageContact" id="Message" required placeholder="Saisissez ici votre message. Restez poli. Pas de langage SMS. Merci." style="max-height:60px; max-width: 90%"></textarea><span class="requiredStar">*</span> 
           <br/><br/><br/><br/><br/>

           <input id="sendButton" type="submit" value="Envoyer"/>
             
            </fieldset>
         
        </form>
        
    </article>
    
   	 </div>
   
    
    <!-- CARTE ADRESSE RAINING MUSIC -->
        <div class="CenterForm" style="  padding-left:10px;" >
     
 
        
       <span style=" background-color:#236586;font-weight:bold;border-radius: 7px 7px 0px 0px; padding-top:11px; font-family:Arial, Helvetica, sans-serif; font-size:20px; position:relative;top:-8px; " >&nbsp;Carte&nbsp;</span> 
     
	   <p style="border:11px solid #236586; border-radius: 0px 7px 7px 7px; position:relative; bottom:25px; padding:10px;">
	   Notre adresse:<br/>
	   28 rue, Notre Dame des Champs<br/>
	   75006 PARIS<br/><br/>
    	<iframe src="https://mapsengine.google.com/map/u/0/embed?mid=zcDbx-dwquYs.kNFb3RvLdEWo" width=100% height="400" ></iframe>
    	<br />
       </p>
  <hr />   

</div>


<!-- PIED DE PAGE -->
<?php 
//... puis le footer
include("./../layout/basic_footer.php");
?>
