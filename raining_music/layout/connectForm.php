  <div style="position:absolute;top:0px;margin-left:70%;"> 
 <div id="loginFormContainer">
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
                        <input id="ok" name="ok" value="valider" onClick="closeForm()" type="submit" />&nbsp; <a href="./../template/inscription.php">S'inscrire</a>
                    </form>
                   </fieldset>
                </div>
                
                <div id="loginLink"></div><?php } else { ?>
                
                
               <div id="loginFormLogIn">
              	<?php		
					$user = unserialize($_SESSION['user']);
	
					echo"<li id=\"idconnect\">
					&nbspHello";
					echo"&nbsp$user->login";?>
               <ul>
               <li><a href="#">Voir mon profil</a></li>
               <li><a href="#">Mes artistes preferes</a></li>
               <li><a href="#">Mes concerts suivis</a></li>
               <li><a class="menu" href="./../index.php?action='deco'" >Deconnexion</a></li>
				</ul>
               </div>
               <div id="profilLink"></div><?php }?>

            </div>

</header>

		
</script>

        <script src="./../js/jquery-1.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){


            	$("#profilLink, #loginLink").click( 
                function ()
                {
                     if ($("#loginForm, #loginFormLogIn").is(":hidden"))
                     {
                         $("#loginForm, #loginFormLogIn").slideDown("slow");
                     }
                     else{
                         $("#loginForm, #loginFormLogIn").slideUp("slow");
                     }
                 }
               
            );
                

            });
            
            function closeForm(){
                $("#messageSent").show("slow");

                setTimeout('$("#messageSent").hide();$("#loginForm, #loginFormLogIn").slideUp("slow")', 500);
		   	 }
           
        </script>
        

 
