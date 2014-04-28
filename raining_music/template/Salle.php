<?php 
include("./../layout/basic_header.php");
?>


<div class="conteneur" style="margin-left:5%; width:90%; min-height:500px; height:100%; background-color:#c0c0c0; ">
	

   
<p> 
<center><font size = 18> Le Falstaff </font></center>
        <li><font size =5><font color = "black"> Adresse :</font></font>
        <font size =5><font color = "black">42 rue du Montparnasse, 75014 Paris</font></font>
        <br />
        <li><font size =5><font color = "black">T&eacutel&eacutephone : 01 43 35 38 29</font></font>
        <br />
        <li><font size = 5><font color = "black"> Horaires : 8h30 - 5h00</font></font>
<br /><img src="./../pictures/Falstaff.jpg" alt="Le Falstaff" border=":#0b8dca thick solid" height="200" width="300" style="position:relative;top:5px; margin-right:10px ; margin-bottom: 15px;"  /></p>
<img src="./../pictures/falstaff2.jpg" alt="Le Falstaff" border=":#0b8dca thick solid" height="200" width="300" style="position:relative;top:5px; margin-right:10px ; margin-bottom: 15px;"  /></p>
<font size = 5><font color= "black"> Concerts &agrave venir dans cette salle :</font></font>
<br />
<li><font size = 5><font color= "black"> 5 mai &agrave 21h : Metallica</font></font>
<br />
<li><font size = 5><font color= "black"> 18 mai &agrave 21h : ACDC</font></font>
<br />
<br />
<br />
<br />
            <div id="loginFormContainer">
                <div id="FormulaireConcert">
                    <fieldset>
                    <form method="post" action="./scripts/identification.php">
                      <br />  <label id="proposer" for="username">Date</label>
            		 <input name="username" type="text" /><br/>
                        <label id="proposer" for="date">Groupe</label>
                       <input name="groupe" type="text" /><br /> <br />
                        <input id="ok" name="ok" value="Proposer" onClick="closeForm()" type="submit" />&nbsp; <a href="#"></a>
                    </form>
                   </fieldset>
                </div>
                 </div>
    

    </li>
    </div>
        
       <?php 
include("./../layout/basic_footer.php");
	?>
        