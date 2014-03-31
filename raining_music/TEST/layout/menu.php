
<!-- nav : menu !-->
<nav id="menu" >
<ul>
<li><a  class="menu" href="index.htm" title="Accueil">Accueil</a></li>
<li><a  class="menu" href="#" title="Actualites">Actualités</a>
<ul>
<li><a  class="menu" href="#" title="Concerts">Les concerts</a></li>
<li><a  class="menu" href="group.html" title="Nouveaux artistes">Les nouveaux artistes</a></li>

</ul>
</li>
<li><a class="menu" href="#" title="Profil">Mon profil</a></li>
<li><a class="menu" href="Bienvenue.html" title="Recherche avancée">Recherche avancée</a></li>
<li><a  class="menu" href="ContactForm.html" title="Nous contacter">Nous contacter</a></li>
<li class="search">

<form  class="search" method="post">
	
<input class="search_data" name="saisie" type="search" placeholder="Mot clé" required />
<input class="btn-right-loupe" name="go" type="submit" />
</form></li>
<?php
if(isset($_SESSION['user']))
{
		
	$t = $_SESSION['user'];
	
	echo"<li id=\"idconnect\">
				bonjour";
	echo"&nbsp$t";

	?>
				 
				<a class="menu" href="./../index.php?action='deco'" >deco</a>
					
				</li>
				<?php }?>
		
	 </ul>       
</nav>


<script src="./../../js/jquery.js"></script>
<script src="./../../js/modernizr.js"></script>
<script>
(function($){
	var nav = $("#menu");
	nav.find("li").each(function() {
		if ($(this).find("ul").length > 0) {
			$(this).mouseenter(function() {
				$(this).find("ul").stop(true, true).slideDown();
			});
			$(this).mouseleave(function() {
				$(this).find("ul").stop(true, true).slideUp();
			});
			}
	});
})(jQuery);

</script> 