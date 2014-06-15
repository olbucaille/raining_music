
<?php
//on inclut le header 
include("./../layout/basic_header.php");
?>
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script> $(function() {
	$( "#datepicker" ).datepicker({
		showOn: "button",
		 minDate: new Date(1900, 100 - 100, 100),
		 changeMonth: true,
		 changeYear: true,
		buttonImage: "images/calendar.gif",
		buttonImageOnly: true
		});
	
		});
$( "#datepicker" ).datepicker( "option", "minDate", new Date(1907, 1 - 1, 1) );
		
</script>

 -->


<!-- debut de la page en elle meme-->


<div class="conteneur" style="margin-left:5%; width:90%; min-width:800px; height:100%; background-color:#c8c8c8; ">
	
	
    <p class="text"><big><big><strong>INSCRIPTION</strong></big></big><br /><br />Bienvenue sur RAINING MUSIC, nous sommes heureux de vous compter bientot parmis nos membres </p>	<div class="main">
    	
    	
    	<br /> <br />	
    	
 <div class="right" style="min-height: 400px;" padding-left:10px; " >
 
 
 <p style="text-align:justify; border-top:#236586 thick solid; border-radius: 0px 7px 7px 7px;	box-shadow: 0 2px 4px 5px #424346;  padding:10px;">
    
  	 <span style="font-weight:bold;border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; padding-top:11px; font-family:Arial, Helvetica, sans-serif;
    		font-size:20px;" >&nbsp;Des questions particulières ? </span><br/><br/> 
    		Nous savons que vous accordez une grande importance à la sécurité et à la confidentialité, et c'est également notre cas. C'est la raison pour laquelle Raining Music fait de la protection de vos données et de leur disponibilité une priorité.
Nous veillons en permanence à assurer une sécurité maximale, à protéger votre vie privée, et à rendre les produits et services Raining Music encore plus pratiques et plus utiles pour vous. À cette fin, nous consacrons chaque année une part importante de notre budget à la sécurité, et nous faisons appel à des spécialistes de la sécurité des données mondialement reconnus. Nous avons par ailleurs développé des outils de sécurité et de confidentialité simples à utiliser. Vous conservez ainsi la maîtrise des informations que vous partagez avec nous .
En cas de questions à ce sujet, veuillez nous contacter<br/><br/>L'équipe.
	</p>
    
  
 		
    	</div>
    	
    	
    
    <!-- deuxieme colone(gauche) !-->	
   	  <div class="left" style="width: 56% ;min-height: 400px; min-width: 56%">  
   	  
   	
   	  <span style=" background-color:#236586;font-weight:bold;border-radius: 7px 7px 0px 0px; padding-top:11px; font-family:Arial, Helvetica, sans-serif; font-size:20px; position:relative;top:-8px; " >&nbsp;Formulaire d'Inscription&nbsp;</span> 
     <br/>
     <!-- ------- FORMULAIRE DEn CONTACT ------------ -->
    <article id="formulaireContact" style="border:11px solid #236586;margin-top:15px; border-radius: 0px 7px 7px 7px; position:relative; bottom:25px; padding:10px; width=100%">
     <form action="../index.php?action='inscription_utilisateur'" method="post">
         
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
   			<input type="text" name="pseudo" placeholder="chazinou" onkeydown="if(event.keyCode==32) return false;" pattern=".{3,20}" required title="de 3 à 20 caractères" maxlength="20" required/><br/><br/>
             
            <label for="emailAddress">Adresse e-mail*:</label> 
   			<input type="email" name="emailAddress" placeholder="Exemple@mail.com" onkeydown="if(event.keyCode==32) return false;" required/>  <br/><br/>
             
            <label for="password">Mot de passe*:</label>
		    <input type="password" name="password" onkeydown="if(event.keyCode==32) return false;" pattern=".{8,16}" required title="de 8 à 16 caractères" maxlength="16" required/><br/><br/>
		    
		    <label for="password2">Verification Mdp*:</label>
		    <input type="password" name="password2" onkeydown="if(event.keyCode==32) return false;" pattern=".{8,16}" required title="de 8 à 16 caractères" maxlength="16" required/><br/><br/>
		    
		    <label for="DoB">Date de naissance *</label>
		    <input type="date" name="DoB"  placeholder="YYYY-MM-DD" required/><br/><br/>
		    
		    <label for="departement">Departement*</label>
		    <input type="number" name="departement" min="1" max="95" required/><br/><br/>
		    
		    <label for="localisation">Ville*</label>
		    <input type="text" name="localisation" placeholder="Paris" required/><br/><br/>			
			
		    Homme* <input type= "radio" name="gender" value="0" required /> <br />
			Femme* <input type= "radio" name="gender" value="1"/>  <br/><br/>
			
			J'accepte les <a href="./CGU.php">Conditions Générales d'Utilisation</a> de Raining Music
			<input type="checkbox" name="CGU" title="Acceptez les Conditions Générales d'Utilisation" required="required">
			
			<br /> <br />
			
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