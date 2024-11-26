
<!-- ----- debut Router1 -->
<?php
require_once ('../controller/ControllerPatient.php');
require_once ('../controller/ControllerAdministrateur.php');
require_once ('../controller/ControllerPraticien.php');
require_once ('../controller/ControllerHome.php');
require_once ('../controller/ControllerSpecialite.php');
require_once ('../controller/ControllerRDV.php');
if(!isset($_SESSION)) {
  session_start();
}
// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

$actionParts= explode("_", $action);
echo("<script>console.log(".$_SESSION['statut'].")</script>");
if(count($actionParts)>=1){
    switch ($actionParts[0]) {
        case "admin":
            if($_SESSION['statut']!='Administrateur') $action="home";          
            break;
            
        case "praticien":
            if($_SESSION['statut']!='Praticien') $action="home";
            break;
            
        case "patient":
            if($_SESSION['statut']!='Patient')$action="home";  
            break;
        
    }
}

// --- Liste des méthodes autorisées
switch ($action) {
   
       
      case 'admin_praticien_specialite':
      case "admin_praticiens_ParPatient": 
      case "admin_Info":       
        if(!empty($_SESSION['login']))  ControllerAdministrateur::$action() ; 
        else {$action = "home";
          ControllerHome::$action();}       
         break;




         case "praticien_get_patients":
         case "patient_getAll_Praticiens":         
          if(!empty($_SESSION['login']))  ControllerPraticien::$action() ; 
          else {$action = "home";
            ControllerHome::$action();}       
           break;


          case "patient_compte":
          case "patient_getRdvs":                    
            if(!empty($_SESSION['login']))  ControllerPatient::$action() ; 
        else {$action = "home";
          ControllerHome::$action();}       
         break;



        case "admin_getSpecialites":
        case "admin_specialite_getAllId":
        case "admin_specialite_getById":
        case "admin_ToInsert":
        case "admin_insert":
            if(!empty($_SESSION['login']))  ControllerSpecialite::$action() ; 
        else {$action = "home";
          ControllerHome::$action();}       
         break;






          case "praticien_getAllDispo":
          case "praticien_ToAdd_rdv":
          case "praticien_add_rdv":
          case "praticien_Rdv_patients":
          case "patient_Get_praticienDispos":
          case "patient_addRDV":
          if(!empty($_SESSION['login']))  ControllerRDV::$action() ; 
        else {$action = "home";
          ControllerHome::$action();}       
         break;






      case "inscrire":
      case "Personne_insert":
      case "Personne_login":      
      case 'deconnexion': 
      case "handle_login": 
      case 'fonctionnalite':
      case 'amelioration':
      ControllerHome::$action();
      break;



 // Tache par défaut
 default:
  $action = "home";
  ControllerHome::$action();
}
?>
<!-- ----- Fin Router1 -->

