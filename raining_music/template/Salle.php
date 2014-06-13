<?php 
include("./../layout/basic_header.php");
include("./../db_connect.inc.php");
?>

   
<div class="conteneur" style="margin-left:5%; width:90%; min-height:500px; height:100%; background-color:#c0c0c0; ">
	

   
<p> <br/><br/>
		<?php
		connectMS();
		
		$requete = "SELECT Nom FROM salle WHERE Nom =\"".$_GET['Nom']."\""; 
		$resultat = mysql_query($requete);
		while($salle=mysql_fetch_array($resultat)){ ?>
		<center><font size = 18><?php echo $salle['Nom']; ?></font></center> <br/><br/><br/>
		<?php }?>
		
		<div class="Coordonnes" style="border:9px dotted #236586; margin-top:15px; border-radius: 7px 7px 7px 7px; position:relative; bottom:25px; padding:10px; width:50%;">
		 <font size =6><font color = "black">  Informations utiles :</font></font><br/>
		<?php
		connectMS();
		
		$requete = "SELECT Adresse, Departement,Telephone,Horaires, Photo, Photo2 FROM salle WHERE Nom =\"".$_GET['Nom']."\""; 
		$resultat = mysql_query($requete);
		while($salle=mysql_fetch_array($resultat)){ ?>
		<blockquote><li><font size =5><font color = "black">Adresse : <?php echo $salle['Adresse']; ?></font></blockquote></font>
		<blockquote><li><font size =5><font color = "black">Departement : <?php echo $salle['Departement'];?></font></blockquote></font>
		<blockquote><li><font size =5><font color = "black">Telephone : <?php echo $salle['Telephone'];?></font></blockquote></font>
		<blockquote><li><font size =5><font color = "black">Horaires d'ouverture: <?php echo $salle['Horaires'];?></font></blockquote></font>
		
	
		</div><br/>
     
      
        <blockquote><img src="./../pictures/<?php echo $salle['Photo'];?>"  border=":#0b8dca thick solid" height="200" width="300" style="position:relative;top:5px; margin-right:10px ; margin-bottom: 15px;"  /></p></blockquote></blockquote><br/>
        <blockquote><img src="./../pictures/<?php echo $salle['Photo2'];?>" border=":#0b8dca thick solid" height="200" width="300" style="position:relative;top:5px; margin-right:10px ; margin-bottom: 15px;"  /></p></blockquote></blockquote><br/>

<?php }?>

<div class="Concert a venir" style="border:9px dotted #236586; margin-top:15px; border-radius: 7px 7px 7px 7px; position:relative; bottom:25px; padding:10px; width:50%;">

<font size = 6><font color= "black"> Concerts a venir dans cette salle :</font></font><br/>
        <?php
		connectMS();
		
        $requete = "SELECT Nom,Date FROM concert WHERE Nom =\"".$_GET['Nom']."\""; 
		$resultat = mysql_query($requete);
		while($salle=mysql_fetch_array($resultat)){ ?>
		<blockquote><li><font size =5><font color = "black"><?php echo $salle['Nom'];?> le <?php echo $salle['Date'];?></font></blockquote></font>

        <blockquote><li><font size = 5><font color= "black"><?php echo $salle['Nom2'];?> le <?php echo $salle['Date2'];?></font></font></blockquote></font>
        <?php } ?>

        </div><br/><br/><br/>
<div id="Recherche concert" style="border:11px solid #236586; margin-top:15px; border-radius: 7px 7px 7px 7px; position:relative; bottom:25px; padding:10px; width:30%;">

<form method='post'>
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
    </div> 
        
 <?php 
include("./../layout/basic_footer.php");
?>
        