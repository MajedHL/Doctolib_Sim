

 
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
    <input value="praticien_add_rdv" type="hidden" name='action'/>  
    <div class="form-group">
      <label for="date">rdv_date : </label>
        <input type="date" id="rdv_date" name="rdv_date" required/>    
        </br>  
        <label for="date">rdv_nombre : </label>
        <input type="number" id="rdv_nombre" name="rdv_nombre" min="1" max="10" required/>     
      </div>
      <p/>
       <br/> 
       <button class="btn btn-danger" type="reset">reset</button>
      <button class="btn btn-primary" type="submit">Add</button>      
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>





