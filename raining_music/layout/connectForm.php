
<?php
if(!isset($_SESSION['user']))
{
	?>
                <div id="loginForm">
                    <fieldset>
                    <form method="post" action="./../index.php?action='identifiation'">
                        <label id="connexion" for="username">Pseudonyme</label>
                        <input name="username" type="text" />
                        <label id="connexion" for="password">Mot de passe</label>
                        <input name="password" type="password" /><br /> <br />
                        <input id="ok" name="ok" value="valider" onClick="closeForm()" type="submit" />&nbsp; <a href="./../index.php?action='inscription'">S'inscrire</a>
                    </form>
                   </fieldset>
                </div>
                
                <div id="loginLink"></div><?php } else { ?>
                
                
               <div id="loginForm">
              
               <ul>
               <li><a href="#">Voir mon profil</a></li>
               <li><a href="#">Mes artistes preferes</a></li>
               <li><a href="#">Mes concerts suivis</a></li>
               <li><a class="menu" href="./../index.php?action='deco'" >Deconnexion</a></li>
				</ul>
               </div>
               <div id="profilLink"></div>
               <!-- <div id="profilLink"> <?php		
					$userName = $_SESSION['user'];
	
					echo"<li id=\"idconnect\">
					bonjour";
					echo"&nbsp$userName";?>
				</div>-->
            <?php } ?> 
</header>
		
</script>

        <script src="./../js/jquery-1.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {

            	$("#profilLink, #loginLink").click( 
                function ()
                {
                     if ($("#loginForm").is(":hidden"))
                     {
                         $("#loginForm").slideDown("slow");
                     }
                     else{
                         $("#loginForm").slideUp("slow");
                     }
                 }
               
            );
            });
            
            function closeForm()
            {
                $("#messageSent").show("slow");
                setTimeout('$("#messageSent").hide();$("#loginForm").slideUp("slow")', 500);
		   	 }
           
        </script>