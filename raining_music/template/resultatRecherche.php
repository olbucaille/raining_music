<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->


<!DOCTYPE html>
<html>
    <head>
        <title>Resultat_de_recherche</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
       
     
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script> 

    </head>
    
    <body class="body1">

        
        <div  > <H1> Résultats de la recherche </H1> </div>

        <div class="middle">
            </br>
         <?php   if ($nb_resultats != "0"): ?>
    
             <?php foreach ($resultats as $events): ?>
             
            <div class="event event<?php echo $events['Login'];?>">
          
             <div class="infos"> 
             <a href="/paris/ensta-paristech/vendredi-14-decembre-boom-ensta-paristech,1,616360.html" class="title">
             </a>
             <span>
             <span>
             <span class="event_nom"> <?php echo $events['Nom']; ?> </span>
             </a> 
            <span class="event_lieu">
              <?php echo $events['Mail'];  ?></span>
             </span>
             </span>
             <div class="event_type">
             <span property="v:eventType"><?php echo $events['DoB'];  ?> </span>
             <span class="event_date"> <?php echo $events['Localisation'];  ?>  </span>
             </div>
             </div>
            
             </div>               
             </div>
           <?php endforeach; ?> <!-- fin de la boucle -->
    <?php else:  
         echo "<h2>Aucun résultat ne correspond à votre recherche</h2>"; ?>
           
        <?php endif;?>
        
         
    </body>
</html>
