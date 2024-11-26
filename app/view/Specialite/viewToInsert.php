
<!-- ----- début viewToInsert -->
 
<?php 
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
    if(isset($title))echo'<h5 class=\'fw-bold text-danger\'>'.$title.'</h5>';
    ?> 

    <form role="form" method='get' action='router1.php'>
    <input value="admin_insert" type="hidden" name='action'/>  
    <div class="form-group">
      <label for="specialite">spécialité : </label>
        <input type="text" id="specialite" name="specialite" required/>
        <?php if($results==-1) echo("<label class=\"text-danger\">spécialité (".$_GET["specialite"].") Already Exists !</label>" );?>
        </br>       
      </div>
      <p/>
       <br/> 
       <button class="btn btn-danger" type="reset">reset</button>
      <button class="btn btn-primary" type="submit">Add</button>      
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

<!-- ----- fin viewToInsert -->



