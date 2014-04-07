
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
                
<<<<<<< HEAD
                <div id="loginLink"></div><?php } else { ?>
                
                
               <div id="loginFormLogIn">
              	<?php		
					$userName = $_SESSION['user'];
	
					echo"<li id=\"idconnect\">
					&nbspHello";
					echo"&nbsp$userName";?>
               <ul>
               <li><a href="#">Voir mon profil</a></li>
               <li><a href="#">Mes artistes preferes</a></li>
               <li><a href="#">Mes concerts suivis</a></li>
               <li><a class="menu" href="./../index.php?action='deco'" >Deconnexion</a></li>
				</ul>
               </div>
               <div id="profilLink"></div><?php }?>
             
=======
                <div id="loginLink"></div><?php }?>
            </div>
>>>>>>> branch 'master' of https://github.com/olbucaille/raining_music.git
</header>
		
</script>

        <script src="./../js/jquery-1.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){

<<<<<<< HEAD
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
=======
                $("#loginLink").click(function(){
                    if ($("#loginForm").is(":hidden")){
                        $("#loginForm").slideDown("slow");
                    }
                    else{
                        $("#loginForm").slideUp("slow");
                    }
                });
                
>>>>>>> branch 'master' of https://github.com/olbucaille/raining_music.git
            });
            
            function closeForm(){
                $("#messageSent").show("slow");
<<<<<<< HEAD
                setTimeout('$("#messageSent").hide();$("#loginForm, #loginFormLogIn").slideUp("slow")', 500);
		   	 }
           
        </script>
        
      
=======
                setTimeout('$("#messageSent").hide();$("#loginForm").slideUp("slow")', 500);
		   }
        </script>
>>>>>>> branch 'master' of https://github.com/olbucaille/raining_music.git
