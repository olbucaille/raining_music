
<!-- nav : menu !-->
<nav id="menu" >
<ul>
<li><a  class="menu" href="./../template/accueil.php" title="Accueil">Accueil</a></li>

<!-- AFFICHAGE DE L'ONGLET PROFIL SI L'USER EST IDENTIFIE -->
<?php 
if(isset($_SESSION['user']))
{?>
<li><a class="menu" href="./../template/myProfile.php" title="Profil">Mon profil</a>
<ul><li><a class="menu" href="./../template/MonGroupe.php"  title="myGroup">Mon groupe</a></li>
<li><a class="menu" href="../TEST/buildingInProgress.php"  title="myConcertHall">Ma salle de concert</a></li>
</ul></li>
<?php }?>

<li><a  class="menu" href="../TEST/buildingInProgress.php"  title="Actualites">Actualités</a>
<ul>
<li><a  class="menu" href="../TEST/buildingInProgress.php" title="Concerts">Les concerts</a></li>
<li><a  class="menu" href="../TEST/buildingInProgress.php" title="Nouveaux artistes">Les nouveaux artistes</a></li>
</ul>
</li>
<li><a class="menu" href="./../template/Redirection.php" title="Artistes">Les artistes</a></li>
<li><a  class="menu" href="./../template/RedirectionSalle.php" title="SallesConcert">Les salles de concert</a></li>


<li><a class="menu" href="./../template/RechercheAvancee.php" title="Recherche avancee">Recherche avancée</a></li>
<li><a  class="menu" href="./../template/ContactPage.php" title="Nous contacter">Nous contacter</a></li>
<li><a class="menu" href="./../template/faq.php" title="F.A.Q">F.A.Q</a></li>

<?php 
if(isset($_SESSION['user']))
{?>
<li><a  class="menu" href="./../forum" title="forum">Forum</a></li>
<?php }?>



		
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
