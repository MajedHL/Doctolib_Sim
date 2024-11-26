
<!-- ----- début propositions de fontionnalité -->
<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

    <?php
    echo ('<div class="container">');
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';   
    
    if($func){
        echo("<h3>Fonctionnalités:</h3>");
        echo'<ul>';
        echo('<li>Pouvoir supprimer un RDV par le patient, et supprimer une disponibilté par le praticien</li>' 
       .'<li>Vérifier les dates rentrées, que le praticien n\'ajoute pas une disponibilité dans le passé</li>'
        .'<li>L\'ajout d\'un champ lors de la prise du RDV pour savoir le motif du RDV </li>'
        .'<li>Stocker les RDVs qui ont eu lieu et les motifs les plus fréquents, ca pourrait etre utile pour des statistiques sur la situation sanitaire de la société </li>'
                );
        echo'</ul>';
    }
    else if($amel){
        echo("<h3>Amélioration:</h3>");
        echo'<ul>';
        
        echo('<li>Créer des modèles de jointure lorsqu\'il a plusieurs tables concernés par une requete</li>'); 
        echo('<li>Restreindre l\'accès aux autre fonctionnalité par modification d\'URL</li>');
        echo'</ul>';
    }
    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentFooter.html';
    ?>
    <!-- ----- fin de propositions de fontionnalité -->    

    
    