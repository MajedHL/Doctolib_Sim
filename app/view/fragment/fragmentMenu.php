
<!-- ----- début fragmentMenu -->
<?php
if(!isset($_SESSION)) {
  session_start();
}
echo ('<nav class="navbar navbar-expand-lg bg-success fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" >HLAIHEL Majed |</a>');
     
   echo( '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>');
   if(!empty($_SESSION['login'])){
     echo("<a class=\"navbar-brand\" >".$_SESSION['statut']." |</a>");
     echo("<a class=\"navbar-brand\" >".$_SESSION['prenom']." </a>");
     echo("<a class=\"navbar-brand\" >".$_SESSION['nom']." |</a>");
      
    
     echo ('<div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav me-auto mb-2 mb-lg-0">

       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">'.$_SESSION['statut'].' </a>
         <ul class="dropdown-menu">');

         switch($_SESSION['statut']){
          case "Administrateur":
            echo('
            <li><a class="dropdown-item" href="router1.php?action=admin_getSpecialites">Liste des spécialités</a></li>
            <li><a class="dropdown-item" href="router1.php?action=admin_specialite_getAllId">Sélection d\'une spécialité par son id </a></li> 
            <li><a class="dropdown-item" href="router1.php?action=admin_ToInsert">Insertion d\'une nouvelle spécialité</a></li>
           <hr/>
            <li><a class="dropdown-item" href="router1.php?action=admin_praticien_specialite">Liste des praticiens avec leur spécialité</a></li> 
           <li><a class="dropdown-item" href="router1.php?action=admin_praticiens_ParPatient">Nombre de praticiens par patient</a></li>
           <hr/>
           <li><a class="dropdown-item" href="router1.php?action=admin_Info">Info</a></li> 
            ');
            
              break;
          case "Patient":

            echo('
            <li><a class="dropdown-item" href="router1.php?action=patient_compte">MonCompte</a></li>
            <li><a class="dropdown-item" href="router1.php?action=patient_getRdvs">Liste de mes rendez-vous </a></li>           
            <li><a class="dropdown-item" href="router1.php?action=patient_getAll_Praticiens">Prendre un RDV avec praticien</a></li>
             ');
              
              break;
          case "Praticien": 
            echo('
            <li><a class="dropdown-item" href="router1.php?action=praticien_getAllDispo">Liste de mes disponibilités</a></li>
            <li><a class="dropdown-item" href="router1.php?action=praticien_ToAdd_rdv">Ajout de nouvelles disponibilités </a></li> 
            <hr/>
            <li><a class="dropdown-item" href="router1.php?action=praticien_Rdv_patients">Liste des rendez-vous avec le nom des patients</a></li>          
            <li><a class="dropdown-item" href="router1.php?action=praticien_get_patients">Liste de mes patients (sans doublon)</a></li>             
            ');
              break;  
          }
                    
        
           echo('
           </ul>
       </li>');
    
    
    }
    
   echo ('<div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Innovations</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router1.php?action=fonctionnalite">Proposez une fonctionnalité originale</a></li>
            <li><a class="dropdown-item" href="router1.php?action=amelioration">Proposez une amélioration du code MVC</a></li>           
          </ul>
        </li>');

       echo( '<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">se connecter</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router1.php?action=Personne_login">Login</a></li>
            <li><a class="dropdown-item" href="router1.php?action=inscrire">s\'inscrire</a></li>
            <li><a class="dropdown-item" href="router1.php?action=deconnexion">deconnexion</a></li>            
          </ul>
        </li>');               
         
       echo( '  </ul>
        </li>
      </ul>
    </div>
  </div>
</nav> ');


?>