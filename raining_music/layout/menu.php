
<!-- nav : menu !-->
<nav id="menu" >
<ul>
<li><a  class="menu" href="./../template/accueil.php" title="Accueil">Accueil</a></li>

<!-- AFFICHAGE DE L'ONGLET PROFIL SI L'USER EST IDENTIFIE -->
<?php 
if(isset($_SESSION['user']))
{?>
<li><a class="menu" href="./myProfile.php" title="Profil">Mon profil</a>
<ul><li><a class="menu" href="#" title="myGroup">Mon groupe</a></li>
<li><a class="menu" href="#" title="myConcertHall">Ma salle de concert</a></li>
</ul></li>
<?php }?>

<li><a  class="menu" href="#" title="Actualites">Actualit�s</a>
<ul>
<li><a  class="menu" href="#" title="Concerts">Les concerts</a></li>
<li><a  class="menu" href="./../template/Redirection.php" title="Nouveaux artistes">Les nouveaux artistes</a></li>
</ul>
</li>
<li><a class="menu" href="#" title="Artistes">Les artistes</a></li>
<li><a  class="menu" href="./../template/Salle.php" title="SallesConcert">Les salles de concert</a></li>


<li><a class="menu" href="./../template/RechercheAvancee.php" title="Recherche avancee">Recherche avanc�e</a></li>
<li><a  class="menu" href="./../template/ContactPage.php" title="Nous contacter">Nous contacter</a></li>
<li class="search">

<form  class="search" method="post" action="../Controller/traitementSearch.php">
	
<input class="search_data" name="motcleSearch" type="search" placeholder="Mot cl�" required />
<input class="btn-right-loupe" name="go" type="submit" />
</form></li>

		
	 </ul>       
</nav>


<script src="./../js/jquery.js"></script>
<script src="./../js/modernizr.js"></script>
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
