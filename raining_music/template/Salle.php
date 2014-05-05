<?php 
include("./../layout/basic_header.php");
?>


<div class="conteneur" style="margin-left:5%; width:90%; min-height:500px; height:100%; background-color:#c0c0c0; ">
	

   
<p> 
<center><font size = 18> Le Falstaff </font></center> <br/><br/><br/>

<div class="Coordonnées" style="border:9px dotted #236586; align:right;margin-top:15px; border-radius: 7px 7px 7px 7px; position:relative; bottom:25px; padding:10px; width:50%;">
        <font size =6><font color = "black">  Adresse :</font></font><br/>
        <blockquote><li><font size =5><font color = "black">42 rue du Montparnasse, 75014 Paris</font></blockquote></font>
        <blockquote><li><font size =5><font color = "black">Téléphone : 01 43 35 38 29</font></blockquote></font>
        <blockquote><li><font size =5><font color = "black"> Horaires : 8h30 - 5h00</font></blockquote></font></div><br/>
        
<blockquote><img src="./../pictures/Falstaff.jpg" alt="Le Falstaff" border=":#0b8dca thick solid" height="200" width="300" style="position:relative;top:5px; margin-right:10px ; margin-bottom: 15px;"  /></p></blockquote></blockquote><br/>
<blockquote><img src="./../pictures/falstaff2.jpg" alt="Le Falstaff" border=":#0b8dca thick solid" height="200" width="300" style="position:relative;top:5px; margin-right:10px ; margin-bottom: 15px;"  /></p></blockquote></blockquote><br/>

<div class="Concert à venir" style="border:9px dotted #236586; margin-top:15px; border-radius: 7px 7px 7px 7px; position:relative; bottom:25px; padding:10px; width:50%;">

<font size = 6><font color= "black"> Concerts à venir dans cette salle :</font></font><br/>
        <blockquote><li><font size = 5><font color= "black"> 5 mai à 21h : Metallica</font></blockquote></font>
        <blockquote><li><font size = 5><font color= "black">18 mai à 21h : ACDC</font></blockquote></font></div><br/><br/><br/>


        
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
            
            <label for="Nom du groupe" >Nom du groupe:</label>
   			<input type="text" name="Nom du groupe" placeholder="" required/><br/>
   			
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
        