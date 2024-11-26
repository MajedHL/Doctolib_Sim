
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>
    <!-- ===================================================== -->
    <?php
    if ($results) {
     echo ("<h3>Le nouveau rendez-vous: </h3>");
     echo("<ul>");
     echo ("<li>Praticien : " . $results['nom'] ." ".$results['prenom'] . "</li>");     
     echo ("<li>Date : " . $results['rdv_date'] . "</li>");   
     echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion du RDV</h3>");     
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    