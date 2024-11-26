<?php 



echo ('
  <div class="container">');  
      
      
  echo'<h5 class=\'fw-bold\'>'.$title.'</h5>';

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

?>