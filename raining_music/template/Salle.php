<?php 
include("./../layout/basic_header.php");
include("./../db_connect.inc.php");
include './../model/salle2.php';
include ("./../model/group.php");
$id=array();
$i=0;
$autorise= false;
if(isset($_SESSION['user']))
{
	$user = unserialize ( $_SESSION ['user'] );
	
	$autorise = $autorise = Salle::verifyProprietaireValidate( $user->login, $_GET['Nom'] );
	
}

?>

   

		<?php
		connectMS();
		
		$requete = "SELECT Nom FROM salle WHERE Nom =\"".$_GET['Nom']."\""; 
		$resultat = mysql_query($requete);
		while($salle=mysql_fetch_array($resultat)){ ?>
		<center><font size = 18><?php echo $salle['Nom']; ?></font></center> <br/><br/><br/>
		<?php }?>
		
<div
				style="border-top: #174156 thick solid; border-radius: 0px 7px 7px 7px; box-shadow: 0 2px 4px 5px #424346; padding: 10px; margin-left:10px; margin-bottom: 30px; width:40%; float: left;">

				<span
					style="background-color:#174156; font-weight: bold; color: #fff;
					border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; 
					padding: 11px; font-family: Arial, Helvetica, sans-serif; 
					font-size: 20px;">&nbsp;Notre salle !
				
				</span>
			<br/>
			<br/> 
		<?php
		connectMS();
		
		$requete = "SELECT Adresse, Departement,Telephone,Horaires, Photo, Photo2 FROM salle WHERE Nom =\"".$_GET['Nom']."\""; 
		$resultat = mysql_query($requete);
		while($salle=mysql_fetch_array($resultat)){ ?>
		<span style="font-weight: bold;">Adresse</span> : <span><?php echo $salle['Adresse'];?> </span><br />
		<span style="font-weight: bold;">Departement</span> : <span><?php echo $salle['Departement'];?> </span><br />
		<span style="font-weight: bold;">Telephone</span> : <span><?php echo '+33 0'.$salle['Telephone'];?> </span><br />
		<span style="font-weight: bold;">Horaires d'ouverture:</span> : <span><?php echo $salle['Horaires'];?> </span><br />
		
		</div>
     
      
   
<?php }?>

	<div
				style="border-top: #174156 thick solid; border-radius: 0px 7px 7px 7px; box-shadow: 0 2px 4px 5px #424346; padding: 10px; margin-right:10px; margin-bottom: 30px; width:40%; float: right;">

				<span
					style="background-color:#174156; font-weight: bold; color: #fff;
					border-radius: 0px 0px 7px 7px; box-shadow: #666 6px 6px 6px 0px; 
					padding: 11px; font-family: Arial, Helvetica, sans-serif; 
					font-size: 20px;">&nbsp;Concerts a venir !
				
				</span>
			<br/>
			<br/>
			<?php $allDataFromConcert=Group::getConcert()?>

			<?php
			
			foreach ( $allDataFromConcert as $Row ) {
				
		
				$nomConcert = $Row ['Nom'];
				$dateConcert = $Row ['Date'];
				$groupeConcert = $Row ['Groupe'];
				$concertAccepte = $Row ['Concert_accepte'];
				$salleAccepte = $Row ['salle_acceptee'];
				$salleConcert= $Row['salle'];
				// date à tester :
				$now = date ( 'Y-m-d' );
				$next = $dateConcert;
				
				// test
				$now = new DateTime ( $now );
				$now = $now->format ( 'Ymd' );
				$next = new DateTime ( $next );
				$next = $next->format ( 'Ymd' );
				
				$id[$i] =Group::getgroupid($groupeConcert);
				
				if($salleConcert == $_GET ['Nom']){
				if ($concertAccepte = $Row ['Concert_accepte'] == 1 && $salleAccepte = $Row ['salle_acceptee'] == 1) {
					if($now > $next)	{ 
						echo "<h4 class=resultNames><a>'Concerts déjà passés '</a></h4>";
						
					}				
					else  {
		

		

						// echo "next est dans le futur";
?>

						<fieldset>
						<span style="font-weight: bold;">Nom de concert</span> : <span><a href="affichageConcert.php?id_groupe=<?php echo $id[$i]->Id?>&concert=<?php echo $nomConcert?>"><?php echo $nomConcert?></a></span><br />
						<span style="font-weight: bold;">Date de concert</span> : <span><?php echo $dateConcert?> </span><br />	
						</fieldset>
						</br>
						<?php }
						$i++;
}
}
}

?>

        <?php
		connectMS();
		
        $requete = "SELECT Nom,Date FROM concert WHERE Nom =\"".$_GET['Nom']."\""; 
		$resultat = mysql_query($requete);
		while($salle=mysql_fetch_array($resultat)){ ?>
		<blockquote><li><font size =5><font color = "black"><?php echo $salle['Nom'];?> le <?php echo $salle['Date'];?></font></blockquote></font>

        <blockquote><li><font size = 5><font color= "black"><?php echo $salle['Nom2'];?> le <?php echo $salle['Date2'];?></font></font></blockquote></font>

        
        <?php }

        if($autorise)
        {
        	echo "
        	<form action=\"formconcert.php?Nom=".$_GET['Nom']."\" method=\"post\"  >
        	<input type=\"submit\" name=\"ajouter concert\" value=\"ajouter concert\" />
        	</form>";
        	
        }?>

        </div><br/><br/><br/>

<!--  <form method='post'>
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
            
            <label for="Nom" >Nom du groupe:</label>
   			<input type="text" name="Nom" placeholder="" required/><br/>
   			
             <font size = 2> ou </font> <br/>
             
			<label for="Date" >Date:</label>
   			<input type="date" name="Date" placeholder="" required/><br/><br/>
			
            <input id="sendButton" type="submit" value="Rechercher un concert"/>
             
            </fieldset>
            
         </form>
         -->
    </div> 
        
 <?php 
include("./../layout/basic_footer.php");
?>
        