
<script type="text/javascript"> $('head').append(' <link rel="stylesheet" href="/mvc_test/libs/css/animateur.css" />');
</script>







<div id="cv" class="instaFade">
    <div class="mainDetails">
        <div id="headshot" class="quickFade">
            <img src="/mvc_test/libs/uploads/picture/anonyme.png"   alt=" <?php echo $_POST["membre"][0]->getNom() . " " . $_POST["membre"][0]->getPrenom() ?>" />
        </div>

        <div id="name" >
            <h1 class="quickFade delayTwo"><?php echo $_POST["membre"][0]->getNom() . " " . $_POST["membre"][0]->getPrenom() ?></h1>
            <h3 class="quickFade delayThree">Membre Association <?php echo $_POST["association"][0]->get_nom() ?> 
            </h3>
        </div>

        <div id="contactDetails" class="quickFade delayFour">
            <ul>
                <li>Identifiant: <?php echo $_POST["membre"][0]->getId() ?></li>
                <li>E-mail: <?php echo $_POST["membre"][0]->getEmail() ?></li>
                <li>Cin: <?php echo  $_POST["membre"][0]->getCin() ?></li>
                <li>Adresse: <?php echo $_POST["membre"][0]->getAdresse() ?></li>
                <li>Tel: <?php echo $_POST["membre"][0]->getTelephone() ?></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>

    <div id="mainArea" class="quickFade delayFive">

        <section>
            <div class="sectionTitle">
                <h1>Fonction dans l'Association </h1>
            </div>

            <div class="sectionContent">
                
              <?php
              
              foreach ($_POST["fonctions"] as $value) {
                if($value->get_date_fin_fonction()=="0000-00-00"){
                    
                    
                     echo "<article>";
                 echo   "<h2>".$value->get_nom_fonction()."</h2>";
                 echo   "<p class=\"subDetails\">".$value->get_date_debut_fonction(). "  -  En cours</p>";
                echo "</article>";
                
                   
                    
                }
             
                
                }
                
                   foreach ($_POST["fonctions"] as $value) {
                                    if($value->get_date_fin_fonction()!="0000-00-00"){

                    echo "<article>";
                 echo   "<h2>".$value->get_nom_fonction()."</h2>";
                 echo   "<p class=\"subDetails\">".$value->get_date_debut_fonction(). "  -  ".$value->get_date_fin_fonction()."</p>";
                echo "</article>";
                    
                }}
                
                  
          
              
              ?>

               
            </div>
            <div class="clear"></div>
        </section>





    </div>
</div>

</body>
</html>

