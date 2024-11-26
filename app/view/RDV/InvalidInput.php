
<!-- ----- début propositions de fontionnalité -->
<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

    <?php
    echo ('<div class="container">');
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';   
    
    if($results==-1){
        echo("<h3 >Le nombre des rdv doit etre entre 1 et 10</h3>");       
    }
   else if($results==-2){
        echo("<h3>Date format Invalide, doit etre Year-month-day (yyyy-mm-dd) <span class='text-danger'>Joue pas avec l'url :)</span></h3>");       
    }
    else if($results==-3){
        echo("<h3 class='text-danger'>Mois doit etre entre 1 et 12</h3>");       
    }
    else if($results==-4){
        echo("<h3 class='text-danger'>Jour doit etre entre 0 et 31</h3>");       
    }
    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentFooter.html';
    ?>
    <!-- ----- fin de propositions de fontionnalité -->    

    
    