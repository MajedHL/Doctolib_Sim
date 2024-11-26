<?php require($root."/app/view/fragment/fragmentHeader.html") ?>


<body>
<div class='bg-warning-subtle'  >
<h1 class="text-danger">Formulaire d'inscription </h1>
<form role="form" method='get' action="router1.php">
      <div class="form-group " style="margin-left: 20px;" >      
        <input type="hidden" name='action' value='Personne_insert' required>
        <label class='w-25' for="nom">nom : </label> 
        <input type="text" id="nom" name="nom" required/>
        <br/><br/>
        <label class='w-25' for="prenom">prenom : </label> 
        <input type="text" id="prenom" name="prenom" required/>
        <br/><br/>
        <label class='w-25' for="adresse">adresse : </label> 
        <input type="text" id="adresse" name="adresse" required/>
        <br/><br/>
        <label class='w-25' for="login">login : </label> 
        <?php
        if($login_used!=-1)echo '<input type="text" id="login" name="login" required/>';
         else { 
           echo('<input type="text" id="login" name="login" required value='.$_GET['login']." style=\"color: red; \"> <label class=\"text-danger\">!!</label>");
         echo('<p class="text-danger">login already being used !</p>');
          }
         ?>
        <br/><br/>
        <label class='w-25' for="password">password : </label> 
        <input type="password" id="password" name="password" required/>
        <br/><br/>
        
        <label for="statut">Votre statut : </label>
        <select class="form-select" id='statut' name='statut' style="width: 200px" required >
            <option>Administrateur </option>
            <option>Patient </option>
            <option>Praticien </option>
        </select>
        </br>
        
        <label for="specialite">spécialité : </label>
        <select class="form-select" id='specialite' name='specialite' style="width: 200px" required>
        <?php   
        foreach($results as $row){
          foreach($row as $key=>$spec){
          echo("<option>$spec</option>");
        } 
      }
        
            ?>
        </select>
        </br>
        <button class="btn btn-danger" type="reset">Reset form</button>
        <button class="btn btn-primary" type="submit">Submit form</button>        
      </div>
      <br/>     
    </form>
</div>
</body>
