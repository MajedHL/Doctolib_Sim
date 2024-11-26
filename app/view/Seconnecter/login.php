
<?php require ($root . '/app/view/fragment/fragmentHeader.html');?>
<div class="bg-warning-subtle">
<h2 class="text-danger">Formulaire de connexion</h2>
<form role="form" method='get' action="router1.php">

<input type="hidden" name='action' value='handle_login' required>
    <label class='w-25' for="login">login : </label> 
    <input type="text" id="login" name="login" required/>
    <br/><br/>
    <label class='w-25' for="prenom">password : </label> 
    <input type="password" id="password" name="password" required/>
    <?php if(!$results) echo('<label class=\'text-danger\'>login or password invalid !</label>');  ?>
    <br/><br/>
    <button class="btn btn-danger" type="reset">Reset form</button>
        <button class="btn btn-primary" type="submit">Submit form</button>
</form>
</div>







