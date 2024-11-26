
<?php

require ($root . '/app/view/fragment/fragmentHeader.html');
?>
<?php


echo ('<body>
  <div class="container">');
      
      
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
      
      if(!empty($results)){
        if(isset($title))echo'<h5 class=\'fw-bold text-danger\'>'.$title.'</h5>';
   echo('<table class = "table table-striped table-bordered">');
  $row1=$results[0];
   echo '<thead><tr>';
    foreach($row1 as $key=>$value){
        echo '<th>'.$key.'</th>';
    }

   echo '</tr></thead>';
   


  
   echo '<tbody>';
      
                   
       foreach ($results as $row) {
        echo "<tr>";
        foreach($row as $key=>$value){            
            echo("<td>".$value."</td>");           
        }
        echo "</tr>";
       }
       
 
       echo (' </tbody>
 </table>
</div>') ;

    }

?>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    
  
  